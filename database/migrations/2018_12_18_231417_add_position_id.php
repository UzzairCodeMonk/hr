<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPositionId extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('personaldetails', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('position_id')->unsigned()->nullable();
        });

        Schema::table('personaldetails', function (Blueprint $table) {
            $table->foreign('position_id')->references('id')->on('positions');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('personaldetails', function (Blueprint $table) {
            //
        });
    }
}
