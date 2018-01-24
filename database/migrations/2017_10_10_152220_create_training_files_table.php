<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrainingFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('training_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->integer('training_id')->unsigned();
            $table->string('img_url')->nullable();
            $table->timestamps();
        });

        Schema::table('training_files', function(Blueprint $table){
            $table->foreign('training_id')->references('id')->on('trainings')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('training_files');
    }
}
