<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePersonaldetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('personaldetails', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->string('name');
            $table->unsignedBigInteger('ic_number');
            $table->string('staff_number');
            $table->string('gender');
            $table->date('date_of_birth');
            $table->string('phone_number');
            $table->string('mobile_number');
            $table->string('alternative_email');
            $table->string('address_one');
            $table->string('address_two');
            $table->unsignedSmallInteger('postcode');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('motorcycle_reg_number');
            $table->string('car_reg_number');
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
        Schema::dropIfExists('personaldetails');
    }
}
