<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToLeavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('leaves', function(Blueprint $table)
		{
			$table->foreign('leavetype_id')->references('id')->on('leavetypes')->onUpdate('RESTRICT')->onDelete('CASCADE');
			$table->foreign('user_id')->references('id')->on('users')->onUpdate('RESTRICT')->onDelete('CASCADE');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('leaves', function(Blueprint $table)
		{
			$table->dropForeign('leaves_leavetype_id_foreign');
			$table->dropForeign('leaves_user_id_foreign');
		});
	}

}
