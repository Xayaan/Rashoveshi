<?php
namespace App\Http\Controllers\Badha;

use App\Http\Requests\Authenticate;
use Cartalyst\Sentinel\Checkpoints\NotActivatedException;
use Cartalyst\Sentinel\Checkpoints\ThrottlingException;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class AuthController extends BaseController {
	/**
	 * Show the form for logging the user in.
	 *
	 * @return \Illuminate\View\View
	 */
	public function login() {
		// $connections = array_filter(Social::getConnections(), function ($connection) {
		//     return ($connection['identifier'] && $connection['secret']);
		// });

		return view('badha.auth.form');
	}

	/**
	 * Handle posting of the form for logging the user in.
	 *
	 * @param  \App\Http\Requests\Authenticate  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function auth(Authenticate $request) {

		try {
			// Get the submited request data
			$input = $request->all();

			// Remember me flag for authentication
			// $remember = (bool) array_pull($input, 'remember', false);

			// Authenticate the user
			if (Sentinel::authenticate($input)) {
				return redirect()->route('badha.dashboard')->withSuccess(
					'Successfully logged in.'
				);
			}

			$errors = 'Invalid login or password.';
		} catch (NotActivatedException $e) {
			$errors = 'Account is not activated!';
		} catch (ThrottlingException $e) {
			$delay = $e->getDelay();

			$errors = "Your account is blocked for {$delay} second(s).";
		}

		return redirect()->back()->withInput()->withErrors($errors);
	}

	/**
	 * Logs the user out.
	 *
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function logout() {
		Sentinel::logout();

		return redirect(route('user.login'));
	}
}
