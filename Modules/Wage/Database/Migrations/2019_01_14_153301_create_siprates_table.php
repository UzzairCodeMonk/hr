<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSipratesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('siprates')){
            Schema::create('siprates', function (Blueprint $table) {
                $table->increments('id');
                $table->decimal('min_salary',13,2)->nullable();
                $table->decimal('max_salary',13,2)->nullable();
                $table->decimal('sip_employer_contribution',13,2)->nullable();
                $table->decimal('sip_employee_contribution',13,2)->nullable();
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
        Schema::dropIfExists('siprates');
    }
}
