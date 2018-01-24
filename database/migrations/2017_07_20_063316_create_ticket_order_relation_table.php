<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketOrderRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticketorders', function(Blueprint $table){
            $table->foreign('bill_id')->references('id')->on('bill')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('contact_id')->references('id')->on('contact')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vendor_id')->references('id')->on('contact')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ticket_hotel_id')->references('id')->on('ticket_hotel')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('ticket_order_tax', function(Blueprint $table){
            $table->foreign('ticket_order_id')->references('id')->on('ticketorders')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
