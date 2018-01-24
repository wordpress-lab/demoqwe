<?php
namespace App\Modules\Invoice\Http\Response;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Moneyin\PaymentReceives;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/**
 * Created by PhpStorm.
 * User: Ontik
 * Date: 11/12/2017
 * Time: 12:20 PM
 */
class Payment
{
  protected $paymentAmount = 0;
  public function makePaymentReceive($request,$invoice_id)
  {


      if(!$request instanceof Request)
      {
          return null;
      }
      if(!$request->check_payment || !$request->submit)
      {
          return null;
      }
      $newpr_number = PaymentReceives::max("pr_number")+1;
      $authid= Auth::id();
      $newpaymentreceive = new PaymentReceives();
      $newpaymentreceive->payment_date =date("Y-m-d",strtotime($request['invoice_date']));
      $newpaymentreceive->pr_number =str_pad($newpr_number,"6",0,STR_PAD_LEFT);
      $newpaymentreceive->bank_info = $request['payment_deposit_details'];
      $newpaymentreceive->invoice_show= "on";
      $newpaymentreceive->note=null;
      $newpaymentreceive->amount= $request['payment_amount'];
      $newpaymentreceive->excess_payment=0;
      $newpaymentreceive->payment_mode_id=1;
      $newpaymentreceive->account_id=$request['payment_account'];
      $newpaymentreceive->customer_id=$request['customer_id'];
      $newpaymentreceive->created_by=$authid;
      $newpaymentreceive->updated_by=$authid;
      if(!$newpaymentreceive->save())
      {
       throw new \Exception("Payment receive creation fail .");
      }
      return $this->makePaymentReceiveEntry($request,$newpaymentreceive,$invoice_id);
  }
      public function makePaymentReceiveEntry($request,$paymentreceive = null,$invoice_id=null)
     {
      if(is_null($paymentreceive) || is_null($invoice_id))
      {
          throw new \Exception("payment receive entry creation fail. need required data");
      }
      if(!$paymentreceive instanceof PaymentReceives)
      {
         throw new \Exception("payment receive entry creation fail");
      }
      $authid= Auth::id();
      $paymentReceive_entry = new PaymentReceiveEntryModel();
      $paymentReceive_entry->amount =$paymentreceive['amount'];
      $paymentReceive_entry->payment_receives_id =$paymentreceive['id'];
      $paymentReceive_entry->invoice_id =$invoice_id;
      $paymentReceive_entry->created_by=$authid;
      $paymentReceive_entry->updated_by=$authid;
      if(!$paymentReceive_entry->save())
      {
          throw new \Exception("payment receive entry creation fail");
      }

      $this->journalEntry($request,$invoice_id,$paymentreceive['id']);
      return $paymentreceive;
     }

     public function journalEntry($request,$invoice_id,$payment_recieve_id)
     {
         if(!$request instanceof Request)
         {
             return null;
         }
         if(!$request->check_payment || !$request->submit)
         {
             return null;
         }
         $amount = $request['payment_amount'];
        $authid= Auth::id();
        $entries = [];
         //row1
        $entries[] = array(
            "debit_credit"=>1,
            "amount"=>$amount,
            "account_name_id"=>$request['payment_account'],
            "jurnal_type"=>"payment_receive2",
            "invoice_id"=>null,
            "payment_receives_id"=>$payment_recieve_id,
            "contact_id"=>$request['customer_id'],
            "created_by"=>$authid,
            "updated_by"=>$authid,
            "created_at"=>date("Y-m-d H:i:s"),
            "updated_at"=>date("Y-m-d H:i:s"),
            "assign_date"=>date("Y-m-d H:i:s",strtotime($request['invoice_date'])),
        );
        // row2
        $entries[] = array(
             "debit_credit"=>0,
             "amount"=>$amount,
             "account_name_id"=>10,
             "jurnal_type"=>"payment_receive2",
             "invoice_id"=>null,
             "payment_receives_id"=>$payment_recieve_id,
             "contact_id"=>$request['customer_id'],
             "created_by"=>$authid,
             "updated_by"=>$authid,
            "created_at"=>date("Y-m-d H:i:s"),
            "updated_at"=>date("Y-m-d H:i:s"),
            "assign_date"=>date("Y-m-d H:i:s",strtotime($request['invoice_date'])),
         );
         // row3
         $entries[] = array(
             "debit_credit"=>0,
             "amount"=>$amount,
             "account_name_id"=>5,
             "jurnal_type"=>"payment_receive1",
             "invoice_id"=>$invoice_id,
             "payment_receives_id"=>$payment_recieve_id,
             "contact_id"=>$request['customer_id'],
             "created_by"=>$authid,
             "updated_by"=>$authid,
             "created_at"=>date("Y-m-d H:i:s"),
             "updated_at"=>date("Y-m-d H:i:s"),
             "assign_date"=>date("Y-m-d H:i:s",strtotime($request['invoice_date'])),
         );
         // row 4
         $entries[] = array(
             "debit_credit"=>1,
             "amount"=>$amount,
             "account_name_id"=>10,
             "jurnal_type"=>"payment_receive1",
             "invoice_id"=>$invoice_id,
             "payment_receives_id"=>$payment_recieve_id,
             "contact_id"=>$request['customer_id'],
             "created_by"=>$authid,
             "updated_by"=>$authid,
             "created_at"=>date("Y-m-d H:i:s"),
             "updated_at"=>date("Y-m-d H:i:s"),
             "assign_date"=>date("Y-m-d H:i:s",strtotime($request['invoice_date'])),
         );

         if(!JournalEntry::insert($entries))
         {
             throw new \Exception("journal entry creation fail");
         }

         return true;

     }


}