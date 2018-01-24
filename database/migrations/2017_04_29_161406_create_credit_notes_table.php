<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('credit_note_number');
            $table->string('reference');
            $table->string('credit_note_date');
            $table->double('shiping_charge');
            $table->double('adjustment');
            $table->double('total_credit_note');
            $table->double('available_credit');
            $table->longText('customer_note');
            $table->longText('terms_and_condition');
            $table->integer('customer_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('credit_notes', function(Blueprint $table){
            $table->foreign('customer_id')->references('id')->on('contact')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('credit_notes');
    }
}
