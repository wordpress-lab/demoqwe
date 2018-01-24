<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPhaseItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_phase_item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('date')->nullable();
            $table->string('issued_number')->nullable();
            $table->string('reference')->nullable();
            $table->string('reason')->nullable();
            $table->longText('personal_note')->nullable();
            $table->integer('recipient_id')->nullable();
            $table->integer('issued_by')->unsigned();
            $table->integer('product_id')->unsigned();
            $table->integer('product_phase_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('product_phase_item', function(Blueprint $table){
            $table->foreign('issued_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_id')->references('id')->on('product')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('product_phase_id')->references('id')->on('product_phase')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('product_phase_item');
    }
}
