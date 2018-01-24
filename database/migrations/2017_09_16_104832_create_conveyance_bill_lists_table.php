<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConveyanceBillListsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conveyance_bill_lists', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('conveyance_bill_id')->unsigned();
            $table->string('from')->nullable();
            $table->string('to')->nullable();
            $table->string('transport')->nullable();
            $table->integer('amount')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('conveyance_bill_lists', function(Blueprint $table){
            $table->foreign('conveyance_bill_id')->references('id')->on('conveyance_bills')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('conveyance_bill_lists');
    }
}
