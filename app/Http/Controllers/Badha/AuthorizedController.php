<?php

namespace App\Http\Controllers\Badha;

class AuthorizedController extends BaseController {
	/**
	 * Constructor
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();

		$this->middleware('auth');

	}
}
