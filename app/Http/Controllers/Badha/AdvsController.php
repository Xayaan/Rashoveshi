<?php

namespace App\Http\Controllers\Badha;

use App\Advs;
use App\Http\Requests\Adv\Create;
use Illuminate\Http\Request;

class AdvsController extends AuthorizedController {

	protected $advs;
	public function __construct(Advs $advs) {
		parent::__construct();

		$this->advs = $advs;

	}
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function index() {
		$advs = $this->advs->paginate();

		return view('badha.advs.index', compact('advs'));
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		$adv = $this->advs;
		return view('badha.advs.form', compact('adv'));
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @return \Illuminate\Http\Response
	 */
	public function store(Create $request) {
		$input = $request->all();

		$position = explode(',', $input['position']);
		$adv = $this->advs;
		$adv->name = $request->name;
		$adv->page = $position[0];
		$adv->position = $position[1];
		$adv->mobile = $request->mobile;
		$adv->desktop = $request->desktop;

		$adv = $adv->save();

		return redirect(route('adv.index'))->withSuccess(trans('advs/messages.success.create'));
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
		if ($adv = $this->advs->find($id)) {

			return view('badha.advs.form', compact('adv'));

		}
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function update(Request $request, $id) {
		if ($adv = $this->advs->find($id)) {

			$input = $request->all();
			$position = explode(',', $input['position']);

			$adv->name = $request->name;
			$adv->page = $position[0];
			$adv->position = $position[1];
			$adv->mobile = $request->mobile;
			$adv->desktop = $request->desktop;

			$adv = $adv->save();

			return redirect(route('adv.index'))->withSuccess(trans('advs/messages.success.update'));

		}
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\Response
	 */
	public function destroy($id) {
		if ($adv = $this->advs->find($id)) {
			$this->advs->destroy($id);

			return redirect(route('adv.index'))->withSuccess(trans('advs/messages.success.delete'));

		}
	}
}
