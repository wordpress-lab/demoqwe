<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateConveyanceBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('conveyance_bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->integer('expense_id')->unsigned();
            $table->date('date')->nullable();
            $table->integer('checked_by')->unsigned()->nullable();
            $table->integer('approved_by')->unsigned()->nullable();
            $table->integer('approved_by_chairman')->nullable();
            $table->string('comments')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('conveyance_bills', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('expense_id')->references('id')->on('expense')->onUpdate('cascade');
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
        Schema::dropIfExists('conveyance_bills');
    }
}
