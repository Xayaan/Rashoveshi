<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy

class UsersTableSeeder extends Seeder {
	public function run() {
		DB::table('users')->insert([
			'email' => 'mohamed.irshaam@gmail.com',
			'password' => bcrypt('welcome@123'),
			'first_name' => 'Mohamed',
			'middle_name' => 'Irshaam',
			'last_name' => 'Abdulla',
			'designation_id' => '1',
		]);

		DB::table('users')->insert([
			'email' => 'mauroof@rashoveshi.mv',
			'password' => bcrypt('welcome@123'),
			'first_name' => 'Ahmadh',
			'middle_name' => 'Mauroof',
			'last_name' => '',
			'designation_id' => '1',
		]);
	}
}
