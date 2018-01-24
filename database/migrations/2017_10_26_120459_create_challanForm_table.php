<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChallanFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('challanForm', function (Blueprint $table) {
            $table->increments('id');
            $table->string('challanNo')->nullable();
            $table->string('challanDate')->nullable();
            $table->string('district')->nullable();
            $table->string('branch')->nullable();
            $table->string('fromAddress')->nullable();
            $table->string('organizationAddress')->nullable();
            $table->double('rate_1')->nullable();
            $table->double('rate_2')->nullable();
            $table->double('quantity_1')->nullable();
            $table->double('quantity_2')->nullable();
            $table->string('comment')->nullable();
            $table->integer('manpower_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('challanForm', function(Blueprint $table){

            $table->foreign('manpower_id')->references('id')->on('manpower')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('challanForm');
    }
}
