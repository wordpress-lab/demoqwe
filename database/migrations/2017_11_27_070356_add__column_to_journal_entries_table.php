<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnToJournalEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('journal_entries', function($table)
        {

            $table->integer('salesComission_id')->unsigned()->nullable();
            $table->integer('agent_id')->unsigned()->nullable();

            $table->foreign('salesComission_id')->references('id')->on('salescommisions')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('agent_id')->references('id')->on('contact')->onDelete('cascade')->onUpdate('cascade');

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
