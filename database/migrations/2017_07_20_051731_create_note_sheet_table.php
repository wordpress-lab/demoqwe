<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoteSheetTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('note_sheet', function (Blueprint $table) {
            $table->increments('id');
            $table->string('countryGender');
            $table->string('applicationDate');
            $table->string('sourceIncomeTax')->nullable();
            $table->string('welfareFee')->nullable();
            $table->string('payOrderNumber')->nullable();
            $table->string('chalanNumber')->nullable();
            $table->string('infoAttestation')->nullable();
            $table->string('payOrderDate')->nullable();
            $table->string('chalanDate')->nullable();
            $table->string('certificateAttestation')->nullable();
            $table->string('payOrderAmount')->nullable();
            $table->string('chalanAmount')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
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
        Schema::dropIfExists('note_sheet');
    }
}
