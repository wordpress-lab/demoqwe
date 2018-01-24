<?php
namespace App\Modules\Bill\Http\Response;
use App\Models\ManualJournal\JournalEntry;
use App\Models\MoneyOut\PaymentMade;
use App\Models\MoneyOut\PaymentMadeEntry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


/**
 * Created by Rayhan.
 * User: Ontik
 * Date: 11/12/2017
 * Time: 12:20 PM
 */
class Payment
{
  protected $paymentAmount = 0;
  public function makePaymentMade($request,$bill_id)
  {
      if(!$request instanceof Request)
      {

          return null;
      }
      if(!$request->check_payment || !$request->submit)
      {
        return null;
      }
      $newpr_number = PaymentMade::max("pm_number")+1;
      $authid= Auth::id();
      $newpaymentmade = new PaymentMade();
      $newpaymentmade->payment_date =date("d-m-Y",strtotime($request['bill_date']));
      $newpaymentmade->pm_number =str_pad($newpr_number,"6",0,STR_PAD_LEFT);
      $newpaymentmade->bank_info = $request['payment_deposit_details'];

      $newpaymentmade->reference='';
      $newpaymentmade->amount= $request['payment_amount'];
      $newpaymentmade->excess_amount=0;
      $newpaymentmade->payment_mode_id=1;
      $newpaymentmade->account_id=$request['payment_account'];
      $newpaymentmade->vendor_id=$request['customer_id'];
      $newpaymentmade->created_by=$authid;
      $newpaymentmade->updated_by=$authid;
      if(!$newpaymentmade->save())
      {
       throw new \Exception("Payment made creation fail .");
      }


      return $this->makePaymentMadeEntry($request,$newpaymentmade,$bill_id);
  }
     public function makePaymentMadeEntry($request,$paymentmade = null,$bill_id=null)
     {
      if(is_null($paymentmade) || is_null($bill_id))
      {
          throw new \Exception("payment made entry creation fail. need required data");
      }
      if(!$paymentmade instanceof PaymentMade)
      {
         throw new \Exception("payment made entry creation fail");
      }


      $authid= Auth::id();
      $paymentReceive_entry = new PaymentMadeEntry();
      $paymentReceive_entry->amount =$paymentmade['amount'];
      $paymentReceive_entry->payment_made_id =$paymentmade['id'];
      $paymentReceive_entry->bill_id =$bill_id;
      $paymentReceive_entry->created_by=$authid;
      $paymentReceive_entry->updated_by=$authid;
      if(!$paymentReceive_entry->save())
      {
          throw new \Exception("payment made entry creation fail");
      }


      $this->journalEntry($request,$bill_id,$paymentmade['id']);
      return $paymentmade;
     }

     public function journalEntry($request,$bill_id,$payment_bill_id)
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
        // $request['payment_account']
        $authid= Auth::id();
        $entries = [];
         //row1
        $entries[] = array(
            "debit_credit"=>0,
            "amount"=>$amount,
            "account_name_id"=>27,
            "jurnal_type"=>"payment_made1",
            "bill_id"=>$bill_id,
            "payment_made_id"=>$payment_bill_id,
            "contact_id"=>$request['customer_id'],
            "created_by"=>$authid,
            "updated_by"=>$authid,
            "created_at"=>date("Y-m-d H:i:s"),
            "updated_at"=>date("Y-m-d H:i:s"),
            "assign_date"=>date("Y-m-d H:i:s",strtotime($request['bill_date'])),
        );
        // row2
        $entries[] = array(
             "debit_credit"=>1,
             "amount"=>$amount,
             "account_name_id"=>11,
             "jurnal_type"=>"payment_made1",
             "bill_id"=>$bill_id,
             "payment_made_id"=>$payment_bill_id,
             "contact_id"=>$request['customer_id'],
             "created_by"=>$authid,
             "updated_by"=>$authid,
             "created_at"=>date("Y-m-d H:i:s"),
             "updated_at"=>date("Y-m-d H:i:s"),
             "assign_date"=>date("Y-m-d H:i:s",strtotime($request['bill_date'])),
         );
         // row3
         $entries[] = array(
             "debit_credit"=>1,
             "amount"=>$amount,
             "account_name_id"=>27,
             "jurnal_type"=>"payment_made2",
             "bill_id"=>null,
             "payment_made_id"=>$payment_bill_id,
             "contact_id"=>$request['customer_id'],
             "created_by"=>$authid,
             "updated_by"=>$authid,
             "created_at"=>date("Y-m-d H:i:s"),
             "updated_at"=>date("Y-m-d H:i:s"),
             "assign_date"=>date("Y-m-d H:i:s",strtotime($request['bill_date'])),
         );
         // row 4
         $entries[] = array(
             "debit_credit"=>0,
             "amount"=>$amount,
             "account_name_id"=>$request['payment_account'],
             "jurnal_type"=>"payment_made2",
             "bill_id"=>null,
             "payment_made_id"=>$payment_bill_id,
             "contact_id"=>$request['customer_id'],
             "created_by"=>$authid,
             "updated_by"=>$authid,
             "created_at"=>date("Y-m-d H:i:s"),
             "updated_at"=>date("Y-m-d H:i:s"),
             "assign_date"=>date("Y-m-d H:i:s",strtotime($request['bill_date'])),
         );

         if(!JournalEntry::insert($entries))
         {
             throw new \Exception("journal entry creation fail");
         }

         return true;

     }


}