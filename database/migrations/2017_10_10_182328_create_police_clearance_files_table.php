<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePoliceClearanceFilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('police_clearance_files', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->integer('police_clearance_id')->unsigned();
            $table->string('img_url')->nullable();
            $table->timestamps();
        });

        Schema::table('police_clearance_files', function(Blueprint $table){
            $table->foreign('police_clearance_id')->references('id')->on('police_clearances')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('police_clearance_files');
    }
}
