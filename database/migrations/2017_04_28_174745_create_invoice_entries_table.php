<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoiceEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoice_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->double('amount');
            $table->double('discount')->nullable();
            $table->integer('discount_type')->default(0);
            $table->double('rate');
            $table->longText('description')->nullable();
            $table->integer('item_id')->unsigned();
            $table->integer('invoice_id')->unsigned();
            $table->integer('tax_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('invoice_entries', function(Blueprint $table){
            $table->foreign('item_id')->references('id')->on('item')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tax_id')->references('id')->on('tax')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('invoice_entries');
    }
}
