<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisaformbulksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visaformbulks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('visaform_id')->unsigned();
            $table->string('name')->nullable();
            $table->string('gender')->nullable();
            $table->string('dateofBirth')->nullable();
            $table->string('relationship')->nullable();
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
        Schema::dropIfExists('visaformbulks');
    }
}
