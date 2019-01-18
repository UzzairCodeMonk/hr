<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateEpfratesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('epfrates', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->decimal('min_salary', 13,2)->default(0.00);
			$table->decimal('max_salary', 13,2)->default(0.00);
			$table->decimal('employer_contribution', 13,2)->default(0.00);
			$table->decimal('employee_contribution', 13,2)->default(0.00);
			$table->decimal('total_contribution', 13,2)->default(0.00);
			$table->decimal('employer_contribution_60', 13,2)->nullable()->default(0.00);
			$table->decimal('employee_contribution_60', 13,2)->nullable()->default(0.00);
			$table->decimal('total_contribution_60', 13,2)->nullable()->default(0.00);
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
		Schema::drop('epfrates');
	}

}
