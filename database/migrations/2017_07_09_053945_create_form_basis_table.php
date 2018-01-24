<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormBasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_basis', function (Blueprint $table) {
            $table->increments('id');
            $table->string('companyNameEN')->nullable();
            $table->string('companyNameBN')->nullable();
            $table->string('ownerNameEN')->nullable();
            $table->string('ownerNameBN')->nullable();
            $table->string('addressEN')->nullable();
            $table->string('addressBN')->nullable();
            $table->string('licenceEN')->nullable();
            $table->string('licenceBN')->nullable();
            $table->string('ownerDesignationEN')->nullable();
            $table->string('ownerDesignationBN')->nullable();
            $table->string('setting_id');
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
        Schema::dropIfExists('form_basis');
    }
}
