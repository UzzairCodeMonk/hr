<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLeaveattachmentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('leaveattachments', function(Blueprint $table)
		{
			$table->foreign('leave_id')->references('id')->on('leaves')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('leaveattachments', function(Blueprint $table)
		{
			$table->dropForeign('leaveattachments_leave_id_foreign');
		});
	}

}
