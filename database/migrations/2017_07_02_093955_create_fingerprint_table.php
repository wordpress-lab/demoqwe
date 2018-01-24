<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFingerprintTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fingerprint', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->string('number')->nullable();
            $table->boolean('bmet_status')->nullable();
            $table->string('assignedDate')->nullable();
            $table->string('comment')->nullable();
            $table->integer('paxid')->unsigned()->nullable();
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
        Schema::dropIfExists('fingerprint');
    }
}
