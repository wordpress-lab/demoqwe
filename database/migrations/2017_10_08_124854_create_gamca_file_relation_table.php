<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamcaFileRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('gamca_file', function(Blueprint $table){

            $table->foreign('medical_slip_form_id')->references('id')->on('medical_slip_form')->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::table('gamca_receive_submit', function(Blueprint $table){

            $table->foreign('medical_slip_form_id')->references('id')->on('medical_slip_form')->onDelete('cascade')->onUpdate('cascade');

        });

        Schema::table('arrival_recruit', function(Blueprint $table){

            $table->foreign('recruitorder_id')->references('id')->on('recruitingorder')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('gamca_file_relation');
    }
}
