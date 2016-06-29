<?php

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Model::unguard();

		$this->call(DesignationsTableSeeder::class);
		$this->call(RolesTableSeeder::class);
		$this->call(UsersTableSeeder::class);
		$this->call(RolesUsersTableSeeder::class);
		$this->call(ActivationsTableSeeder::class);
		$this->call(PermissionTableSeeder::class);
		$this->call(TagTypeTableSeeder::class);
		$this->call(CategorySeeder::class);
		$this->call(AuthorTableSeeder::class);

		Model::reguard();
	}
}
