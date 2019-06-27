<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateClaimattachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('claimattachments')){
        Schema::create('claimattachments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('claim_id');
            $table->foreign('claim_id')->references('id')->on('claims');
            $table->text('filename')->nullable();
            $table->text('filepath')->nullable();            
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
        Schema::dropIfExists('claimattachments');
    }
}
