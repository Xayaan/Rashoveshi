<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePostsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('posts', function (Blueprint $table) {
			$table->increments('id');
			$table->string('heading');
			$table->string('heading_detailed');
			$table->string('heading_latin');
			$table->text('summary');
			$table->longText('content');
			$table->longText('content_text');
			$table->string('image');
			$table->integer('tag')->nullable()->unsigned()->default(null);
			$table->foreign('tag')->references('id')->on('tags');
			$table->integer('created_by')->unsigned();
			$table->foreign('created_by')->references('id')->on('authors');
			$table->integer('status')->default(0);
			$table->enum('language', ['dv', 'en'])->default('dv');
			$table->datetime('published_at')->nullable();
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
		Schema::drop('posts');
	}
}
