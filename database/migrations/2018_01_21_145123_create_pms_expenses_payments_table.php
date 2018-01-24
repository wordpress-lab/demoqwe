<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmsExpensesPaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_expenses_payments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('pms_expenses_id')->unsigned()->nullable();
            $table->date('date')->nullable();
            $table->double('amount',8,2)->nullable();
            $table->text('note')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('pms_expenses_payments', function(Blueprint $table){
            $table->foreign('pms_expenses_id')->references('id')->on('pmsexpenses')->onDelete('set null')->onUpdate('cascade');
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
        Schema::dropIfExists('pms_expenses_payments');
    }
}
