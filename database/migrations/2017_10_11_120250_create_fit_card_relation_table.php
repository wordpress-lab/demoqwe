<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFitCardRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fit_card', function(Blueprint $table){

            $table->foreign('pax_id')->references('id')->on('recruitingorder')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::table('fit_card_file', function(Blueprint $table){

            $table->foreign('fit_card_id')->references('id')->on('fit_card')->onDelete('cascade')->onUpdate('cascade');

        });


        Schema::table('submission', function(Blueprint $table){

            $table->foreign('pax_id')->references('id')->on('recruitingorder')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::table('submission_file', function(Blueprint $table){

            $table->foreign('submission_id')->references('id')->on('submission')->onDelete('cascade')->onUpdate('cascade');

        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fit_card_relation');
    }
}
