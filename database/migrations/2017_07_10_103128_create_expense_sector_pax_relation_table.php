<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpenseSectorPaxRelationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('expenseSector', function(Blueprint $table){

            $table->foreign('account_id')->references('id')->on('account')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('recruiteexpense', function(Blueprint $table){

            $table->foreign('expenseSectorid')->references('id')->on('expenseSector')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('expense_id')->references('id')->on('expense')->onDelete('set null')->onUpdate('cascade');
        });

        Schema::table('recruiteExpensePax', function(Blueprint $table){

            $table->foreign('recruitExpenseid')->references('id')->on('recruiteexpense')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('paxid')->references('id')->on('recruitingorder')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
