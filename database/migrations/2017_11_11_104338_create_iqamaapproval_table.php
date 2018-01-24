<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateIqamaapprovalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('iqamaapproval', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('apprivalstatus')->nullable();
            $table->integer('recruitingorder_id')->unsigned()->nullable()->unique();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
            $table->timestamps();

        });
        Schema::table('iqamaapproval', function(Blueprint $table){
        $table->foreign('recruitingorder_id')->references('id')->on('recruitingorder')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('iqamaapproval');
    }
}
