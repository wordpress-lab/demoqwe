<?php
/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 08-10-17
 * Time: 18.23
 */

namespace App\Lib;


use App\Models\AccountChart\Account;
use App\Models\Contact\Contact;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\Moneyin\CreditNoteRefund;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Moneyin\PaymentReceives;

class CustomerDetailsReport
{
    protected $start = null;
    protected $end = null;
    protected $customer_reports;


   public function generate($start, $end,$id)
   {
       $PaymentReceives = 0;
       $PaymentReceives_excess=0;
       $creditnote_payament=0;
       $start = $start;
       $customer_report = [];
       $condition_payment = "str_to_date(payment_date, '%Y-%m-%d') < '$start' ";
       $condition = "str_to_date(invoice_date, '%d-%m-%Y') < '$start' ";
      //1
       $invoices =  Invoice::whereRaw($condition)->where('customer_id',$id)->sum('invoices.total_amount');
       //2
       $PaymentReceives = PaymentReceives::join('payment_receives_entries','payment_receives_entries.payment_receives_id','=','payment_receives.id')
                                              ->where('customer_id',$id)
                                              ->whereRaw($condition_payment)
                                              ->sum('payment_receives_entries.amount');
       //3
       $PaymentReceives_excess = PaymentReceives::where('customer_id',$id)->whereRaw($condition_payment)->sum('excess_payment');
      //4
       $creditnote_payament = CreditNotePayment::join('credit_notes','credit_notes.id','=','credit_note_payments.credit_note_id')
                                                 ->where('customer_id',$id)
                                                 ->whereDate('credit_note_payments.created_at','<',$start)
                                                 ->sum('credit_note_payments.amount');
       //calculation
       $total_balance= $invoices-($PaymentReceives+$PaymentReceives_excess+$creditnote_payament);
       $final_amount = 0;
       if($total_balance<0){
           $final_amount = "(".number_format(abs($total_balance),2,'.', '').")";

       }else{
           $final_amount = number_format($total_balance, 2,'.', '');
       }

       $this->customer_reports = array(
           'date' =>$start,
           'particulars'=>"Opening Balance",
           'type'=>'opening_balance',
           'final_amount'=> $final_amount
       );

       return $this->customer_reports;
   }

}