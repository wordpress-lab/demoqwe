<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductPhaseItemAddTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_phase_item_add', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('item_category_id')->nullable();
            $table->integer('item_id')->nullable();
            $table->integer('total')->nullable();
            $table->integer('product_phase_item_id')->unsigned();
            $table->timestamps();
        });

        Schema::table('product_phase_item_add', function(Blueprint $table){
            $table->foreign('product_phase_item_id')->references('id')->on('product_phase_item')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('product_phase_item_add');
    }
}
