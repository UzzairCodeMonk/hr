<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateLeavesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('leaves', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('leaves_user_id_foreign');
			$table->integer('leavetype_id')->unsigned()->index('leaves_leavetype_id_foreign');
			$table->date('start_date');
			$table->date('end_date');
			$table->text('notes')->nullable();
			$table->integer('days_taken')->nullable();
			$table->integer('status_code')->unsigned()->nullable();
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
		Schema::drop('leaves');
	}

}
