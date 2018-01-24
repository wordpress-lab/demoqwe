<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAftersixydaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('aftersixydays', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('recruitingorder_id')->unsigned()->unique()->index();
            $table->double("grama_rate")->nullable();
            $table->timestamp("receive_date")->nullable();
            $table->timestamp("date_of_payment")->nullable();
            $table->string("file_url")->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
            $table->foreign('recruitingorder_id')->references('id')->on('recruitingorder')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('aftersixydays');
    }
}
