<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamcaReceiveSubmitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamca_receive_submit', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('medical_slip_form_id')->unsigned();
            $table->tinyInteger('received_status')->nullable();
            $table->tinyInteger('submitted_status')->nullable();
            $table->tinyInteger('pax_id')->unsigned()->nullable();
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
        Schema::dropIfExists('gamca_receive_submit');
    }
}
