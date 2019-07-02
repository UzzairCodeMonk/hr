<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClaimdetailIdInClaimattachments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
    //     if(!Schema::hasColumn('claimattachments','claimdetail_id')){
    //     Schema::table('claimattachments', function (Blueprint $table) {
    //         $table->unsignedInteger('claimdetail_id');
    //         $table->foreign('claimdetail_id')->references('id')->on('claimdetails');
    //     });
    // }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('', function (Blueprint $table) {

        });
    }
}
