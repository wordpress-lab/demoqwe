<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnPmsCompanyIdToPmsPayrollSheets extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pms_payroll_sheets', function (Blueprint $table) {
            $table->integer('pms_company_id')->unsigned()->nullable()->after('pms_sites_id');
        });

        Schema::table('pms_payroll_sheets', function(Blueprint $table){
            $table->foreign('pms_company_id')->references('id')->on('pms_companies')->onDelete('set null')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pms_payroll_sheets', function (Blueprint $table) {
            //
        });
    }
}
