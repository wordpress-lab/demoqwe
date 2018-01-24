<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUploadAndCommentsToIqamaclearance extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('iqamaclearance', function (Blueprint $table) {
            $table->string('file_url')->nullable()->after('recruitingorder_id');
            $table->longText('comments')->nullable()->after('file_url');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('iqamaclearance', function (Blueprint $table) {
            //
        });
    }
}
