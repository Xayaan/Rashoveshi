<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLayoutTable extends Migration {
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up() {
		Schema::create('layouts', function (Blueprint $table) {
			$table->increments('id');

			$table->string('type');

			$table->integer('pos_1')->nullable()->unsigned()->default(null);
			$table->foreign('pos_1')->references('id')->on('posts');

			$table->integer('pos_2')->nullable()->unsigned()->default(null);
			$table->foreign('pos_2')->references('id')->on('posts');

			$table->integer('pos_3')->nullable()->unsigned()->default(null);
			$table->foreign('pos_3')->references('id')->on('posts');

			$table->integer('pos_4')->nullable()->unsigned()->default(null);
			$table->foreign('pos_4')->references('id')->on('posts');

			$table->integer('breaking')->nullable()->unsigned()->default(null);
			$table->foreign('breaking')->references('id')->on('posts');

			$table->integer('developing')->nullable()->unsigned()->default(null);
			$table->foreign('developing')->references('id')->on('posts');

			$table->integer('live')->nullable()->unsigned()->default(null);
			$table->foreign('live')->references('id')->on('posts');

			$table->integer('user_id')->unsigned();
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
		Schema::drop('layouts');
	}
}
