<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToChallanFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('challanform', function (Blueprint $table) {
            $table->double('rate_3')->nullable()->after('rate_2');
            $table->double('quantity_3')->nullable()->after('quantity_2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('challanform', function (Blueprint $table) {
            //
        });
    }
}
