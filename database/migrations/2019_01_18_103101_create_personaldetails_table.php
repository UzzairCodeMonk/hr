<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatePersonaldetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('personaldetails', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('personaldetails_user_id_foreign');
			$table->string('avatar')->nullable();
			$table->string('name')->nullable();
			$table->bigInteger('ic_number')->unsigned()->nullable();
			$table->string('staff_number')->nullable();
			$table->string('socso_id')->nullable();
			$table->string('epf_id')->nullable();
			$table->string('bank_account_number')->nullable();
			$table->integer('bank_id')->unsigned()->nullable()->index('personaldetails_bank_id_foreign');
			$table->string('gender')->nullable();
			$table->date('date_of_birth')->nullable();
			$table->string('marital_status')->nullable();
			$table->date('date_of_marriage')->nullable();
			$table->string('phone_number')->nullable();
			$table->string('mobile_number')->nullable();
			$table->string('alternative_email')->nullable();
			$table->string('address_one')->nullable();
			$table->string('address_two')->nullable();
			$table->smallInteger('postcode')->unsigned()->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('country')->nullable();
			$table->string('motorcycle_reg_number')->nullable();
			$table->string('car_reg_number')->nullable();
			$table->timestamps();
			$table->integer('position_id')->unsigned()->nullable()->index('personaldetails_position_id_foreign');
			$table->string('status')->nullable();
			$table->date('join_date')->nullable();
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('personaldetails');
	}

}
