<?php

namespace App\Http\Controllers\Badha;

use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class BaseController extends Controller {
	/**
	 * The logged in user.
	 *
	 * @var \Cartalyst\Sentinel\Users\UserInterface
	 */
	protected $currentUser;

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		$this->beforeFilter('csrf', ['on' => 'post']);

		$this->currentUser = Sentinel::getUser();

		view()->share(['currentUser' => $this->currentUser]);
	}

	/**
	 * Setup the layout used by the controller.
	 *
	 * @return void
	 */
	protected function setupLayout() {
		if (!is_null($this->layout)) {
			$this->layout = view($this->layout);
		}
	}
}
