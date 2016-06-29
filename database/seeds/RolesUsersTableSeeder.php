<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy

class RolesUsersTableSeeder extends Seeder {
	public function run() {
		DB::table('role_users')->insert([
			'user_id' => '1',
			'role_id' => '1',
		]);

		DB::table('role_users')->insert([
			'user_id' => '1',
			'role_id' => '2',
		]);

		DB::table('role_users')->insert([
			'user_id' => '2',
			'role_id' => '2',
		]);

		DB::table('role_users')->insert([
			'user_id' => '2',
			'role_id' => '3',
		]);

		DB::table('role_users')->insert([
			'user_id' => '1',
			'role_id' => '4',
		]);
	}
}
