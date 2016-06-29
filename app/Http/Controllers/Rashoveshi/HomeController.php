<?php

namespace App\Http\Controllers\Rashoveshi;

use App\Advs;
use App\Http\Controllers\Controller;
use App\Layout;
use App\Post;
use Meta;
use Log;

class HomeController extends Controller {

	protected $posts;

	protected $layouts;

	protected $advs;

	public function __construct(Post $posts, Layout $layouts, Advs $advs) {
		$this->posts = $posts;
		$this->layouts = $layouts;
		$this->advs = $advs;
	}

	public function index() {
		$categories = [];

		$categoriesList = array(
			'politics' => '2',
			'sports' => '3',
			'business' => '4',
			'report' => '5',
			'people' => '6',
			'environment' => '7',
			'school' => '9',
			'photo' => '11',
		);

		foreach ($categoriesList as $category => $id) {
			$categories[$category] = $this->posts->PostsByTag($id, $take = 4, $featured = 1);
		}

		$categories['column'] = $this->posts->PostsByTag(15, $take = 4);

		// where('tag', '!=', '15')->NotFeatured()->multi('published')->take(6)->get();
		// return $categories;

		Meta::title('Rashoveshi.mv');
		Meta::meta('description', 'rashoveshi');
		Meta::meta('image', asset('images/social/rashoveshi-default.png'));
		Meta::meta('twitter:image:src', asset('images/social/rashoveshi-default.png'));
		Meta::meta('url', 'http://rashoveshi.mv');

		$featuredPosts = $this->layouts->orderBy('id', 'desc')->with('p_1', 'p_2', 'p_3', 'p_4', 'p_breaking', 'p_live', 'p_developing')->first();

		// return $featuredPosts;
		// $recent= Post::where('tag','!=',26)->NotFeatured()->status("published")->select('id','heading','heading_latin','image','highlights','status','published_at')->take(7)->get();

		$recentPosts = $this->posts->where('tag', '!=', '15')->where('tag', '!=', '11')->NotFeatured()->multi('published')->take(6)->get();

		$oldPosts = $this->posts->NotFeatured()->multi('published')->take(9)->get();

		$advs = [];

		$advs['leaderboad'] = $this->advs->position('home', 'leaderboad')->get()->toArray();
		$advs['middleads_1'] = $this->advs->position('home', 'middleads_1')->get()->toArray();
		$advs['middleads_2'] = $this->advs->position('home', 'middleads_2')->get()->toArray();
		$advs['middleads_3'] = $this->advs->position('home', 'middleads_3')->get()->toArray();
		$advs['middleads_4'] = $this->advs->position('home', 'middleads_4')->get()->toArray();
		$advs['bottom'] = $this->advs->position('home', 'bottom')->get()->toArray();

		return view('rashoveshi.pages.home', compact('featuredPosts', 'recentPosts', 'categories', 'advs', 'oldPosts'));
	}

}