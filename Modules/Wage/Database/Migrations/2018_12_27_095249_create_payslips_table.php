<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payslips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->integer('month')->nullable();
            $table->year('year')->nullable();
            $table->decimal('basic_salary', 13, 2)->nullable();
            $table->decimal('allowance', 13, 2)->nullable();
            $table->decimal('epf_employer', 13, 2)->nullable();
            $table->decimal('epf_employee', 13, 2)->nullable();
            $table->decimal('socso_employer', 13, 2)->nullable();
            $table->decimal('socso_employee', 13, 2)->nullable();
            $table->decimal('socso_eis', 13, 2)->nullable();
            $table->decimal('income_tax', 13, 2)->nullable();
            $table->decimal('total_earnings', 13, 2)->nullable();
            $table->decimal('total_deductions', 13, 2)->nullable();
            $table->decimal('net_wage', 13, 2)->nullable();
            $table->text('remarks')->nullable();
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
        Schema::dropIfExists('payslips');
    }
}
