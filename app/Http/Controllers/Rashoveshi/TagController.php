<?php

namespace App\Http\Controllers\Rashoveshi;

use App\Http\Controllers\Controller;
use App\Post;
use App\Tag;
use App\Poll;

class TagController extends Controller {

	protected $tags;

	protected $posts;

	public function __construct(Tag $tags, Post $posts) {
		$this->tags = $tags;
		$this->posts = $posts;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index($tag) {
		$posts = array('posts' => null);

		if ($tag == 'gallery') {
			return view('rashoveshi.pages.gallery');
		}
		$categoriesList = array(
			'news' => '1',
			'politics' => '2',
			'sports' => '3',
			'business' => '4',
			'report' => '5',
			'people' => '6',
			'environment' => '7',
			'history' => '8',
			'school' => '9',
		);
		$id = array_pull($categoriesList, $tag);

		$postsCount = 3;

		if (Poll::first()) {
			$postsCount = 12;
		}

		$posts['posts'] = $this->posts->PostsByTag($id, $take = $postsCount, $featured = 1);

		$recentPosts = $this->posts->where('tag', '!=', '15')
									->where('tag', '!=', '11')
									->NotFeatured()
									->multi('published')
									->take(6)->get();
		// return $posts;
		return view('rashoveshi.pages.category', compact('posts', 'recentPosts'));

	}

}
