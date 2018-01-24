<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnRelationalPassengerToIqamarecipient extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iqamarecipient', function (Blueprint $table) {
            $table->string('relational_passenger')->nullable()->after('recipient_name');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iqamarecipient', function (Blueprint $table) {
            //
        });
    }
}
