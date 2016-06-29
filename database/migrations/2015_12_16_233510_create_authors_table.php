<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAuthorsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('authors', function (Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('name_en');
			$table->mediumText('description');
			$table->mediumText('description_en');
			$table->string('post');
			$table->string('post_en');
			$table->string('twitter');
			$table->string('facebook');
			$table->string('avatar');
			$table->integer('user_id')->nullable()->unsigned()->default(NULL);
			$table->foreign('user_id')->references('id')->on('users');
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('authors');
	}
}
