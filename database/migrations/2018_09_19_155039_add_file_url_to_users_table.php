<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFileUrlToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bank', function (Blueprint $table) {
            $table->string('file_url')->nullable();
        });

        Schema::table('incomes', function (Blueprint $table) {
            $table->string('file_url')->nullable();
        });

        Schema::table('credit_notes', function (Blueprint $table) {
            $table->string('file_url')->nullable();
        });
        Schema::table('expense', function (Blueprint $table) {
        $table->string('file_url')->nullable();
        });

        Schema::table('payment_made', function (Blueprint $table) {
            $table->string('file_url')->nullable();
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
