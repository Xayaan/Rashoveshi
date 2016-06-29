<?php
namespace App\Http\Controllers\Badha;

use App\Designation;
use App\Http\Requests\User\Create;
use App\Http\Requests\User\Update;
use App\Users as User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class UsersController extends AuthorizedController {

	/**
	 * The Sentinel Activations repository.
	 *
	 * @var \Cartalyst\Sentinel\Activations\ActivationRepositoryInterface
	 */
	protected $activation;

	/**
	 * The Sentinel Roles repository.
	 *
	 * @var \Cartalyst\Sentinel\Roles\RoleRepositoryInterface
	 */
	protected $roles;

	/**
	 * The Sentinel Users repository.
	 *
	 * @var \Cartalyst\Sentinel\Users\UserRepositoryInterface
	 */
	protected $users;

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();

		Sentinel::setModel('App\Users');

		$this->roles = Sentinel::getRoleRepository();
		$this->users = Sentinel::getUserRepository();
		$this->activation = Sentinel::getActivationRepository();
	}

	/**
	 * Displays a listing of users.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index() {
		if ($this->currentUser->hasAccess(['user.*'])) {
			$users = $this->users->createModel()->paginate();
			return view('badha.users.index', compact('users'));
		}
		return redirect(route('badha.dashboard'))->withErrors(
			trans('users/messages.error.access_denied')
		);
	}

	/**
	 * Shows the form for creating new user.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create() {
		// Create a new user instance
		$user = $this->users->createModel();
		// The current user roles, empty since it's a new user :)
		$userRoles = [];
		// Get all the available roles
		$roles = $this->roles->lists('name', 'id');
		/** Get all Designations */
		$designations = Designation::lists('name', 'id');

		// Show the form
		return view('badha.users.form', compact('user', 'roles', 'userRoles', 'designations'));
	}

	/**
	 * Handles posting of the form for creating new user.
	 *
	 * @param  \App\Http\Requests\User\Create  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Create $request) {
		// Get the submited request data
		$input = $request->all();

		// Get the submitted roles
		$roles = array_get($input, 'roles', []);

		// Create the user
		$user = $this->users->create($input);

		// Activate the user automatically
		$this->activation->complete(
			$user, $this->activation->create($user)->code
		);

		// Handle the user roles
		$this->handleUserRoles($user, $roles);

		// Redirect to the users listing
		return redirect(route('users.index'))->withSuccess(
			trans('users/messages.success.create')
		);
	}

	public function edit($id) {

		// Get the user object
		if ($user = $this->users->find($id)) {

			if ($this->currentUser->hasAccess(['user.*']) || $this->currentUser->id == $id) {

				// The current user roles
				$userRoles = $user->roles->lists('id')->toArray();

				// Get all the available roles
				$roles = $this->roles->lists('name', 'id');

				/** Get all Designations */
				$designations = Designation::lists('name', 'id');

				$userDesignations = $user->designation->lists('id')->toArray();

				// Show the form
				return view('badha.users.form', compact('user', 'roles', 'userRoles', 'designations', 'userDesignations'));
			} else {
				return redirect(route('badha.dashboard'))->withErrors(
					trans('users/messages.no_access', compact('id'))
				);
			}
		}

		// Redirect to the users listing
		return redirect(route('badha.dashboard'))->withErrors(
			trans('users/messages.not_found', compact('id'))
		);
	}

	/**
	 * Handles posting of the form for updating user.
	 *
	 * @param  \App\Http\Requests\User\Update  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Update $request, $id) {
		try {
			// Get the user object
			$user = $this->users->find($id);

			// Get the submited request data
			$input = $request->all();

			// Check if we should remove the password from the
			// submitted data, this is because the password
			// is not required when updating a user.
			$input = array_where($input, function ($key, $value) {
				return (str_contains($key, 'password') && empty($value)) ? false : true;
			});

			// Get the submitted roles
			$roles = array_get($input, 'roles', []);

			// Update the user
			$this->users->update($user, $input);

			// Handle the user roles
			$this->handleUserRoles($user, $roles);

			// Redirect to the users listing
			if ($this->currentUser->hasAccess(['user.*'])) {
				return redirect(route('users.index'))->withSuccess(trans('users/messages.success.update'));
			} else {
				return redirect(route('badha.dashboard'))->withSuccess(trans('users/messages.success.update'));
			}

		} catch (NotUniquePasswordException $e) {
			return redirect()->back()->withInput()->withErrors(
				'The submitted password was used before. You must choose a different password.'
			);
		}
	}

	/**
	 * Removes the specified user.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id) {
		// Check if we're not deleting ourselves
		if ($this->currentUser->id != $id) {
			// Get the user object
			if ($user = $this->users->find($id)) {
				// Delete the user
				$user->delete();

				// Redirect to the users listing
				return redirect(route('users.index'))->withSuccess(
					trans('users/messages.success.delete')
				);
			}
		}

		// Redirect to the users listing
		return redirect(route('badha.users.index'))->withErrors(
			trans('users/messages.error.delete')
		);
	}

	/**
	 * Handles the processing of the given user roles.
	 *
	 * @param  \Cartalyst\Sentinel\Users\EloquentUser
	 * @param  array  $roles
	 * @return void
	 */
	protected function handleUserRoles(User $user, array $roles) {
		// Get the user roles
		$userRoles = $user->roles->lists('id')->toArray();

		// Prepare the roles to be added and removed
		$toAdd = array_diff($roles, $userRoles);
		$toDel = array_diff($userRoles, $roles);

		// Attach the user roles
		if (!empty($toAdd)) {
			$user->roles()->attach($toAdd);
		}

		// Detach the user roles
		if (!empty($toDel)) {
			$user->roles()->detach($toDel);
		}
	}
}
