<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReciptionLogbooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reciption_logbooks', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned();
            $table->integer('associated_contact')->nullable()->unsigned();
            $table->string('name')->nullable();
            $table->string('organization_name')->nullable();
            $table->string('contact_number')->nullable();
            $table->string('email')->nullable();
            $table->string('location_street')->nullable();
            $table->string('location_city')->nullable();
            $table->string('location_state')->nullable();
            $table->string('location_zip_code')->nullable();
            $table->string('location_country')->nullable();
            $table->string('department')->nullable();
            $table->integer('item_name')->unsigned()->nullable();
            $table->string('symptom')->nullable();
            $table->string('remark')->nullable();
            $table->date('meeting_date')->nullable();
            $table->time('meeting_time')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('reciption_logbooks', function(Blueprint $table){
            $table->foreign('category_id')->references('id')->on('reciption_categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('associated_contact')->references('id')->on('contact')->onUpdate('cascade');
            $table->foreign('item_name')->references('id')->on('item')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reciption_logbooks');
    }
}
