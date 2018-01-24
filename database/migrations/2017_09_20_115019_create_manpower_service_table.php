<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateManpowerServiceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('manpower_service', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('sector')->nullable();
            $table->string('phone')->nullable();
            $table->string('delivery_date')->nullable();
            $table->string('issue_date')->nullable();
            $table->boolean('status')->default(0);
            $table->integer('contact_id')->unsigned();
            $table->integer('bill_id')->unsigned()->nullable();
            $table->integer('invoice_id')->unsigned()->nullable();
            $table->integer('ticket_hotel_id')->unsigned()->nullable();
            $table->integer('progress_status_id')->unsigned()->nullable();
            $table->integer('vendor_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->string('order_id')->unique();
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
        Schema::dropIfExists('manpower_service');
    }
}
