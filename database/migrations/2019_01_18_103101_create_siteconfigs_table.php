<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSiteconfigsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('siteconfigs', function(Blueprint $table)
		{
			$table->increments('id');
			$table->string('site_name')->nullable();
			$table->string('company_name')->nullable();
			$table->string('company_reg_no')->nullable();
			$table->string('mobile_number')->nullable();
			$table->string('phone_number')->nullable();
			$table->string('fax_number')->nullable();
			$table->string('email')->nullable();
			$table->string('logo')->nullable();
			$table->string('address_one')->nullable();
			$table->string('address_two')->nullable();
			$table->string('postcode')->nullable();
			$table->string('city')->nullable();
			$table->string('state')->nullable();
			$table->string('country')->nullable();
			$table->string('facebook')->nullable();
			$table->string('twitter')->nullable();
			$table->string('gmail')->nullable();
			$table->string('linkedin')->nullable();
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
		Schema::drop('siteconfigs');
	}

}
