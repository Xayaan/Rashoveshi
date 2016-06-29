<?php

namespace App\Http\Controllers\Badha;

class AdminPageController extends AuthorizedController {
	public function dashboard() {
		return view('badha.dashboard');
	}
}
