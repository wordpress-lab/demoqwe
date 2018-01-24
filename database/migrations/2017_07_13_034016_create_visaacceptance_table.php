<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVisaacceptanceTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('visaacceptance', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('visaentry_id')->unsigned();
            $table->boolean('visaadvice_status')->default(0);
            $table->boolean('okala_status')->default(0);
            $table->boolean('consulator_status')->default(0);
            $table->boolean('powerofattorny_status')->default(0);
            $table->boolean('botaka_status')->default(0);
            $table->boolean('contactform_status')->default(0);
            $table->mediumText('visaadvice_comment')->nullable();
            $table->mediumText('okala_comment')->nullable();
            $table->mediumText('consulator_comment')->nullable();
            $table->mediumText('powerofattorny_comment')->nullable();
            $table->mediumText('botaka_comment')->nullable();
            $table->mediumText('contactform_comment')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();

        });



    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('visaacceptance');
    }
}
