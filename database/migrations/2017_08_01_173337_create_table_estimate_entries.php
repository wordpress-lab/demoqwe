<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEstimateEntries extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimate_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('quantity');
            $table->double('amount');
            $table->double('discount')->nullable();
            $table->double('rate');
            $table->integer('item_id')->unsigned();
            $table->integer('estimate_id')->unsigned();
            $table->integer('tax_id')->unsigned();
            $table->integer('account_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('estimate_entries', function(Blueprint $table){

            $table->foreign('tax_id')->references('id')->on('tax')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('item_id')->references('id')->on('item')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('estimate_id')->references('id')->on('estimates')->onDelete('cascade')->onUpdate('cascade');
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
        //
    }
}
