<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersubreferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customer_sub_reference', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recruit_customer_id')->unsigned();
            $table->string('name')->nullable();
        });
        Schema::table('customer_sub_reference', function(Blueprint $table){

            $table->foreign('recruit_customer_id')->references('id')->on('recruit_customer')->onDelete('cascade')->onUpdate('cascade');
           // $table->foreign('reference_id')->references('id')->on('recruit_customer')->onDelete('cascade')->onUpdate('cascade');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('customer_sub_reference');
    }
}
