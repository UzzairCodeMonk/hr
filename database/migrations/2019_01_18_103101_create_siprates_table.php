<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSipratesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('siprates', function(Blueprint $table)
		{
			$table->increments('id');
			$table->decimal('min_salary', 13,2)->nullable();
			$table->decimal('max_salary', 13,2)->nullable();
			$table->decimal('sip_employer_contribution', 13,2)->nullable();
			$table->decimal('sip_employee_contribution', 13,2)->nullable();
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
		Schema::drop('siprates');
	}

}
