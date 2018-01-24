<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCreditNoteEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('credit_note_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->double('quantity');
            $table->double('rate');
            $table->string('amount');
            $table->string('discount');
            $table->string('description')->nullable();
            $table->integer('item_id')->unsigned();
            $table->integer('credit_note_id')->unsigned();
            $table->integer('tax_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('credit_note_entries', function(Blueprint $table){
            $table->foreign('item_id')->references('id')->on('item')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('credit_note_id')->references('id')->on('credit_notes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('credit_note_entries');
    }
}
