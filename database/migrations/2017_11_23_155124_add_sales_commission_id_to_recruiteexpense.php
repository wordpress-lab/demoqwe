<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddSalesCommissionIdToRecruiteexpense extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recruiteexpense', function (Blueprint $table) {
            $table->integer("sales_commission_id")->unsigned()->nullable()->after('expense_id');
        });

        Schema::table('recruiteexpense', function(Blueprint $table){
            $table->foreign('sales_commission_id')->references('id')->on('salescommisions')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('recruiteexpense', function (Blueprint $table) {
            //
        });
    }
}
