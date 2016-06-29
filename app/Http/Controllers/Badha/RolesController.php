<?php

namespace App\Http\Controllers\Badha;

use App\Http\Requests\Role\Create;
use App\Http\Requests\Role\Update;
use App\Permission;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class RolesController extends AuthorizedController {
	/**
	 * The Sentinel Roles repository.
	 *
	 * @var \Cartalyst\Sentinel\Roles\RoleRepositoryInterface
	 */
	protected $roles;

	/**
	 * Constructor.
	 *
	 * @return void
	 */
	public function __construct() {
		parent::__construct();
		Sentinel::setModel('App\Roles');
		$this->roles = Sentinel::getRoleRepository();
	}

	/**
	 * Displays a listing of roles.
	 *
	 * @return \Illuminate\View\View
	 */
	public function index() {
		$roles = $this->roles->createModel()->paginate();

		return view('badha.roles.index', compact('roles'));
	}

	/**
	 * Shows the form for creating a new role.
	 *
	 * @return \Illuminate\View\View
	 */
	public function create() {
		// Create a new role instance
		$role = $this->roles->createModel();
		$permissions = Permission::all();

		// Show the form
		return view('badha.roles.form', compact('role', 'permissions'));
	}

	/**
	 * Handles posting of the form for creating a new role.
	 *
	 * @param  \App\Http\Requests\Role\Create  $request
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function store(Create $request) {
		// Get the submited request data
		$input = $request->all();

		$permissions = array_get($input, 'permissions', []);

		foreach ($permissions as $key => $value) {
			if ($value == "true") {
				$permissions[$key] = true;
			} else {
				$permissions[$key] = false;

			}
		}

		// Create the role
		$role = $this->roles->createModel()->create($input);

		$role = Sentinel::findRoleById($role->id);

		// return $permissions;
		$role->permissions = $permissions;

		$role->save();

		// Redirect to the roles listing
		return redirect(route('roles.index'))->withSuccess(
			trans('roles/messages.success.create')
		);
	}

	/**
	 * Shows the form for updating a role.
	 *
	 * @param  int  $id
	 * @return \Illuminate\View\View|\Illuminate\Http\RedirectResponse
	 */
	public function edit($id) {
		// Get the role object
		if ($role = $this->roles->createModel()->find($id)) {

			$permissions = Permission::all();
			return view('badha.roles.form', compact('role', 'permissions'));
		}

		// Redirect to the roles listing
		return redirect(route('roles.index'))->withErrors(
			trans('roles/messages.not_found', compact('id'))
		);
	}

	/**
	 * Handles posting of the form for updating a role.
	 *
	 * @param  \App\Http\Requests\Role\Update  $request
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function update(Update $request, $id) {
		// Get the role object
		$role = $this->roles->createModel()->find($id);

		// Get the submited request data
		$input = $request->all();

		$permissions = array_get($input, 'permissions', []);

		foreach ($permissions as $key => $value) {
			if ($value == "true") {
				$permissions[$key] = true;
			} else {
				$permissions[$key] = false;

			}
		}

		// Update the role
		$role->fill($input)->save();

		$role = Sentinel::findRoleById($id);

		$role->permissions = $permissions;

		$role->save();

		// Redirect to the roles listing
		return redirect(route('roles.index'))->withSuccess(
			trans('roles/messages.success.update')
		);
	}

	/**
	 * Removes the specified role.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id) {
		// Get the role object
		$role = $this->roles->createModel()->find($id);

		// Check if the role exists and there are no users attached
		if ($role && $role->users->count() === 0) {
			// Delete the role
			$role->delete();

			// Redirect to the roles listing
			return redirect(route('roles.index'))->withSuccess(
				trans('roles/messages.success.delete')
			);
		}

		// Redirect to the roles listing
		return redirect(route('roles.index'))->withErrors(
			trans('roles/messages.error.delete')
		);
	}
}
