<?php

use App\Tag;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder {
	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run() {
		//
		DB::table('tags')->delete();

		// protected $fillable = ['type_id', 'name', 'name_en','reference','reference_en','slug','cover',"cover_color","avatar","fields","parent_id","order"];

		// Khabaru
		// siyaasee
		// kulhivaru
		// viyafaari
		// report
		// meehun
		// thimaaveshi
		// thaareeh
		// skool
		//
		//
		// 1
		Tag::create([
			'type_id' => 1,
			'name' => 'ޚަބަރު',
			'name_en' => 'News',
			'slug' => 'news',
			'order' => 1,
			'layout' => 'badha.section.default',
		]);

		// 2
		Tag::create([
			'type_id' => 1,
			'name' => 'ސިޔާސީ',
			'name_en' => 'Politics',
			'slug' => 'politics',
			'order' => 2,
			'layout' => 'badha.section.default',
		]);

		// 3
		Tag::create([
			'type_id' => 1,
			'name' => 'ކުޅިވަރު',
			'name_en' => 'Sports',
			'slug' => 'sports',
			'order' => 3,
			'layout' => 'badha.section.default',
		]);

		//4
		Tag::create([
			'type_id' => 1,
			'name' => 'ވިޔަފާރި',
			'name_en' => 'Business',
			'slug' => 'business',
			'order' => 4,
			'layout' => 'badha.section.default',
		]);

		// 5
		Tag::create([
			'type_id' => 1,
			'name' => 'ރިޕޯޓް',
			'name_en' => 'Report',
			'slug' => 'report',
			'order' => 5,
			'layout' => 'badha.section.default',
		]);

		// 6
		Tag::create([
			'type_id' => 1,
			'name' => 'މީހުން',
			'name_en' => 'People',
			'slug' => 'people',
			'order' => 6,
			'layout' => 'badha.section.default',
		]);

		// 7
		Tag::create([
			'type_id' => 1,
			'name' => 'ތިމާވެށި',
			'name_en' => 'Environment',
			'slug' => 'environment',
			'order' => 7,
			'layout' => 'badha.section.default',
		]);

		// 8
		Tag::create([
			'type_id' => 1,
			'name' => 'ތާރީހް',
			'name_en' => 'History',
			'slug' => 'history',
			'order' => 8,
			'layout' => 'badha.section.default',
		]);

		Tag::create([
			'type_id' => 1,
			'name' => 'ސްކޫލް',
			'name_en' => 'School',
			'slug' => 'school',
			'order' => 9,
			'layout' => 'badha.section.default',
		]);

		$multimedia = Tag::create([
			'type_id' => 1,
			'name' => 'މަލްޓިމީޑިއާ',
			'name_en' => 'Multimedia',
			'slug' => 'multimedia',
			'order' => 10,
			'layout' => 'badha.section.default',
		]);

		// 26
		Tag::create([
			'type_id' => 1,
			'name' => 'ފޮޓޯ',
			'name_en' => 'Photo',
			'slug' => 'photo',
			'order' => 1,
			'parent_id' => $multimedia->id,
		]);

		// 27
		Tag::create([
			'type_id' => 1,
			'name' => 'ވީޑިއޯ',
			'name_en' => 'Video',
			'slug' => 'video',
			'order' => 1,
			'parent_id' => $multimedia->id,
		]);

		// 28
		Tag::create([
			'type_id' => 1,
			'name' => 'އޯޑިއޯ',
			'name_en' => 'Audio',
			'slug' => 'audio',
			'order' => 1,
			'parent_id' => $multimedia->id,
		]);

		// 29
		Tag::create([
			'type_id' => 1,
			'name' => 'އިންޓަރެކްޓިވް',
			'name_en' => 'Interactive',
			'slug' => 'interactive',
			'order' => 1,
			'parent_id' => $multimedia->id,
		]);

		// 30
		Tag::create([
			'type_id' => 1,
			'name' => 'ކޮލަމް',
			'name_en' => 'Column',
			'slug' => 'column',
			'order' => 0,
			'layout' => 'badha.section.default',
		]);

	}
}
