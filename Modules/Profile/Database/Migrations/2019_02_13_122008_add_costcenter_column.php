<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCostcenterColumn extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('personaldetails', function (Blueprint $table) {
            $table->unsignedInteger('center_id');
        });

        Schema::table('personaldetails', function (Blueprint $table) {
            $table->foreign('center_id')->references('id')->on('centers');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
    }
}
