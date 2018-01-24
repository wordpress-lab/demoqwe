<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmsEmployeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('pms__employees')) {
            Schema::create('pms__employees', function (Blueprint $table) {
                $table->increments('id');
                $table->string("code_name")->unique();
                $table->string("father_name");
                $table->date("date_of_birth")->nullable();
                $table->string("nationality")->nullable();
                $table->date("arrival_date")->nullable();
                $table->string("passport_number")->nullable();
                $table->date("passport_expiry")->nullable();
                $table->string("iqama_number")->nullable();
                $table->date("iqama_expiry")->nullable();
                $table->integer("site_name")->nullable()->unsigned();
                $table->double("basic_salary")->nullable();
                $table->double("food_allowance")->nullable();
                $table->string("mobile_number")->nullable();
                $table->text("remarks")->nullable();
                $table->string("photo_url")->nullable();
                $table->string("passport_url")->nullable();
                $table->string("iqama_url")->nullable();
                $table->timestamps();
                $table->integer('created_by')->unsigned()->nullable();
                $table->integer('updated_by')->unsigned()->nullable();
                //relation
                $table->foreign('site_name')->references('id')->on('pms__sites')->onDelete('RESTRICT')->onUpdate('cascade');
                $table->foreign('created_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');
                $table->foreign('updated_by')->references('id')->on('users')->onDelete('set null')->onUpdate('cascade');

            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pms__employees');
    }
}
