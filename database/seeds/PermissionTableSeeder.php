<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy

class PermissionTableSeeder extends Seeder {
	public function run() {
		DB::table('permissions')->insert([
			'name' => 'user.create',
			'description' => 'create a new user',
		]);

		DB::table('permissions')->insert([
			'name' => 'user.edit',
			'description' => 'edit a user',
		]);

		DB::table('permissions')->insert([
			'name' => 'user.update',
			'description' => 'update a user',
		]);

		DB::table('permissions')->insert([
			'name' => 'user.delete',
			'description' => 'delete a user',
		]);

		DB::table('permissions')->insert([
			'name' => 'profile.view',
			'description' => 'view user profile',
		]);

		DB::table('permissions')->insert([
			'name' => 'profile.update',
			'description' => 'update a user profile',
		]);

		/** Post Permissions */
		DB::table('permissions')->insert([
			'name' => 'post.create',
			'description' => 'create a new post',
		]);

		DB::table('permissions')->insert([
			'name' => 'post.edit',
			'description' => 'edit a post',
		]);

		DB::table('permissions')->insert([
			'name' => 'post.update',
			'description' => 'update a post',
		]);

		DB::table('permissions')->insert([
			'name' => 'post.delete',
			'description' => 'delete a post',
		]);

		DB::table('permissions')->insert([
			'name' => 'post.review',
			'description' => 'review a post',
		]);

		DB::table('permissions')->insert([
			'name' => 'post.publish',
			'description' => 'publish post',
		]);

	}
}
