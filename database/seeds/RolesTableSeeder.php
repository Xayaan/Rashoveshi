<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy

class RolesTableSeeder extends Seeder {
	public function run() {
		DB::table('roles')->insert([
			'name' => 'Administrator',
			'slug' => 'administrator',
			'permissions' => '{
                "user.create" : true,
                "user.delete" : true,
                "user.edit"   : true,
                "user.update" : true
            }',
		]);

		DB::table('roles')->insert([
			'name' => 'User',
			'slug' => 'user',
			'permissions' => '{
                "profile.view"   : true,
                "profile.update" : true
            }',
		]);

		DB::table('roles')->insert([
			'name' => 'Writer',
			'slug' => 'writer',
			'permissions' => '{
                "post.create"   : true,
                "post.edit"     : true,
                "post.update"   : false,
                "post.delete"   : false,
                "post.review"   : false,
                "post.publish"  : false
            }',
		]);

		DB::table('roles')->insert([
			'name' => 'Editor',
			'slug' => 'editor',
			'permissions' => '{
                "post.create"   : true,
                "post.edit"     : true,
                "post.update"   : true,
                "post.delete"   : true,
                "post.review"   : true,
                "post.publish"  : true
            }',
		]);
	}
}
