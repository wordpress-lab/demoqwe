<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnTicketApprovalToSubmissionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('submission', function (Blueprint $table) {
            if (!Schema::hasColumn('submission', 'ticket_approval')) {
                $table->boolean('ticket_approval')->nullable()->after('owner_approval');
            }

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('submission', function (Blueprint $table) {
            //
        });
    }
}
