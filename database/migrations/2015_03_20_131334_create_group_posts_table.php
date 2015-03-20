<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGroupPostsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('group_posts', function(Blueprint $table)
		{
			$table->increments('id')->unique();
			$table->string('title', 60);
			$table->text('content');
			$table->text('code');

			$table->string('lang');
			$table->foreign('lang')
				  ->references('name')
				  ->on('langs');

			$table->integer('user_id')->unsigned();
			$table->foreign('user_id')
				  ->references('id')
				  ->on('users');

			$table->integer('group_id')->unsigned();
			$table->foreign('group_id')
				  ->references('id')
				  ->on('groups');

			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('group_posts');
	}

}
