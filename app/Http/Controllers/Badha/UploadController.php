<?php

namespace App\Http\Controllers\Badha;

use App\Photo;
use App\Post;
use File;
use Illuminate\Http\Request;
use Image;

class UploadController extends AuthorizedController {

	protected $photos;

	protected $post;

	public function __construct(Photo $photos, Post $post) {
		parent::__construct();

		$this->photos = $photos;
		$this->post = $post;
	}

	public function upload(Request $request) {
		$type = $request->input('_type');

		if ($type == 'post' && is_array($images = $request->file('files'))) {

			$uploadedImages = array();

			return $this->store_photos($images, $type);
		} else if ($type == 'adv') {

			$image = $request->file('file');
			$generatedFilename = $this->generate_filename($image);

			Image::make($image->getRealPath())->save('uploads/' . $type . '/' . $generatedFilename);
			Image::make($image->getRealPath())->fit(200, 120)->save('uploads/' . $type . '/square_' . $generatedFilename);

			$data['filename'] = $generatedFilename;
			return $data;

		} else if ($type == 'post') {
			$image = $request->file('file');
			$generatedFilename = $this->generate_filename($image);
			$this->handleImage($image, $generatedFilename, $type);

			$photo = $this->photos;
			$photo->filename = $generatedFilename;
			$photo->save();

			$id = $photo->id;
			$data['filename'] = $generatedFilename;
			$data['id'] = $id;
			return $data;
		}

		$image = $request->file('file');

		$generatedFilename = $this->generate_filename($image);
		$this->handleImage($image, $generatedFilename, $type);

		$data['filename'] = $generatedFilename;

		return $data;

	}

	public function generate_filename($file) {
		if (isset($file)) {
			return str_random(20) . '.' . $file->getClientOriginalExtension();
		}
		return false;
	}

	public function handleImage($image, $filename, $type) {
		Image::make($image->getRealPath())->save('uploads/' . $type . '/' . $filename);
		Image::make($image->getRealPath())->resize(600, null, function ($constraint) {$constraint->aspectRatio();})->save('uploads/' . $type . '/medium_' . $filename);
		Image::make($image->getRealPath())->fit(200, 120)->save('uploads/' . $type . '/square_' . $filename);
		Image::make($image->getRealPath())->fit(300, 300)->save('uploads/' . $type . '/squareMedium_' . $filename);
		Image::make($image->getRealPath())->resize(1024, null, function ($constraint) {$constraint->aspectRatio();})->save('uploads/' . $type . '/big_' . $filename);

	}

	public function store_photos($images, $type) {
		foreach ($images as $image) {
			/** Generate File Name */
			$generatedFilename = $this->generate_filename($image);

			/** Resize & Upload Images */
			$this->handleImage($image, $generatedFilename, $type);

			/** Save Photo Details */
			$photo = $this->photos;
			$photo->filename = $generatedFilename;
			$photo->save();

			$id = $photo->id;

			/** Image URL */
			$imageUrl = url() . '/uploads/' . $type . '/squareMedium_' . $generatedFilename;

			$uploaded_image['url'] = $imageUrl;
			$uploaded_image['name'] = $generatedFilename;
			$uploaded_image['id'] = $id;

		}
		$uploadedImages[] = $uploaded_image;
		// $data = $uploaded_images;
		$data = array('files' => $uploadedImages);
		return $data;
	}

	public function photo_by_id($id) {
		if ($photo = $this->photos->with('tags')->findOrfail($id)) {
			return $photo->toJson();
		}
	}

	public function update_photo(Request $request, $id) {
		if ($photo = $this->photos->findOrfail($id)) {
			$input = $request->all();
			$photo->fill($input)->save();
			return $this->photo_by_id($id);
			// $input = $request->all();
		}

	}

	public function delete_photo(Request $request, $id) {

		if ($photo = $this->photos->findOrfail($id)) {
			$type = 'uploads/post/';
			$photos = array(
				$type . 'big_' . $photo->filename,
				$type . 'medium_' . $photo->filename,
				$type . 'mini_' . $photo->filename,
				$type . 'square_' . $photo->filename,
				$type . 'squareMedium_' . $photo->filename,
				$type . $photo->filename,
			);

			$delete = File::delete($photos);
			$update_article_image = $this->post->where('image', '=', $photo->filename)->update(array('image' => ''));
			$photo->delete();
			return 'true';
		}
	}
}
