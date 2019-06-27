<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('claimtypes')){
        Schema::create('claimtypes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(); 
            $table->timestamps();
        });
        }
        
        if(!Schema::hasTable('claims')){
        Schema::create('claims', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('claimtype_id');
            $table->foreign('claimtype_id')->references('id')->on('claimtypes');
            $table->string('date')->nullable();
            $table->text('remarks')->nullable();            
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
        Schema::dropIfExists('claims');
    }
}
