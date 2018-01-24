<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalSlipFormPaxRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('medical_slip_form', function(Blueprint $table){

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('medical_slip_form_pax', function(Blueprint $table){

            $table->foreign('medicalslip_id')->references('id')->on('medical_slip_form')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('recruit_id')->references('id')->on('recruitingorder')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('recruit_customer', function(Blueprint $table){

            $table->foreign('recruit_id')->references('id')->on('recruitingorder')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pax_id')->references('id')->on('recruitingorder')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('customer_file', function(Blueprint $table){
            $table->foreign('customer_id')->references('id')->on('recruit_customer')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('medical_slip_form_pax_relation');
    }
}
