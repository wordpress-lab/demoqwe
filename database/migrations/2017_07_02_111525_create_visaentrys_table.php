<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisaentrysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visaentrys', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->integer('local_Reference')->unsigned();
            $table->string('visaNumber');
            $table->string('visaIssuedate')->nullable();
            $table->integer('company_id')->unsigned()->nullable();
            $table->integer('numberofVisa');
            $table->double('purchaseRate' , 10,2)->nullable();
            $table->string('destination');
            $table->string('registerSerial')->unique();
            $table->string('idNum')->nullable();
            $table->string('iqamaNumber')->nullable();
            $table->string('iqamaSector')->nullable();
            $table->string('visaType')->nullable();
            $table->string('expire_date')->nullable();
            $table->integer('visa_category_id')->nullable();
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
        Schema::dropIfExists('visaentrys');
    }
}
