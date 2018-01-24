<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTicketRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ticket_refunds', function (Blueprint $table) {
            $table->increments('id');
            $table->date('receive_date')->nullable();
            $table->date('issue_date')->nullable();
            $table->date('submit_date')->nullable();
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('ticket_number')->nullable();
            $table->date('statement_date')->nullable();
            $table->integer('refund_sector')->unsigned()->nullable();
            $table->integer('customer_id')->unsigned()->nullable();
            $table->integer('vendor_id')->unsigned()->nullable();
            $table->integer('invoice_id')->unsigned()->nullable();
            $table->integer('bill_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('ticket_refunds', function(Blueprint $table){
            $table->foreign('refund_sector')->references('id')->on('item')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on('contact')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('vendor_id')->references('id')->on('contact')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('bill_id')->references('id')->on('bill')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ticket_refunds');
    }
}
