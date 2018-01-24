<?php
/**
 * Created by PhpStorm.
 * User: ontik
 * Date: 12/20/2017
 * Time: 3:32 PM
 */

namespace App\Modules\Report\Http\Response;


use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\DB;

class ContactWiseItem
{
  protected $start = null;
  protected $end = null;
  public function __construct($start, $end)
  {
      $this->start = $start;
      $this->end = $end;
  }

  public function Itemlist($id)
  {
      $data = [];


      $invoice_max_min_date= DB::select( DB::raw("SELECT MIN(STR_TO_DATE(invoices.invoice_date,'%d-%m-%Y')) as start_date, MAX(STR_TO_DATE(invoices.invoice_date,'%d-%m-%Y')) as end_date from invoices where invoices.customer_id = $id AND (STR_TO_DATE(invoices.invoice_date,'%d-%m-%Y') BETWEEN '$this->start' AND '$this->end')"));
      $bill_max_min_date= DB::select( DB::raw("SELECT MIN(bill.bill_date) as start_date, MAX(bill.bill_date) as end_date from bill where bill.vendor_id = $id AND bill.bill_date BETWEEN '$this->start' AND '$this->end' "));
      $datelist = array_merge($invoice_max_min_date,$bill_max_min_date);
      $invoice= DB::select( DB::raw("SELECT 'invoice' as type,invoices.id,STR_TO_DATE(invoices.invoice_date,'%d-%m-%Y') as tr_date,invoices.invoice_number,invoices.total_amount as debit,GROUP_CONCAT(item.item_name) as item_list, invoice_entries.quantity as inv_qty from invoices JOIN invoice_entries ON invoice_entries.invoice_id=invoices.id JOIN item ON item.id = invoice_entries.item_id where invoices.customer_id = $id AND (STR_TO_DATE(invoices.invoice_date,'%d-%m-%Y') BETWEEN '$this->start' AND '$this->end') GROUP BY invoice_entries.invoice_id"));
      $bill= DB::select( DB::raw("SELECT 'bill' as type, bill.id ,bill.bill_date as tr_date,bill.bill_number,bill.amount as credit,GROUP_CONCAT(item.item_name) as item_list, SUM(bill_entry.quantity) as bill_qty from bill JOIN bill_entry ON bill_entry.bill_id=bill.id JOIN item ON item.id = bill_entry.item_id where bill.vendor_id = $id AND (bill.bill_date BETWEEN '$this->start' AND '$this->end') GROUP BY bill_entry.bill_id") );
      $dates = $this->MaxMinDate($datelist);

      if(!(isset($dates["max_date"]))||!(isset($dates["min_date"])))
      {
         return [];
      }

      //date wise calculator
      foreach($this->getDatesFromRange($dates["min_date"],$dates["max_date"]) as $value)
      {
       // echo $value."<br/>";
      }

      return array_merge($invoice,$bill);
  }

  public function MaxMinDate($datelist){
      $dates= [];

      if(!count($datelist) || !is_array($datelist)){
          return ["max_date"=>$this->end,"min_date"=>$this->start];
      }
      foreach ($datelist as $value)
      {
          $dates[] = $value->start_date;
          $dates[] = $value->end_date;
      }

      return ["max_date"=>max($dates),"min_date"=>min($dates)];
  }
  function getDatesFromRange($start, $end, $format = 'Y-m-d') {
        $array = array();
        $interval = new DateInterval('P1D');

        $realEnd = new DateTime($end);
        $realEnd->add($interval);

        $period = new DatePeriod(new DateTime($start), $interval, $realEnd);

        foreach($period as $date) {
            $array[] = $date->format($format);
        }

        return $array;
   }
}