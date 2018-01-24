<?php

namespace App\Modules\Invoice\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use App\Models\Inventory\Item;
use App\Models\PriceList\PriceList;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\PaymentReceives;


class InvoiceApiController extends Controller
{
    public function getItemRate($item_id)
    {
        $item_rate = Item::find($item_id)->item_sales_rate;
        $item_category_id = Item::find($item_id)->item_category_id;
        return response()->json([
            'item_rate'         =>  $item_rate,
            'item_type'  =>  $item_category_id,
        ], 201);
    }
    public function getItemRate2($item_id,$contact_id)
    {
        $item_rate = Item::find($item_id)->item_sales_rate;
        if (PriceList::where('contact_id',$contact_id)->where('item_id',$item_id)->first()) {
            $item_rate = PriceList::where('contact_id',$contact_id)->where('item_id',$item_id)->first()->sales_rate;
        }
        
        
        $item_category_id = Item::find($item_id)->item_category_id;
        return response()->json([
            'item_rate'         =>  $item_rate,
            'item_type'  =>  $item_category_id,
        ], 201);
    }

    public function getInvoiceEntry($invoice_id)
    {
        $invoice_entries = InvoiceEntry::where('invoice_id',$invoice_id)->get();
        $invoice = Invoice::find($invoice_id);
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
        
        $invoice = Invoice::find($id);
        $customer_id = $invoice->customer_id;
        $use_credits = $helper->findCredit($id,$customer_id);

        $excess_payments = PaymentReceives::where('customer_id', $customer_id)->where('excess_payment', '>', 0)->where('excess_payment', '>', 0)->get();

        $paid_amount = 0;
        $total_amount = Invoice::find($id)->total_amount;
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
