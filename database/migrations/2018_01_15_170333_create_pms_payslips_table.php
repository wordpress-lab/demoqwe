<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmsPayslipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_payslips', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pms_payroll_sheets_id')->unsigned()->nullable();
            $table->integer('pms_employees_id')->unsigned()->nullable();
            $table->double('basic_pay',8,2)->nullable();
            $table->double('allowance',8,2)->nullable();
            $table->double('over_time',8,2)->nullable();
            $table->double('over_time_per_hour',8,2)->nullable();
            $table->double('days_absent',8,2)->nullable();
            $table->double('total_payable',8,2)->nullable();
            $table->double('total_paid',8,2)->nullable();
            $table->double('total_due',8,2)->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('pms_payslips', function(Blueprint $table){
            $table->foreign('pms_payroll_sheets_id')->references('id')->on('pms_payroll_sheets')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('pms_employees_id')->references('id')->on('pms__employees')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('pms_payslips');
    }
}
