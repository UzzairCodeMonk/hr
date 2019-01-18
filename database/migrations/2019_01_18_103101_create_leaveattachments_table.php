<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeaveattachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leaveattachments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('leave_id')->unsigned()->index('leaveattachments_leave_id_foreign');
			$table->string('filename');
			$table->string('filepath');
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
		Schema::drop('leaveattachments');
	}

}
