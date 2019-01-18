<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLeavebalancesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('leavebalances', function(Blueprint $table)
		{
			$table->foreign('leavetype_id', 'leaverecords_leavetype_id_foreign')->references('id')->on('leavetypes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
			$table->foreign('user_id', 'leaverecords_user_id_foreign')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('leavebalances', function(Blueprint $table)
		{
			$table->dropForeign('leaverecords_leavetype_id_foreign');
			$table->dropForeign('leaverecords_user_id_foreign');
		});
	}

}
