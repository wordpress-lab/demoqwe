<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConfirmationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('confirmations', function (Blueprint $table) {
            $table->increments('id');
            $table->string('flight_number')->nullable();
            $table->date('date_of_flight')->nullable();
            $table->time('departure_time')->nullable();
            $table->time('arrival_time')->nullable();
            $table->string('e_ticket_number')->nullable();
            $table->integer('vendor_name')->unsigned()->nullable();
            $table->integer('bill_id')->unsigned()->nullable();
            $table->integer('pax_id')->unsigned()->nullable();
            $table->longText('comment')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('confirmations', function(Blueprint $table){

            $table->foreign('vendor_name')->references('id')->on('contact')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bill_id')->references('id')->on('bill')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pax_id')->references('id')->on('recruitingorder')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('confirmations');
    }
}
