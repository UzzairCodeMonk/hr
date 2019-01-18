<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToPersonaldetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('personaldetails', function(Blueprint $table)
		{
			$table->foreign('bank_id')->references('id')->on('banks')->onUpdate('CASCADE')->onDelete('RESTRICT');
			$table->foreign('position_id')->references('id')->on('positions')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
		Schema::table('personaldetails', function(Blueprint $table)
		{
			$table->dropForeign('personaldetails_bank_id_foreign');
			$table->dropForeign('personaldetails_position_id_foreign');
			$table->dropForeign('personaldetails_user_id_foreign');
		});
	}

}
