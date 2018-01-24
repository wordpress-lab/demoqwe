<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function($table)
        {
            $table->integer('agents_id')->nullable()->unsigned();
            $table->integer('agentcommissionAmount')->nullable();
            $table->tinyInteger('commission_type')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function($table)
        {
            $table->dropColumn(['agents_id', 'agentcommissionAmount', 'commission_type']);
        });
    }
}
