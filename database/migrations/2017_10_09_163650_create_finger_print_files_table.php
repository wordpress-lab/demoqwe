<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFingerPrintFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finger_print_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->integer('fingerprint_id')->unsigned();
            $table->string('img_url')->nullable();
            $table->timestamps();
        });

        Schema::table('finger_print_files', function(Blueprint $table){
            $table->foreign('fingerprint_id')->references('id')->on('fingerprint')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('finger_print_files');
    }
}
