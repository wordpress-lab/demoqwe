<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompletionFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('completion_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->integer('completion_id')->unsigned();
            $table->string('img_url')->nullable();
            $table->timestamps();
        });

        Schema::table('completion_files', function(Blueprint $table){
            $table->foreign('completion_id')->references('id')->on('completions')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('completion_files');
    }
}
