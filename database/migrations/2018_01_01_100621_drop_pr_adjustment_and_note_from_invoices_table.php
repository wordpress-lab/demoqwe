<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DropPrAdjustmentAndNoteFromInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('invoices', function (Blueprint $table) {
            if(Schema::hasColumn('invoices', 'pr_adjustment')) ; //check whether invoices table has pr_sdjustment column
            {
                $table->dropColumn('pr_adjustment');

            }
            if(Schema::hasColumn('invoices', 'pr_note')) ;
            {
                $table->dropColumn('pr_note');

            }

            if(!Schema::hasColumn('invoices', 'vat_adjustment')) ;
            {
                $table->double('vat_adjustment')->nullable();

            }
            if(!Schema::hasColumn('invoices', 'tax_adjustment')) ;
            {
               $table->double('tax_adjustment')->nullable();

            }

            if(!Schema::hasColumn('invoices', 'others_adjustment')) ;
            {
                $table->double('others_adjustment')->nullable();

            }




        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('invoices', function (Blueprint $table) {
            $table->dropColumn('others_adjustment');
            $table->dropColumn('tax_adjustment');
            $table->dropColumn('vat_adjustment');
        });
    }
}
