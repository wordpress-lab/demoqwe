<?php

namespace App\Modules\Estimate\Http\Controllers;

use App\Models\Moneyin\Estimate;
use App\MOdels\Moneyin\Estimate_Entry;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use DB;

use App\Models\Inventory\Item;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\PaymentReceives;
class EstimateApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getItemRate($item_id)
    {
        $item_rate = Item::find($item_id)->item_sales_rate;
        $item_category_id = Item::find($item_id)->item_category_id;
        return response()->json([
            'item_rate'         =>  $item_rate,
            'item_type'  =>  $item_category_id,
        ], 201);
    }

    public function getInvoiceEntry($invoice_id)
    {
        $invoice_entries =Estimate_Entry::where('estimate_id',$invoice_id)->get();
        $invoice = Estimate::find($invoice_id);
        $item = DB::table('item')->select('item_name as text', 'id as value')->get();
        $tax = DB::table('tax')->select('tax_name as text', 'id as value')->get();
        $account = DB::table('account')->select('account_name as text', 'id as value')->get();

        return response()->json([
            'invoice_entries'   =>  $invoice_entries,
            'item'              =>  $item,
            'tax'               =>  $tax,
            'invoice'           =>  $invoice,
            'account'           =>  $account,
        ], 201);

    }

    public function getDueBalance($id)
    {
        $helper = new \App\Lib\Helpers;

        $invoice = Estimate::find($id);
        $customer_id = $invoice->customer_id;
        $use_credits = $helper->findCredit($id,$customer_id);

        $excess_payments = PaymentReceives::where('customer_id', $customer_id)->where('excess_payment', '>', 0)->where('excess_payment', '>', 0)->get();

        $paid_amount = 0;
        $total_amount = Estimate::find($id)->total_amount;
        $paid_amount = $helper->getPaidAmount($id);

        $due_balance = ($total_amount - $paid_amount);

        return response()->json([
            'due_balance'       =>  $due_balance,
            'use_credits'       =>  $use_credits,
            'excess_payments'   =>  $excess_payments,
        ], 201);
    }

    public function creditAvailable($invoice_id, $credit_note_id)
    {
        $credit_use_amount = DB::table('credit_note_payments')->sum('amount');
        $credit_amount = CreditNote::find($credit_note_id)->total_credit_note;

        $credit_available = $credit_amount - $credit_use_amount;
        return response()->json([
            'credit_available'   =>  $credit_available,
        ], 201);
    }
}
