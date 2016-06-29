<?php

namespace App\Http\Controllers\Rashoveshi;

use App\Advs;
use App\Http\Controllers\Controller;
use App\LiveBlog;
use App\Post;
use Embed;
use Illuminate\Http\Request;
use Meta;

class PostController extends Controller {

	protected $posts;

	protected $liveblogs;

	public function __construct(Post $posts, LiveBlog $liveblogs, Advs $advs) {
		$this->posts = $posts;
		$this->liveblogs = $liveblogs;
		$this->advs = $advs;
	}

	public function homepage() {

		Meta::title('rashoveshi.mv');
		Meta::meta('description', 'rashoveshi');
		Meta::meta('image', asset('images/social/rashoveshi-default.png'));
		Meta::meta('twitter:image:src', asset('images/social/rashoveshi-default.png'));
		Meta::meta('url', 'http://rashoveshi.mv');

		return view('rashoveshi.pages.home');
	}

	/**
	 * Single Article Views
	 * @return view
	 */
	public function article($id) {
		// $post = Post::with('parentTag')->status('published')->find($id);
		$post = $this->posts->status('published')->find($id);

		if ($post->tag == env('LIVEBLOG')) {

			$posts = $this->posts->find($id);

			$bullets = $this->liveblogs->where('post_id', $id)->orderBy('created_at', 'desc')->get();

			Meta::title($post->heading_latin);
			Meta::meta('description', 'rashoveshi.mv');
			Meta::meta('url', 'http://rashoveshi.mv/' . $post->id);

			if ($post->image !== "") {
				Meta::meta('image', asset('uploads/post/') . '/' . $post->mainImage->filename);
				Meta::meta('twitter:image:src', asset('uploads/post/') . '/' . $post->mainImage->filename);
			}

			postReadViews($id);

			return view('rashoveshi.pages.liveblog', compact('bullets', 'post'));
		}

		if ($post->tag == '11') {
			return view('rashoveshi.pages.gallery-detail', compact('post'));
		} else {

			// return dd($post->content_text);
			$recentPosts = $this->posts->multi('published')->take(6)->get();

			Meta::title($post->heading_latin);
			Meta::meta('description', 'rashoveshi.mv');
			Meta::meta('url', 'http://rashoveshi.mv/' . $post->id);

			if ($post->image !== "") {
				Meta::meta('image', asset('uploads/post/') . '/' . $post->mainImage->filename);
				Meta::meta('twitter:image:src', asset('uploads/post/') . '/' . $post->mainImage->filename);
			}

			// $advs = $this->advs->where('page', '=', 'article')->get();
			$advs = array();

			$advs['article_bottom'] = $this->advs->position('article', 'article_bottom')->get()->toArray();
			$advs['article_top'] = $this->advs->position('article', 'article_top')->get()->toArray();
			$advs['left_skyscrapper'] = $this->advs->position('article', 'left_skyscrapper')->get()->toArray();
			$advs['leaderboad'] = $this->advs->position('article', 'leaderboad')->get()->toArray();

			// return $advs;

			postReadViews($id);

			// $isBreaking = in_array(32, $post->tag_list->toArray());

			// if ($isBreaking) {
			// 	Meta::meta('image', asset('assets/og/breaking_og.png'));
			// 	Meta::meta('twitter:image:src', asset('assets/og/breaking_og.png'));
			// } else if ($post->image !== "") {
			// 	Meta::meta('image', bucket() . "/post/big_" . $post->image);
			// 	Meta::meta('twitter:image:src', bucket() . "/post/big_" . $post->image);
			// } else {
			// 	Meta::meta('image', asset('assets/og/avas_og.png'));
			// 	Meta::meta('twitter:image:src', asset('assets/og/avas_og.png'));
			// }

		$oldPosts = $this->posts->NotFeatured()->multi('published')->take(9)->get();
			return view('rashoveshi.pages.article', compact('post', 'recentPosts', 'advs', 'oldPosts'));
		}

	}

	public function category() {
		return view('rashoveshi.pages.category');
	}
	public function gallery() {
		return view('rashoveshi.pages.gallery');
	}
	public function gallery_detail() {
		return view('rashoveshi.pages.gallery-detail');
	}
	public function results() {
		return view('rashoveshi.pages.results');
	}

	/** GET EMBED */
	public function embed(Request $request) {

		$data = array();
		$info = Embed\Embed::create($request->get('url'));

		if ($info !== false) {
			if ($info->code !== null) {
				$data['html'] = $info->code;
			}
		}
		// 		if ($info->code !== null) {
		// 			$data['html'] = $info->code;
		// 		}
		// 	}
		// 	else {
		// 		$data['html'] = "<i>Sorry. No embed found. Please check the URL again.</i>";
		// 	}
		// 		return $data;
		// 	}

		return response()->json($data);
	}
}
