<?php

use App\Author;
use Illuminate\Database\Seeder;

class AuthorTableSeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		Author::create([
			'name' => 'އަޙްމަދު މައުރޫފް',
			'name_en' => 'Ahmadh Mauroof',
			'post' => 'ެއެޑިޓަރު',
			'post_en' => 'Editor',
			'avatar' => 'mauroof.jpg',
			'user_id' => '2',
		]);
	}
}
