<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bill', function (Blueprint $table) {
            $table->increments('id');
            $table->string('order_number')->nullable();
            $table->string('bill_number');
            $table->double('amount');
            $table->double('due_amount');
            $table->string('bill_date');
            $table->string('due_date');
            $table->integer('item_rates');
            $table->string('note')->nullable();
            $table->double('total_tax');
            $table->string('file_name')->nullable();
            $table->string('file_url')->nullable();
            $table->integer('vendor_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('bill', function(Blueprint $table){
            $table->foreign('vendor_id')->references('id')->on('contact')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('bill');
    }
}
