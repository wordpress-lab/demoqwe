<?php

namespace App\Modules\Invoice\Http\Controllers\SalesReturn;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

//Models
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\InvoiceReturnEntry;
use App\Models\Inventory\Item;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\User;

class WebController extends Controller
{
    public function index()
    {
        //
    }

    public function create($id)
    {
        $invoice = Invoice::find($id);
        $invoice_entries = InvoiceEntry::where('invoice_id',$id)->get();
        return view('invoice::sales_return.index' , compact('invoice' , 'invoice_entries'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();
        $user = Auth::id();
        //dd(count($input['invoice_entries_id']));

        try{
            DB::beginTransaction();
            $count = count($input['invoice_entries_id']);
            $total_discount   = 0;

            for($i=0; $i<$count; $i++)
            {
                $discount = 0;

                if($input['returned_quantity'][$i] != Null){
                    
                    $insert = new InvoiceReturnEntry;

                    $insert->invoice_entries_id = $input['invoice_entries_id'][$i];
                    $insert->returned_quantity  = $input['returned_quantity'][$i];
                    $insert->created_by         = $user;
                    $insert->updated_by         = $user;

                    $insert->save();

                    //Invoice Entries
                    $invoice_entry = InvoiceEntry::find($input['invoice_entries_id'][$i]);

                    $quantity = ($invoice_entry->quantity - $input['returned_quantity'][$i]);

                    if($invoice_entry->discount_type == 1){
                        $discount = $invoice_entry->discount;
                        $amount = (($invoice_entry->rate * $quantity) - $invoice_entry->discount);
                    }
                    elseif($invoice_entry->discount_type == 0){
                        $discount = (($invoice_entry->rate * $quantity * $invoice_entry->discount)/100);
                        $amount = (($invoice_entry->rate * $quantity) - $discount);

                    }
                    else{
                        $amount = ($invoice_entry->rate * $quantity);
                    }
                    $invoice_entry->amount      = $amount;
                    $invoice_entry->quantity    = $quantity;
                    $invoice_entry->updated_by  = $user;

                    $invoice_entry->update();


                    //Item
                    $item = Item::find($invoice_entry->item_id);

                    $item->total_sales  -= $input['returned_quantity'][$i];

                    $item->update();

                }
                else{
                    $invoice_entry = InvoiceEntry::find($input['invoice_entries_id'][$i]);

                    $quantity = $invoice_entry->quantity;

                    if($invoice_entry->discount_type == 1){
                        $discount = $invoice_entry->discount;
                    }
                    elseif($invoice_entry->discount_type == 0){
                        $discount = (($invoice_entry->rate * $quantity * $invoice_entry->discount)/100);

                    }
                    else{
                        $amount = ($invoice_entry->rate * $quantity);
                    }
                }

                $total_discount += $discount;
                
            }

            //journal

            $journal = JournalEntry::where(['invoice_id' => $id,'account_name_id' => 21,'debit_credit' => 1])->first();

            if($journal){
                $journal->amount = $total_discount;
                
                $journal->update();
            }

            //Journal Entries

            $invoice_entry = DB::select( DB::raw("(SELECT account_id as account_id, SUM(quantity*rate) as amount FROM invoice_entries WHERE invoice_id=$id GROUP BY account_id)"));

            for($i=0;$i<count($invoice_entry);$i++){
                $journal_entries = JournalEntry::where(['invoice_id' => $id,'account_name_id' => $invoice_entry[$i]->account_id])->first();

                $journal_entries->amount        = $invoice_entry[$i]->amount;
                $journal_entries->updated_by    = $user;

                $journal_entries->update();
            }

            //Payment Receive Entry

            $payment_receive = PaymentReceiveEntryModel::where('invoice_id' , $id)->sum('amount');

            //Invoice

            $invoice = Invoice::find($id);
            $invoice_entries_amount = InvoiceEntry::where('invoice_id',$id)->sum('amount');

            $adjustment = $invoice->adjustment;
            $shipping_charge = $invoice->shipping_charge;
            $pr_adjustment = $invoice->pr_adjustment;
            $total_amount = $invoice->total_amount;
            $tax_total = $invoice->tax_total;

            $tax_main = ($tax_total * 100)/($total_amount - $tax_total);
            $tax = ($invoice_entries_amount * $tax_main)/100;

            $main_amount = ($invoice_entries_amount + $adjustment + $shipping_charge + $pr_adjustment + $tax);

            $invoice->total_amount      = $main_amount;
            $invoice->due_amount        = ($main_amount - $payment_receive);
            $invoice->tax_total         = $tax;
            $invoice->updated_by        = $user;

            $invoice->update();



            //journal Tax

            $journal = JournalEntry::where(['invoice_id' => $id,'account_name_id' => 9,'debit_credit' => 0])->first();

            if($journal){
                $journal->amount = $tax;
                
                $journal->update();
            }

            //journal Amount

            //journal Tax

            $journal = JournalEntry::where(['invoice_id' => $id,'account_name_id' => 5,'debit_credit' => 1])->first();

            if($journal){
                $journal->amount = $main_amount;
                
                $journal->update();
            }

            DB::commit();

            return Redirect::route('invoice')
                            ->with(['alert.message' => 'Sales Return updated successfully','alert.status' => 'success']);
        }
        catch(\Exception $e){
            DB::rollback();
            $mesg = $e->getMessage();
            return redirect()
                ->route('invoice')
                ->with('alert.status', 'delete')
                ->with('alert.message', " $mesg");
        }
    }

    public function destroy($id)
    {
        //
    }
}
