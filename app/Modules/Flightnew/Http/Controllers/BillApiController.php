<?php

namespace App\Modules\Bill\Http\Controllers;

use App\Models\MoneyOut\PaymentMade;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use App\Models\Inventory\Item;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\PaymentReceives;
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\BillEntry;

class BillApiController extends Controller
{
    public function getItemRate($item_id)
    {
        $item_rate = Item::find($item_id)->item_purchase_rate;
        $item_category_id = Item::find($item_id)->item_category_id;
        return response()->json([
            'item_rate'   =>  $item_rate,
            'item_type'  =>  $item_category_id,
        ], 201);
    }

    public function getBillEntry($bill_id)
    {
        $bill_entries = BillEntry::where('bill_id',$bill_id)->get();
        $bill = Bill::find($bill_id);
        $item = DB::table('item')->select('item_name as text', 'id as value')->get();
        $tax = DB::table('tax')->select('tax_name as text', 'id as value')->get();
        $account = DB::table('account')->select('account_name as text', 'id as value')->get();

        return response()->json([
            'bill_entries'   =>  $bill_entries,
            'item'           =>  $item,
            'tax'            =>  $tax,
            'bill'           =>  $bill,
            'account'        =>  $account,
        ], 201);

    }

    public function getDueBalance($id)
    {
        $helper = new \App\Lib\Helpers;

        $bill = Bill::find($id);
        $vendor_id = $bill->vendor_id;

        $excess_payments = PaymentMade::where('vendor_id', $vendor_id)->where('excess_amount', '>', 0)->get();

        $paid_amount = 0;
        $total_amount = Bill::find($id)->amount;
        $paid_amount = $helper->getBillPaidAmount($id);

        $due_balance = ($total_amount - $paid_amount);

        return response()->json([
            'due_balance'       =>  $due_balance,
            'excess_payments'   =>  $excess_payments,
        ], 201);
    }
}
