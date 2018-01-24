<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContactUserDefinedFunction extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $sql  ="DROP FUNCTION IF EXISTS `customer_sales_quantity`; CREATE FUNCTION customer_sales_quantity(id INT)
 RETURNS double
 NOT DETERMINISTIC
 BEGIN
  DECLARE sales_qty double DEFAULT 0;
  SET sales_qty = (SELECT SUM(invoice_entries.quantity) from invoices JOIN invoice_entries ON invoice_entries.invoice_id = invoices.id WHERE invoices.customer_id = id);
  RETURN sales_qty;
END";
        DB::connection()->getPdo()->exec($sql);
     $sql2 = "DROP FUNCTION IF EXISTS `customer_purchase_quantity`;
CREATE FUNCTION customer_purchase_quantity(id INT)
 RETURNS double
 NOT DETERMINISTIC
 BEGIN
  DECLARE purchase_qty double DEFAULT 0;
  SET purchase_qty = (SELECT SUM(bill_entry.quantity) from bill JOIN bill_entry ON bill_entry.bill_id = bill.id WHERE bill.vendor_id = id);
  RETURN purchase_qty;
END";

    DB::connection()->getPdo()->exec($sql2);

   $sql3 = "DROP FUNCTION IF EXISTS `customer_sales_quantity_date`;
CREATE FUNCTION `customer_sales_quantity_date`(`id` INT, `date_from` DATE, `date_to` DATE)
 RETURNS DOUBLE 
  NOT DETERMINISTIC
  BEGIN
  DECLARE sales_qty double DEFAULT 0;
  DECLARE from_date DATE;
  DECLARE to_date DATE;
  SET from_date =date_from;
  SET to_date =date_to;
 
  SET sales_qty = (SELECT SUM(invoice_entries.quantity) from invoices JOIN invoice_entries ON invoice_entries.invoice_id = invoices.id WHERE invoices.customer_id = id AND (STR_TO_DATE(invoices.invoice_date,\"%d-%m-%Y\") BETWEEN from_date AND to_date));
  RETURN sales_qty;
END";

        DB::connection()->getPdo()->exec($sql3);
        $sql4 = "DROP FUNCTION IF EXISTS `customer_purchase_quantity_date`;
CREATE FUNCTION `customer_purchase_quantity_date`(`id` INT, `date_from` DATE, `date_to` DATE)
 RETURNS DOUBLE 
  NOT DETERMINISTIC
 BEGIN
  DECLARE purchase_qty double DEFAULT 0;
    DECLARE from_date DATE;
    DECLARE to_date DATE;
    SET from_date =date_from;
    SET to_date =date_to;
    
  SET purchase_qty = (SELECT SUM(bill_entry.quantity) from bill JOIN bill_entry ON bill_entry.bill_id = bill.id WHERE bill.vendor_id = id AND (bill.bill_date BETWEEN from_date AND to_date)) ;
  RETURN purchase_qty;
END";
        DB::connection()->getPdo()->exec($sql4);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("DROP FUNCTION IF EXISTS `customer_sales_quantity`");
        DB::statement("DROP FUNCTION IF EXISTS `customer_purchase_quantity`");
        DB::statement("DROP FUNCTION IF EXISTS `customer_sales_quantity_date`");
    }
}
