<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtracolumnToRecrutingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recruitingorder', function (Blueprint $table) {
//            $table->string('passportnumberbn')->nullable();
            $table->string('passportissuedate');
            $table->string('placeofissue')->nullable();

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
            $table->string('passportnumberbn');
            $table->string('passportissuedate');
            $table->string('placeofissue');

        });
    }
}
