<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLeaveattachmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leaveattachments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('leave_id')->unsigned();
            $table->foreign('leave_id')->references('id')->on('leaves')->onDelete('cascade');
            $table->string('filename');
            $table->string('filepath');
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
        Schema::dropIfExists('leaveattachments');
    }
}
