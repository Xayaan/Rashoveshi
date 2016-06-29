<?php

namespace App\Http\Controllers\Badha;

use App\Http\Requests\Layout as LayoutRequest;
use App\Layout;
use App\Post;
use Illuminate\Http\Request;

class LayoutController extends AuthorizedController {

	protected $posts;

	protected $layouts;

	public function __construct(Post $posts, Layout $layouts) {
		parent::__construct();
		$this->posts = $posts;
		$this->layouts = $layouts;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {

		$posts = $this->posts->multi('published')->take(20)->get();
		$layout = Layout::orderBy('id', 'desc')->take(10)->with('created_by')->first();
		// return $last;
		if (empty($layout)) {
			$layout = array("type" => "normal", "pos_1" => null, "pos_2" => null, "pos_3" => null, "pos_4" => null, "pos_5" => null, "breaking" => null, "live" => null, "developing" => null);
		}

		$layouts = $this->layouts->all();
		return view('badha.layouts.form', compact('posts', 'layout', 'layouts'));

	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(LayoutRequest $request) {

		$positions = array("pos_1", "pos_2", "pos_3", "pos_4", "pos_5", "breaking", "live", "developing");
		foreach ($positions as $position) {
			if ($request[$position] == "") {
				$request[$position] = null;
			}
		}

		$input = $request->all();

		$layout = $this->layouts->create($input);

		return redirect(route('layout.index'))->withSuccess(
			trans('tags/messages.success.create')
		);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		//
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		//
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		//
	}
}
