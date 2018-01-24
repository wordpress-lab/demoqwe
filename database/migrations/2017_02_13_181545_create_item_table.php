<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('item', function (Blueprint $table) {
            $table->increments('id');
            $table->string('item_name')->nullable();
            $table->string('item_about')->nullable();
            $table->string('item_sales_rate')->nullable();
            $table->string('item_sales_account')->nullable();
            $table->longText('item_sales_description')->nullable();
            $table->string('item_sales_tax')->nullable();
            $table->string('item_purchase_rate')->nullable();
            $table->string('item_purchase_account')->nullable();
            $table->longText('item_purchase_description')->nullable();
            $table->string('reorder_point')->nullable();
            $table->string('barcode')->nullable();
            $table->string('item_image_url')->nullable();
            $table->string('total_purchases')->nullable();
            $table->string('total_sales')->nullable();
            $table->integer('item_category_id')->unsigned();
            $table->integer('branch_id')->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('item', function(Blueprint $table){
            $table->foreign('item_category_id')->references('id')->on('item_category')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('item');
    }
}
