<?php

namespace App\Http\Controllers\Badha;

use App\Author;
use App\Http\Requests\Author\Create;
use App\Users;
use Illuminate\Http\Request;

class AuthorsController extends AuthorizedController {

	protected $users;

	protected $author;

	public function __construct(Users $users, Author $author) {
		parent::__construct();

		$this->users = $users;
		$this->authors = $author;
	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$authors = $this->authors->paginate();

		return view('badha.authors.index', compact('authors'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		// $users = $this->users->lists('email', 'id');
		$users = $this->users->Unassociated();
		$users = array_add($users, '', 'Select User');

		// return $users;

		$author = $this->authors;

		return view('badha.authors.form', compact('users', 'author'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Create $request) {

		if ($request->input('user_id') == '') {
			$request->merge(array('user_id' => null));
		}

		$input = $request->all();

		$author = $this->authors->create($input);

		// Redirect to the users listing
		return redirect(route('author.index'))->withSuccess(
			trans('authors/messages.success.create')
		);
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function show($id) {

	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function edit($id) {
		if ($author = $this->authors->find($id)) {

			$users = $this->users->Unassociated();

			// return dd($author->user);
			if ($author->user !== null) {
				$username = $author->user->first_name . ' ' . $author->user->middle_name . ' ' . $author->user->last_name;
				$userid = $author->user->id;
				$users = array_add($users, $userid, $username);
			}
			$users = array_add($users, '', 'Select User');

		}

		return view('badha.authors.form', compact('author', 'users'));

	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		$author = $this->authors->find($id);

		if ($request->input('user_id') == 'null') {
			$request->merge(array('user_id' => null));
		}

		$input = $request->all();

		// Get the submited request data
		$input = $request->all();
		// Update the tags
		$author->fill($input)->save();

		return redirect(route('author.index'))->withSuccess(trans('authors/messages.success.update'));
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
