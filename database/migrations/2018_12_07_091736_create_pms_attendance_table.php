<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePmsAttendanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pms_attendance', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->time('entrance_time')->nullable();
            $table->time('leave_time')->nullable();
            $table->integer('pms_site_id')->unsigned()->nullable();
            $table->integer('pms_employee_id')->unsigned()->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();

            //relation
            $table->foreign('pms_site_id')->references('id')->on('pms__sites')->onDelete('RESTRICT')->onUpdate('cascade');
            $table->foreign('pms_employee_id')->references('id')->on('pms__employees')->onDelete('RESTRICT')->onUpdate('cascade');
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
        Schema::dropIfExists('pms_attendance');
    }
}
