<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableEstimate extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('estimates', function (Blueprint $table) {
            $table->increments('id');
            $table->string('estimate_number');
            $table->string('ref')->nullable();
            $table->string('date')->nullable();
            $table->string('attn')->nullable();
            $table->string('attn_designation')->nullable();
            $table->string('subject')->nullable();
            $table->binary('heading')->nullable();
            $table->integer('customer_id')->unsigned();
            $table->binary('terms_conditions')->nullable();
            $table->string('table_head')->nullable();
            $table->binary('left_notation')->nullable();
            $table->binary('right_notation')->nullable();
            $table->double('shipping_charge')->nullable();
            $table->double('adjustment')->nullable();
            $table->double('total_amount');
            $table->double('tax_total')->nullable();
            $table->double('due_amount');
            $table->timestamps();
        });

        Schema::table('estimates', function(Blueprint $table){


            $table->foreign('customer_id')->references('id')->on('contact')->onDelete('cascade')->onUpdate('cascade');

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
