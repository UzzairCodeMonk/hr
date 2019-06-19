<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddAvailableAnnualleaveToLeaveEntitlements extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('leave_entitlements', function (Blueprint $table) {
            //
            $table->integer('available_annualleave')->after('days')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('leave_entitlements', function (Blueprint $table) {
            //
            $table->dropColumn('available_annualleave');
        });
    }
}
