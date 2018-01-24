<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddComissionToRecruitingorderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recruitingorder', function (Blueprint $table) {
            $table->integer("commission_type")->nullable();
            $table->double("agent_commission_amount")->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recruitingorder', function (Blueprint $table) {
            //
        });
    }
}
