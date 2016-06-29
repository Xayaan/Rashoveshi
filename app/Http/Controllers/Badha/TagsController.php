<?php

namespace App\Http\Controllers\Badha;
use App\Http\Requests\Tag\Create;
use App\Http\Requests\Tag\Update;
use App\Tag as Tag;
use App\TagType as TagType;
use Illuminate\Http\Request;

class TagsController extends AuthorizedController {

	protected $tags;

	protected $types;

	public function __construct(Tag $tags, TagType $types) {
		parent::__construct();
		$this->tags = $tags;
		$this->types = $types;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index(Request $request) {
		// return dd($this->tags);

		$types = $this->types->lists('name', 'id');

		if ($request->get('sort')) {
			$tags = $this->tags->where('type_id', $request->get('sort'))->paginate(10);
		} else {
			$tags = $this->tags->paginate(10);
		}

		return view('badha.tags.index', compact('tags', 'types'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$types = $this->types->lists('name', 'id');
		$tag = $this->tags;
		return view('badha.tags.form', compact('tag', 'types'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Create $request) {
		// Get the submited request data
		if ($request->input('parent_id') == '') {
			$request->merge(array('parent_id' => null));
		}
		$input = $request->all();
		// return dd($input);
		// Create the user
		$user = $this->tags->create($input);

		// Redirect to the users listing
		return redirect(route('tag.index'))->withSuccess(
			trans('tags/messages.success.create')
		);
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		// Get the user object
		if ($tag = $this->tags->find($id)) {

			$types = $this->types->lists('name', 'id');

			// Show the form
			return view('badha.tags.form', compact('tag', 'types'));
			// } else {
			// return redirect(route('badha.dashboard'))->withErrors(
			// 	trans('users/messages.no_access', compact('id'))
			// );
			// // }
		}

		// Redirect to the users listing
		return redirect(route('badha.dashboard'))->withErrors(
			trans('tags/messages.not_found', compact('id'))
		);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Update $request, $id) {
		// Get the tag object
		$tag = $this->tags->find($id);

		// Get the submited request data
		$input = $request->all();
		// Update the tags
		$tag->fill($input)->save();

		return redirect(route('tag.index'))->withSuccess(trans('tags/messages.success.update'));

	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function delete($id) {

		$tags = $this->tags->findOrfail($id);

		if ($tags->posts->isEmpty()) {
			if (!$tags->child->isEmpty()) {
				return redirect(route('tag.index'))->withErrors(trans('tags/messages.error.parent_tag'));
			}
			$tags->delete();
			// Redirect to the users listing
			return redirect(route('tag.index'))->withSuccess(trans('tags/messages.success.delete'));
		} else {
			return redirect(route('tag.index'))->withErrors(trans('tags/messages.error.attached_post'));

		}
		return redirect(route('tag.index'))->withErrors(trans('tags/messages.error.delete'));
	}

	public function search(Request $request) {
		// return "ww";
		$keyword = $request->input('text');
		$data = array('success' => null, 'results' => null);

		if (empty($keyword)) {
			return $data['success'] = false;
		} else {
			$results = Tag::search($keyword)->select('name', 'id as value', 'type_id', 'avatar')->with('type')->get();
			// return dd($results);
			foreach ($results as $key => $value) {
				$value->type->name;

				if ($value->avatar !== "") {
					$thumb = '<img class="ui avatar image" src="' . url() . "/profile/mini_" . $value->avatar . '">';
				} else {
					$thumb = '<img class="ui avatar image" src="' . url() . '/images/icons/tags-' . $value->type->name . '.png">';
				}

				$results[$key]['name'] = $thumb . " " . $value['name'];
			}

			$data['results'] = $results;

			return $data;
		}
	}
}
