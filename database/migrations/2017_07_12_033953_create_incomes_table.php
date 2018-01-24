<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIncomesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('incomes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date');
            $table->double('amount');
            $table->integer('receive_through_id')->unsigned();
            $table->double('tax_total')->nullable();
            $table->string('reference')->nullable();
            $table->string('note');
            $table->integer('account_id')->unsigned();
            $table->integer('customer_id')->unsigned();
            $table->integer('tax_id')->unsigned();
            $table->integer('tax_type');
            $table->string('bank_info')->nullable();
            $table->string('invoice_show')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });
        Schema::table('incomes', function(Blueprint $table){
            $table->foreign('receive_through_id')->references('id')->on('account')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('customer_id')->references('id')->on('contact')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('tax_id')->references('id')->on('tax')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('incomes');
    }
}
