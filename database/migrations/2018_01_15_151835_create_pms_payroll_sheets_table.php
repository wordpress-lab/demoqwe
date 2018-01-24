<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmsPayrollSheetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_payroll_sheets', function (Blueprint $table) {
            $table->increments('id');
            $table->date('period_from')->nullable();
            $table->date('period_to')->nullable();
            $table->integer('pms_sites_id')->unsigned()->nullable();
            $table->boolean('status')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('pms_payroll_sheets', function(Blueprint $table){
            $table->foreign('pms_sites_id')->references('id')->on('pms__sites')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('pms_payroll_sheets');
    }
}
