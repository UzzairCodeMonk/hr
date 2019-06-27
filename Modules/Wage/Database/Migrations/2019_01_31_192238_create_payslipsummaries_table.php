<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayslipsummariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('payslipsummaries')){
        Schema::create('payslipsummaries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('month')->nullable;
            $table->year('year')->nullable();
            $table->decimal('basic_of_month',13,2)->nullable();
            $table->decimal('allowance',13,2)->nullable();
            $table->decimal('epf_employer',13,2)->nullable();
            $table->decimal('epf_employee',13,2)->nullable();
            $table->decimal('socso_employer',13,2)->nullable();
            $table->decimal('socso_employee',13,2)->nullable();
            $table->decimal('eis_employee',13,2)->nullable();
            $table->decimal('eis_employer',13,2)->nullable();
            $table->decimal('employer_expenses',13,2)->nullable();
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
        Schema::dropIfExists('payslipsummaries');
    }
}
