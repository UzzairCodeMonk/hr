<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateAcademicsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('academics', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('academics_user_id_foreign');
			$table->string('institution')->nullable();
			$table->string('study_level')->nullable();
			$table->date('start_date')->nullable();
			$table->date('end_date')->nullable();
			$table->string('course')->nullable();
			$table->string('result')->nullable();
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
		Schema::drop('academics');
	}

}
