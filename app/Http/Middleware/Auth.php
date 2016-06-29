<?php

namespace App\Http\Middleware;

use Cartalyst\Sentinel\Sentinel;
use Closure;

class Auth {
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
	public function handle($request, Closure $next) {
		if ($this->auth->guest()) {
			if ($request->ajax()) {
				return response('Unauthorized.', 401);
			}

			return redirect()->guest('login')->withErrors(['You must login first.']);
		}

		return $next($request);
	}
}
