<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisaStampingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visaStamping', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pax_id')->unsigned();
            $table->string('send_date')->nullable();
            $table->string('return_date')->nullable();
            $table->string('eapplication_no')->nullable();
            $table->string('comment')->nullable();
            $table->string('img_url')->nullable();
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
        Schema::dropIfExists('visaStamping');
    }
}
