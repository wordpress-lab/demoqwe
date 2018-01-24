<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmsInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_invoices', function (Blueprint $table) {
            $table->increments('id');
            $table->date('invoice_date')->nullable();
            $table->string('invoice_number')->unique()->nullable();
            $table->integer('pms_sites_id')->unsigned()->nullable();
            $table->string('subject')->nullable();
            $table->date('invoice_from_date')->nullable();
            $table->date('invoice_to_date')->nullable();
            $table->double('due_amount',8,2)->nullable();
            $table->double('total_hours',8,2)->nullable();
            $table->double('per_hour_rate',8,2)->nullable();
            $table->double('total_amount',8,2)->nullable();
            $table->integer('pms_company_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();
        });

        Schema::table('pms_invoices', function(Blueprint $table){
            $table->foreign('pms_sites_id')->references('id')->on('pms__sites')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('pms_company_id')->references('id')->on('pms_companies')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pms_invoices');
    }
}
