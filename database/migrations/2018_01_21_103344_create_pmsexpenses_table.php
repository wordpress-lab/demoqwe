<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmsexpensesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pmsexpenses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer("pmsexpense_sector_id")->unsigned()->nullable();
            $table->string("number");
            $table->date("date");
            $table->double("amount");
            $table->double("paid")->nullable();
            $table->double("due")->nullable();
            $table->string("note")->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();

        });

        //relation
        Schema::table('pmsexpenses', function(Blueprint $table){
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('pmsexpense_sector_id')->references('id')->on('pms_expense_sector')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pmsexpenses');
    }
}
