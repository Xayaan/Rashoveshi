<?php
namespace App\Http\Controllers\Badha;

use App\Http\Requests\Permissions\Create;
use App\Http\Requests\Permissions\Update;
use App\Permission as Permission;
use App\Users as User;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;

class PermissionsController extends AuthorizedController {
	/**
	 * The Sentinel Activations repository.
	 *
	 * @var \Cartalyst\Sentinel\Activations\ActivationRepositoryInterface
	 */
	protected $permissions;

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
	public function __construct(Permission $permissions) {
		parent::__construct();

		Sentinel::setModel('Irshaam\Sentryo\Users');

		$this->roles = Sentinel::getRoleRepository();
		$this->users = Sentinel::getUserRepository();
		$this->permissions = $permissions;
		// $this->permissions = Sentryo::getPermissionsRepository();
		// $this->permissions = $permission
	}

	public function index() {

		$permissions = $this->permissions->paginate();
		return view('badha.permissions.index', compact('permissions'));
	}

	public function create() {
		$permission = $this->permissions;
		return view('badha.permissions.form', compact('permission'));
	}

	public function store(Create $request) {
		// Get the submited request data
		$input = $request->all();

		// Create the permission
		$permission = $this->permissions->create($input);

		return redirect(route('permissions.index'))->withSuccess(
			trans('permissions/messages.success.create')
		);
	}

	public function edit($id) {
		$permission = $this->permissions->find($id);
		return view('badha.permissions.form', compact('permission'));
	}

	public function update(Update $request, $id) {
		// Get the role object
		$permission = $this->permissions->find($id);

		// Get the submited request data
		$input = $request->all();

		// Update the role
		$permission->fill($input)->save();

		// Redirect to the roles listing
		return redirect(route('permissions.index'))->withSuccess(
			trans('permissions/messages.success.update')
		);
	}

	/**
	 * Removes the specified permission.
	 *
	 * @param  int  $id
	 * @return \Illuminate\Http\RedirectResponse
	 */
	public function delete($id) {
		// Get the role object
		$permission = $this->permissions->find($id);

		// Check if the role exists and there are no users attached
		if (!$this->currentUser->hasAccess([$permission->name])) {
			// Delete the role
			$permission->delete();

			// Redirect to the roles listing
			return redirect(route('permissions.index'))->withSuccess(
				trans('roles/messages.success.delete')
			);
		}

		// Redirect to the roles listing
		return redirect(route('permissions.index'))->withErrors(
			trans('roles/messages.error.delete')
		);
	}

}