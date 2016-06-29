<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Sentinel;
use Closure;

class AuthPermission {
	/**
	 * The Sentinel instance.
	 *
	 * @var \Cartalyst\Sentinel\Sentinel
	 */
	protected $auth;

	/**
	 * Create a new filter instance.
	 *
	 * @param  \Cartalyst\Sentinel\Sentinel  $auth
	 * @return void
	 */
	public function __construct(Sentinel $auth) {
		$this->auth = $auth;
	}

	/**
	 * Handle an incoming request.
	 *
	 * @param  \Illuminate\Http\Request  $request
	 * @param  \Closure  $next
	 * @return mixed
	 */
	public function handle($request, Closure $next, $permissions) {
		if ($this->auth->guest()) {
			if ($request->ajax()) {
				return response('Unauthorized.', 401);
			}

			return redirect()->guest('login')->withErrors(['You must login first.']);
		}

		if ($this->auth->check() && $this->auth->hasAccess($permissions)) {
			return $next($request);
		}

		return redirect()->to('/')->withErrors(['Access Denied']);
		// if (! $this->auth->hasAccess('admin')) {
		// }

	}
}
