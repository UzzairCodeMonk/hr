<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCenterHolidayTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('center_holiday')){
        Schema::create('center_holiday', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('center_id');
            $table->foreign('center_id')->references('id')->on('centers');
            $table->unsignedInteger('day_id');
            $table->foreign('day_id')->references('id')->on('days');
            $table->timestamps();
        });
    }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('center_holiday');
    }
}
