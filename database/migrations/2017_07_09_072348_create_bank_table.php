<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank', function (Blueprint $table) {
            $table->increments('id');
            $table->string('type');
            $table->string('particulars');
            $table->string('date');
            $table->string('cheque_number');
            $table->string('total_amount');
            $table->string('bank_account_number')->nullable();
            $table->longText('notes');
            $table->string('invoice_show')->nullable();
            $table->integer('contact_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('payment_mode_id')->unsigned();
            $table->timestamps();
        });


        Schema::table('bank', function(Blueprint $table){
            $table->foreign('contact_id')->references('id')->on('contact')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_mode_id')->references('id')->on('account')->onDelete('cascade')->onUpdate('cascade');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank');
    }
}

