<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImmigrationClearanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('immigration_clearance', function (Blueprint $table) {
            $table->increments('id');
            $table->string('applicationDate')->nullable();
            $table->string('country_name')->nullable();
            $table->integer('total_person');
            $table->integer('person_count');
            $table->string('gender')->nullable();
            $table->string('stampFee')->nullable();
            $table->string('licenseValidity')->nullable();
            $table->string('authentication')->nullable();
            $table->integer('unitWelfareFee')->nullable();
            $table->tinyInteger('incomeTaxType')->default(0);
            $table->integer('unitIncomeTaxNAFee')->nullable();
            $table->integer('unitIncomeTaxSAFee')->nullable();
            $table->integer('unitSmartCardFee')->nullable();
            $table->string('payOrderDetails')->nullable();
            $table->string('WelfareComment')->nullable();
            $table->string('incomeTaxComment')->nullable();
            $table->string('SmartCardComment')->nullable();
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
        Schema::dropIfExists('immigration_clearance');
    }
}
