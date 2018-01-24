<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmsPayslipsPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_payslips_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('number')->nullable();
            $table->integer('pms_payslips_id')->unsigned()->nullable();
            $table->date('date')->nullable();
            $table->double('amount',8,2)->nullable();
            $table->text('note')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('pms_payslips_payments', function(Blueprint $table){
            $table->foreign('pms_payslips_id')->references('id')->on('pms_payslips')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('pms_payslips_payments');
    }
}
