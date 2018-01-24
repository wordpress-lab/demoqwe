<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitingorderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruitingorder', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('customer_id')->unsigned();
            $table->integer('package_id')->unsigned()->nullable();
            $table->integer('registerSerial_id')->unsigned()->nullable();
            $table->string('paxid')->unique();
            $table->string('passportNumber');
            $table->string('passportDate');
            $table->double('salesRate' , 10,2)->nullable();
            $table->string('status')->default(1);
            $table->integer('invoice_id')->unsigned()->nullable();
            $table->integer('bill_id')->unsigned()->nullable();
            $table->string('passenger_name')->nullable();
            $table->tinyInteger('order_status')->nullable();
            $table->string('substitued_order')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recruitingorder');
    }
}
