<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColoumOvertimeAmountPerHourToPmsEmployee extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pms__employees', function (Blueprint $table) {
            $table->string('overtime_amount_per_hour')->nullable()->after('daily_work_hour');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pms__employees', function (Blueprint $table) {
            //
        });
    }
}
