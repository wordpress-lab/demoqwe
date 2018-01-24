<?php

namespace App\Modules\Paymentmade\Http\Controllers;

use App\Models\MoneyOut\PaymentMade;
use App\Models\MoneyOut\PaymentMadeEntry;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\Contact\Contact;
use App\Models\PaymentMode\PaymentMode;
use App\Models\AccountChart\Account;
use App\Models\MoneyOut\Bill;
use DB;

class PaymentMadeApiController extends Controller
{
   public function getVendorList()
   {
       $contacts = DB::table('contact')->select('display_name as text', 'id as value')->get();
       $paid_throughs  = DB::table('account')->select('account_name as text', 'id as value')
           ->whereIn('account_type_id',[5,4])->get();

       return response()->json([
           'vendor'         =>  $contacts,
           'paid_throughs'  =>  $paid_throughs,
       ], 201);
   }

    public function getVendorBill($vendor_id)
    {
        $bills = Bill::where('vendor_id', $vendor_id)->where('due_amount', '>', 0)->get();
        return response()->json([
            'bills'   =>  $bills,
        ], 201);
    }


    public function getVendorBillEdit($vendor_id)
    {
        $bills = Bill::where('vendor_id', $vendor_id)->get();
        return response()->json([
            'bills'   =>  $bills,
        ], 201);
    }

    public function getPaymentMadeEntry($payment_made_id)
    {
        $payment_made_entry  = PaymentMadeEntry::where('payment_made_id', $payment_made_id)->get();
        $payment_made_amount = PaymentMade::find($payment_made_id)->amount;
        $vendor_id = PaymentMade::find($payment_made_id)->vendor_id;
        $account_id = PaymentMade::find($payment_made_id)->account_id;
        $contacts = DB::table('contact')->select('display_name as text', 'id as value')->get();
        $paid_throughs  = DB::table('account')->select('account_name as text', 'id as value')
            ->whereIn('account_type_id',[4,5])->get();
        return response()->json([
            'payment_made_entry'   =>  $payment_made_entry,
            'vendors'              =>  $contacts,
            'vendor_id'            =>  $vendor_id,
            'payment_made_amount'  =>  $payment_made_amount,
            'paid_throughs'        =>  $paid_throughs,
            'account_id'           =>  $account_id,
        ], 201);
    }
}
