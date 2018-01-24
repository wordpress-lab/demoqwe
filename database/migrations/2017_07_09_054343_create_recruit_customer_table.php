<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecruitCustomerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recruit_customer', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dateOfBirthEN')->nullable();
            $table->string('dateOfBirthBN')->nullable();
            $table->string('gender')->nullable();
            $table->string('addressEN')->nullable();
            $table->string('addressBN')->nullable();
            $table->string('religionEN')->nullable();
            $table->string('religionBN')->nullable();
            $table->string('guardianName')->nullable();
            $table->string('guardianFatherName')->nullable();
            $table->string('guardianAddressEN')->nullable();
            $table->string('guardianAddressBN')->nullable();
            $table->string('guardianReligion')->nullable();
            $table->string('relationWithCustomer_1')->nullable();
            $table->string('relationWithCustomer_2')->nullable();
            $table->string('motherName')->nullable();
            $table->string('fatherName')->nullable();
            $table->string('placeOfBirth')->nullable();
            $table->string('previousNationality')->nullable();
            $table->string('presentNationality')->nullable();
            $table->string('maritalStatus')->nullable();
            $table->string('group')->nullable();
            $table->string('professionEn')->nullable();
            $table->string('professionBn')->nullable();
            $table->string('professionAR')->nullable();
            $table->string('businessAddressEN')->nullable();
            $table->string('businessAddressBN')->nullable();
            $table->string('purposeOfTravel')->nullable();
            $table->string('durationOfStay')->nullable();
            $table->string('arrivalDate')->nullable();
            $table->string('departureDate')->nullable();
            $table->string('visaAdvice')->nullable();
            $table->string('destination')->nullable();
            $table->integer('recruit_id')->unsigned();
            $table->integer('pax_id')->unsigned();
            $table->string('contact_number')->nullable();
            $table->string('sub_reference')->nullable();
            $table->string('passengerNameBN')->nullable();
            $table->string('passportNumberBN')->nullable();
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
        Schema::dropIfExists('recruit_customer');
    }
}
