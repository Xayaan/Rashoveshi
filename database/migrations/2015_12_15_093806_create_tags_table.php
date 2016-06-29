<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateTagsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('tags', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('type_id')->unsigned();
			$table->foreign('type_id')->references('id')->on('tag_types');
			$table->string('name');
			$table->string('name_en');

			$table->string('reference');
			$table->string('reference_en');

			$table->string('slug')->unique();
			$table->string('cover');
			$table->string('cover_color');
			$table->string('avatar');
			$table->string('og');
			$table->text('fields');
			$table->string('layout');
			$table->integer('order')->nullable()->unsigned();
			$table->integer('parent_id')->nullable()->unsigned();
			$table->foreign('parent_id')->references('id')->on('tags');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('tags');
	}
}
