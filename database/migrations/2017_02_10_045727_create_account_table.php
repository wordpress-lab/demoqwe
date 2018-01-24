<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_name')->nullable();
            $table->string('account_code')->nullable();
            $table->longText('description')->nullable();
            $table->string('dashboard_watchlist')->nullable();
            $table->string('required_status')->nullable();
            $table->integer('account_type_id')->unsigned();
            $table->integer('parent_account_type_id')->unsigned();
            $table->integer('branch_id')->nullable()->unsigned();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

        Schema::table('account', function(Blueprint $table){
            $table->foreign('account_type_id')->references('id')->on('account_type')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('parent_account_type_id')->references('id')->on('parent_account_type')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('branch_id')->references('id')->on('branch')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('account');
    }
}
