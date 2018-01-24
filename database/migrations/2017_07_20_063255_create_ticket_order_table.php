<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticketorders', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('contact_id')->unsigned();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('ticket_number')->nullable();
            $table->string('pnrcreationDate')->nullable();
            $table->string('recordLocator')->nullable();
            $table->string('departureflightCode')->nullable();
            $table->string('departureflightClass')->nullable();
            $table->string('departureDate')->nullable();
            $table->string('departureFrom')->nullable();
            $table->string('arriveTo')->nullable();
            $table->string('departureTime')->nullable();
            $table->string('arrivalTime')->nullable();
            $table->string('returnflightCode')->nullable();
            $table->string('returnflightbookingClass')->nullable();
            $table->string('returnflightDate')->nullable();
            $table->string('returnflightFrom')->nullable();
            $table->string('returnflightTo')->nullable();
            $table->string('returnflightdepartureTime')->nullable();
            $table->string('returnflightarrivalDate')->nullable();
            $table->string('issuetimeLimit')->nullable();
            $table->string('documentNumber')->nullable();
            $table->integer('gdsType')->nullable();
            $table->text('pnr')->nullable();


            //shanto

            $table->string('issuDate')->nullable();
            $table->string('departureSector')->nullable();
            $table->string('returnSector')->nullable();
            $table->integer('adultPassenger')->nullable();
            $table->integer('childPassenger')->nullable();
            $table->integer('infantPassenger')->nullable();
            $table->string('hotel_note')->nullable();
            $table->boolean('status');
            $table->double('fareAmount')->nullable();
            $table->double('commissionRate')->nullable();
            $table->double('taxOnCommission')->nullable();




            $table->integer('bill_id')->unsigned()->nullable();
            $table->integer('invoice_id')->unsigned()->nullable();
            $table->integer('ticket_hotel_id')->unsigned()->nullable();
            $table->integer('vendor_id')->unsigned();
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
        Schema::dropIfExists('ticketorders');
    }
}
