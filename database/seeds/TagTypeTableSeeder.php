<?php

use App\TagType;
use Illuminate\Database\Seeder;

class TagTypeTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//
		DB::table('tag_types')->delete();
		TagType::create([
			'name' => 'Category',
			'fields' => 'visibility:text',
		]);

		TagType::create([
			'name' => 'Topics',
			'fields' => '',
		]);

		TagType::create([
			'name' => 'People',
			'fields' => '',
		]);

		TagType::create([
			'name' => 'Organization',
			'fields' => 'phone:text,web:text,geo:text',
		]);

		TagType::create([
			'name' => 'Business',
			'fields' => 'phone:text,web:text,geo:text',
		]);

		TagType::create([
			'name' => 'Place',
			'fields' => 'road:text,phone:text,web:text,geo:text',
		]);

		TagType::create([
			'name' => 'Location',
			'fields' => 'geo:text',
		]);

		TagType::create([
			'name' => 'Event',
			'fields' => '',
		]);

		TagType::create([
			'name' => 'System',
			'fields' => '',
		]);

	}
}