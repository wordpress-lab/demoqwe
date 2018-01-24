<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddExtracolumnToCompanyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->string('salary')->nullable();
            $table->string('mealallowance')->nullable();
            $table->string('airtransport')->nullable();
            $table->string('referencename')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('company', function (Blueprint $table) {
            $table->string('salary');
            $table->string('mealallowance');
            $table->string('airtransport');
            $table->string('referencename');
        });
    }
}
