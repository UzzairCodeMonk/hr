<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AddForeignKeysToFamiliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('families', function(Blueprint $table)
		{
			$table->foreign('relationship_id')->references('id')->on('familytypes')->onUpdate('RESTRICT')->onDelete('RESTRICT');
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
		Schema::table('families', function(Blueprint $table)
		{
			$table->dropForeign('families_relationship_id_foreign');
			$table->dropForeign('families_user_id_foreign');
		});
	}

}
