<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmsPayslipAllowancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_payslip_allowances', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pms_payslip_id')->unsigned()->nullable();
            $table->integer('pms_assign_allowances_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('pms_payslip_allowances', function(Blueprint $table){
            $table->foreign('pms_payslip_id')->references('id')->on('pms_payslips')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('pms_assign_allowances_id')->references('id')->on('pms_assign_allowances')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('pms_payslip_allowances');
    }
}
