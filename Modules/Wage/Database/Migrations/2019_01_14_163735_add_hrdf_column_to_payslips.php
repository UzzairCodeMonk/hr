<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHrdfColumnToPayslips extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
        Schema::table('payslips', function (Blueprint $table) {
            if(!Schema::hasColumn('hrdf','socso_eis_employee')){
                $table->decimal('hrdf',13,2)->nullable()->after('socso_eis_employee');
            }
           
        });
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
