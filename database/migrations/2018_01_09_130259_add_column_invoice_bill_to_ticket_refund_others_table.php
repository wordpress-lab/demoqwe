<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnInvoiceBillToTicketRefundOthersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('ticket_refund_others', function (Blueprint $table) {
            $table->integer('invoice_id')->unsigned()->nullable();
            $table->integer('bill_id')->unsigned()->nullable();
        });

        Schema::table('ticket_refund_others', function(Blueprint $table){
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('bill_id')->references('id')->on('bill')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('ticket_refund_others', function (Blueprint $table) {
            //
        });
    }
}
