<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTypeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_type', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_name')->nullable();
            $table->longText('description')->nullable();
            $table->integer('parent_account_type_id')->unsigned();
            $table->integer('required_status');
            $table->timestamps();
        });

        Schema::table('account_type', function(Blueprint $table){
            $table->foreign('parent_account_type_id')->references('id')->on('parent_account_type')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account_type');
    }
}
