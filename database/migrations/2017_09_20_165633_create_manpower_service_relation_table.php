<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManpowerServiceRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('manpower_service', function(Blueprint $table){
            $table->foreign('bill_id')->references('id')->on('bill')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('contact_id')->references('id')->on('contact')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('vendor_id')->references('id')->on('contact')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('ticket_hotel_id')->references('id')->on('ticket_hotel')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('progress_status_id')->references('id')->on('manpower_service_progress_status')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('manpower_service_ticket_document', function(Blueprint $table){

            $table->foreign('manpower_service_id')->references('id')->on('manpower_service')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('manpower_service_progress_status', function(Blueprint $table){

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
        Schema::dropIfExists('manpower_service_relation');
    }
}
