<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImmigrationClearancePaxRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('immigration_clearance', function(Blueprint $table){

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('immigration_clearance_pax', function(Blueprint $table){

            $table->foreign('immigration_clearance_id')->references('id')->on('immigration_clearance')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('pax_id')->references('id')->on('recruitingorder')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('immigration_clearance_pax_relation');
    }
}
