<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMedicalSlipTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicalSlip', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pax_id')->unsigned();
            $table->string('medical_centre_name');
            $table->string('medical_date');
            $table->string('medical_report_date')->nullable();
            $table->boolean('status')->nullable();
            $table->string('comment')->nullable();
            $table->string('reason')->nullable();
            $table->string('medical_visit_date')->nullable();
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
        Schema::dropIfExists('medicalSlip');
    }
}
