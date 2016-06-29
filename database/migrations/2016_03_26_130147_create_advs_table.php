<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAdvsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('advs', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('page'); // HOME, SECTIONS, ARTICLE, GALLERY
			$table->string('position');
			$table->string('desktop');
			$table->string('mobile');
			$table->integer('status')->default(0);
			$table->softDeletes();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('advs');
	}
}
