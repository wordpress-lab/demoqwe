<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisaformagreementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visaformagreement', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visaform_id')->unsigned();
            $table->text('agreementEn')->nullable();
            $table->text('agreementAr')->nullable();
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
        Schema::dropIfExists('visaformagreement');
    }
}
