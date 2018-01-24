<?php

namespace App\Modules\Bill\Http\Controllers\PurchaseReturn;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

//Models
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\BillEntry;
use App\Models\MoneyOut\BillReturnEntry;
use App\Models\Inventory\Item;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Inventory\Stock;
use App\Models\MoneyOut\PaymentMadeEntry;
use App\User;


class WebController extends Controller
{
    public function index()
    {
        //
    }

    public function create($id)
    {
        $bill = Bill::find($id);
        $bill_entries = BillEntry::where('bill_id',$id)->get();
        return view('bill::purchase_return.index' , compact('bill' , 'bill_entries'));
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

        try{
            DB::beginTransaction();
            $count = count($input['bill_entries_id']);
            $total_discount   = 0;

            for($i=0; $i<$count; $i++)
            {
                $discount = 0;

                if($input['returned_quantity'][$i] != Null){
                    
                    $insert = new BillReturnEntry;

                    $insert->bill_entries_id    = $input['bill_entries_id'][$i];
                    $insert->returned_quantity  = $input['returned_quantity'][$i];
                    $insert->created_by         = $user;
                    $insert->updated_by         = $user;

                    $insert->save();

                    //Invoice Entries
                    $bill_entry = BillEntry::find($input['bill_entries_id'][$i]);

                    $quantity = ($bill_entry->quantity - $input['returned_quantity'][$i]);

                    $amount = ($bill_entry->rate * $quantity);
                    
                    $bill_entry->amount      = $amount;
                    $bill_entry->quantity    = $quantity;
                    $bill_entry->updated_by  = $user;

                    $bill_entry->update();


                    //Item
                    $item = Item::find($bill_entry->item_id);

                    $item->total_purchases  -= $input['returned_quantity'][$i];

                    $item->update();

                    //Stock
                    $stock = Stock::where(['bill_id' => $id,'item_id' => $bill_entry->item_id])->first();

                    $stock->total       -= $input['returned_quantity'][$i];
                    $stock->updated_by  = $user;

                    $stock->update();

                }

                
            }


            $bill_entry = DB::select( DB::raw("(SELECT account_id as account_id, SUM(quantity*rate) as amount FROM bill_entry WHERE bill_id=$id GROUP BY account_id)"));

            for($i=0;$i<count($bill_entry);$i++){
                $journal_entries = JournalEntry::where(['bill_id' => $id,'account_name_id' => $bill_entry[$i]->account_id])->first();

                $journal_entries->amount        = $bill_entry[$i]->amount;
                $journal_entries->updated_by    = $user;

                $journal_entries->update();
            }

            //Payment Made
            $payment_made = PaymentMadeEntry::where('bill_id' , $id)->sum('amount');

            //Invoice

            $bill = Bill::find($id);
            $bill_entries_amount = BillEntry::where('bill_id',$id)->sum('amount');

            $total_amount = $bill->amount;
            $tax_total = $bill->total_tax;

            $tax_main = (($tax_total * 100)/($total_amount - $tax_total));

            $tax = ($bill_entries_amount * $tax_main)/100;

            $main_amount = ($bill_entries_amount + $tax);

            $bill->amount           = $main_amount;
            $bill->due_amount       = ($main_amount - $payment_made);
            $bill->total_tax        = $tax;
            $bill->updated_by       = $user;

            $bill->update();

            //journal Tax

            $journal = JournalEntry::where(['bill_id' => $id,'account_name_id' => 9,'debit_credit' => 1])->first();

            if($journal){
                $journal->amount = $tax;
                
                $journal->update();
            }

            //Journal amount 
            $journal = JournalEntry::where(['bill_id' => $id,'account_name_id' => 11,'debit_credit' => 0])->first();

            $journal->amount = ($bill_entries_amount + $tax);
                
            $journal->update();
            

            DB::commit();

            return Redirect::route('bill')
                            ->with(['alert.message' => 'Purchase Return updated successfully','alert.status' => 'success']);
        }
        catch(\Exception $e){
            DB::rollback();
            $mesg = $e->getMessage();
            return redirect()
                ->route('bill')
                ->with('alert.status', 'delete')
                ->with('alert.message', " $mesg");
        }
    }

    public function destroy($id)
    {
        //
    }
}
