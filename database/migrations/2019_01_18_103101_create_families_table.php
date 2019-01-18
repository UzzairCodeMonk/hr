<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateFamiliesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('families', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('user_id')->unsigned()->index('families_user_id_foreign');
			$table->integer('relationship_id')->unsigned()->index('families_relationship_id_foreign');
			$table->string('name');
			$table->bigInteger('ic_number');
			$table->bigInteger('mobile_number');
			$table->string('occupation')->nullable();
			$table->string('income_tax_number')->nullable();
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
		Schema::drop('families');
	}

}
