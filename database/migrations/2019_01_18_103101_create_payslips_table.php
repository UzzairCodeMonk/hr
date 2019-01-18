<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePayslipsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('payslips', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('payslips_user_id_foreign');
			$table->integer('month')->nullable();
			$table->date('year')->nullable();
			$table->decimal('basic_salary', 13,2)->nullable();
			$table->decimal('allowance', 13,2)->nullable();
			$table->decimal('epf_employer', 13,2)->nullable();
			$table->decimal('epf_employee', 13,2)->nullable();
			$table->decimal('socso_employer', 13,2)->nullable();
			$table->decimal('socso_employee', 13,2)->nullable();
			$table->decimal('socso_eis_employer', 13,2)->nullable();
			$table->decimal('socso_eis_employee', 13,2)->nullable();
			$table->decimal('hrdf', 13,2)->nullable();
			$table->integer('upl_days')->nullable();
			$table->decimal('upl_amount', 13,2)->nullable();
			$table->decimal('income_tax', 13,2)->nullable();
			$table->decimal('total_earnings', 13,2)->nullable();
			$table->decimal('total_deductions', 13,2)->nullable();
			$table->decimal('net_wage', 13,2)->nullable();
			$table->text('remarks')->nullable();
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
		Schema::drop('payslips');
	}

}
