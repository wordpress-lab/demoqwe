<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditNoteRefundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_note_refunds', function (Blueprint $table) {
            $table->increments('id');
            $table->double('amount');
            $table->integer('payment_mode_id')->unsigned();
            $table->string('date');
            $table->string('reference');
            $table->integer('account_id')->unsigned();
            $table->integer('credit_note_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('credit_note_refunds', function(Blueprint $table){
            $table->foreign('credit_note_id')->references('id')->on('credit_notes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('payment_mode_id')->references('id')->on('payment_mode')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('credit_note_refunds');
    }
}
