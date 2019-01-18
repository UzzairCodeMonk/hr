<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSocsoratesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('socsorates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->decimal('min_salary', 13,2)->nullable();
			$table->decimal('max_salary', 13,2)->nullable();
			$table->decimal('employer_contribution', 13,2)->nullable();
			$table->decimal('employee_contribution', 13,2)->nullable();
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
		Schema::drop('socsorates');
	}

}
