<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAirlineTaxRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('airlinetaxs', function(Blueprint $table){

            $table->foreign('airline_id')->references('id')->on('airlines')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tickettax_id')->references('id')->on('tickettaxs')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
