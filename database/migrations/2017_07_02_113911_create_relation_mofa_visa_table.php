<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationMofaVisaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('recruitingorder', function(Blueprint $table){

            $table->foreign('customer_id')->references('id')->on('contact')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('package_id')->references('id')->on('item')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('registerSerial_id')->references('id')->on('visaentrys')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('invoice_id')->references('id')->on('invoices')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('bill_id')->references('id')->on('bill')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('mofas', function(Blueprint $table){

            $table->foreign('pax_id')->references('id')->on('recruitingorder')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('visaentrys', function(Blueprint $table){

            $table->foreign('local_Reference')->references('id')->on('contact')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('company_id')->references('id')->on('company')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });

        Schema::table('mofa_file', function(Blueprint $table){

            $table->foreign('mofa_id')->references('id')->on('mofas')->onDelete('cascade')->onUpdate('cascade');

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
