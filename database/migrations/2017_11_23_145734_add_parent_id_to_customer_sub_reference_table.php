<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddParentIdToCustomerSubReferenceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('customer_sub_reference', function (Blueprint $table) {
           $table->bigInteger("parent_id")->nullable();
           $table->bigInteger("order")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('customer_sub_reference', function (Blueprint $table) {
            //
        });
    }
}
