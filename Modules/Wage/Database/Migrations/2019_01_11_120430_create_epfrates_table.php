<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEpfratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('epfrates', function (Blueprint $table) {
            $table->increments('id');
            $table->decimal('start_amount', 13, 2)->nullable();
            $table->decimal('final_amount', 13, 2)->nullable();
            $table->decimal('employer_contrib', 13, 2)->nullable();
            $table->decimal('employee_contrib', 13, 2)->nullable();
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
        Schema::dropIfExists('epfrates');
    }
}
