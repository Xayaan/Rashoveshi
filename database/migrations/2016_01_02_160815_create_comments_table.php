<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateCommentsTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('comments', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('post_id')->unsigned();
			$table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');
			$table->string("name");
			$table->text('comment');
			$table->integer('positive')->default(0);
			$table->integer('negative')->default(0);
			$table->string('ip');
			$table->integer('approved_by')->unsigned()->nullable()->default(null);
			$table->foreign('approved_by')->references('id')->on('users');
			$table->integer('parent')->nullable()->default(null);
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
		Schema::drop('comments');
	}
}
