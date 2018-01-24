<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMofasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mofas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pax_id')->unsigned();
            $table->string('mofaNumber')->nullable();
            $table->string('iqamaNumber')->nullable();
            $table->string('mofaDate')->nullable();
            $table->boolean('status')->nullable();
            $table->text('comment')->nullable();

            $table->string('profession')->nullable();
            $table->string('medical_submit_date')->nullable();

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
        Schema::dropIfExists('mofas');
    }
}
