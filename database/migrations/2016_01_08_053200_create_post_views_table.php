<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostViewsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('post_views', function (Blueprint $table) {
			$table->integer('post_id')->unsigned()->unique();
			$table->foreign('post_id')->references('id')->on('posts');
			$table->bigInteger('views');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down() {
		Schema::drop('post_views');
	}
}
