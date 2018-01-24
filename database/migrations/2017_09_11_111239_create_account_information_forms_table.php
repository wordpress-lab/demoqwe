<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAccountInformationFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('account_information_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id')->unsigned();
            $table->string('machine_model_no_1')->nullable();
            $table->string('machine_model_no_2')->nullable();
            $table->string('optional_model_no_1')->nullable();
            $table->string('optional_model_no_2')->nullable();
            $table->string('machine_part_no_1')->nullable();
            $table->string('machine_part_no_2')->nullable();
            $table->string('optional_part_no_1')->nullable();
            $table->string('optional_part_no_2')->nullable();
            $table->string('machine_serial_no_1')->nullable();
            $table->string('machine_serial_no_2')->nullable();
            $table->string('optional_serial_no_1')->nullable();
            $table->string('optional_serial_no_2')->nullable();
            $table->string('machine_quantity_1')->nullable();
            $table->string('machine_quantity_2')->nullable();
            $table->string('optional_quantity_1')->nullable();
            $table->string('optional_quantity_2')->nullable();
            $table->string('machine_warranty_1')->nullable();
            $table->string('machine_warranty_2')->nullable();
            $table->string('optional_warranty_1')->nullable();
            $table->string('optional_warranty_2')->nullable();
            $table->string('machine_unit_price_1')->nullable();
            $table->string('machine_unit_price_2')->nullable();
            $table->string('optional_unit_price_1')->nullable();
            $table->string('optional_unit_price_2')->nullable();
            $table->date('bill_date')->nullable();
            $table->integer('bill_amount')->nullable();
            $table->integer('business_promotion_amount')->nullable();
            $table->tinyInteger('bill_format')->nullable();
            $table->tinyInteger('customer_type')->nullable();
            $table->tinyInteger('price_type')->nullable();
            $table->longText('billing_information_consignee')->nullable();
            $table->longText('billing_information__different_consignee')->nullable();
            $table->tinyInteger('payment_terms')->nullable();
            $table->string('purchaser_name')->nullable();
            $table->string('purchaser_telephone_number')->nullable();
            $table->string('purchaser_email_no')->nullable();
            $table->string('purchaser_designation')->nullable();
            $table->string('purchaser_mobile_no')->nullable();
            $table->string('purchaser_fax_no')->nullable();
            $table->string('charge_of_payment_name')->nullable();
            $table->string('charge_of_payment_telephone_number')->nullable();
            $table->string('charge_of_payment_email_no')->nullable();
            $table->string('charge_of_payment_designation')->nullable();
            $table->string('charge_of_payment_mobile_no')->nullable();
            $table->string('charge_of_payment_fax_no')->nullable();
            $table->tinyInteger('visit_customer_permises')->nullable();
            $table->date('customer_occupying_permises')->nullable();
            $table->tinyInteger('neighbours_to_confirm_answer')->nullable();
            $table->tinyInteger('permises_rent')->nullable();
            $table->tinyInteger('office_setup')->nullable();
            $table->integer('no_of_staff')->nullable();
            $table->tinyInteger('building_type')->nullable();
            $table->tinyInteger('customer_get_contact')->nullable();
            $table->tinyInteger('liase_with')->nullable();
            $table->tinyInteger('confident_of_payment')->nullable();
            $table->tinyInteger('receive_purchase_order')->nullable();
            $table->tinyInteger('delivery_product_before')->nullable();
            $table->integer('credit_days')->nullable();
            $table->tinyInteger('signature_of_executive')->nullable();
            $table->string('executive_comment')->nullable();
            $table->tinyInteger('signature_of_manager')->nullable();
            $table->string('manager_comment')->nullable();
            $table->tinyInteger('signature_of_account')->nullable();
            $table->string('account_comment')->nullable();
            $table->tinyInteger('signature_of_admin')->nullable();
            $table->string('admin_comment')->nullable();
            $table->tinyInteger('signature_of_director')->nullable();
            $table->string('director_comment')->nullable();
            $table->tinyInteger('signature_of_billing_officer')->nullable();
            $table->string('billing_officer_comment')->nullable();
            $table->integer('created_by')->unsigned();
            $table->integer('updated_by')->unsigned();
            $table->timestamps();
        });

    Schema::table('account_information_forms', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users')->onUpdate('cascade');
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
        Schema::dropIfExists('account_information_forms');
    }
}
