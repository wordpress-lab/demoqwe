<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmsAssignAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_assign_allowances', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->integer('pms_employees_id')->unsigned()->nullable();
            $table->integer('pms_sectors_id')->unsigned()->nullable();
            $table->double('amount',8,2)->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('pms_assign_allowances', function(Blueprint $table){
            $table->foreign('pms_employees_id')->references('id')->on('pms__employees')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('pms_sectors_id')->references('id')->on('pms_sectors')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('pms_assign_allowances');
    }
}
