<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStockTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('total')->nullable();
            $table->string('date')->nullable();
            $table->integer('item_category_id')->unsigned();
            $table->integer('item_id')->unsigned();
            $table->integer('bill_id')->nullable()->unsigned();
            $table->integer('credit_note_id')->nullable()->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('stock', function(Blueprint $table){
            $table->foreign('item_category_id')->references('id')->on('item_category')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('item_id')->references('id')->on('item')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('bill_id')->references('id')->on('bill')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('credit_note_id')->references('id')->on('credit_notes')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('branch_id')->references('id')->on('branch')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('stock');
    }
}
