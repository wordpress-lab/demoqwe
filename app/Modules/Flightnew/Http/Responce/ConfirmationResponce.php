<?php

namespace App\Modules\Flightnew\Http\Responce;
use App\Models\Flightnew\Confirmation;
use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use App\Models\ManualJournal\JournalEntry;
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\BillEntry;
use Illuminate\Support\Facades\Auth;

/**
 * Created by PhpStorm.
 * User: ontik
 * Date: 11/2/2017
 * Time: 2:56 PM
 */
class ConfirmationResponce
{

    public function MakeBill($request,$id)
    {
        if(!$request->check_bill)
        {
            return null;
        }
        $this->Itempurchase($request);
        $particular = $request->bill_particular;
        $qty = $request->bill_qty?$request->bill_qty:0;
        $rate = $request->bill_rate?$request->bill_rate:0;
        $bill_date =date("Y-m-d") ;
        $due_date = date("Y-m-d",strtotime(date('Y-m-d')."+7 days"));
        $bill_total_amount = $qty*$rate;
        $bill_due_amount = $bill_total_amount;
        $customer_id =$request->vendor_name;
        $created_by = Auth::id();

        $bill_number = Bill::max('bill_number');
        $bill_number = str_pad(++$bill_number, 6, '0', STR_PAD_LEFT);

        $newBill =  new Bill();
        $newBill->bill_number= $bill_number;
        $newBill->amount= $bill_total_amount;
        $newBill->due_amount= $bill_due_amount;
        $newBill->bill_date= $bill_date;
        $newBill->due_date= $due_date;
        $newBill->item_rates= 1;
        $newBill->note= ' ';
        $newBill->total_tax= 0;
        $newBill->vendor_id= $customer_id;
        $newBill->created_by= $created_by;
        $newBill->updated_by= $created_by;

        if($newBill->save())
        {
            $recruit=Confirmation::where('pax_id',$id)->first();

            $recruit->bill_id=$newBill->id;
            $recruit->save();

            $newBillEntry =  new BillEntry();
            $newBillEntry->item_id=$particular;
            $newBillEntry->account_id=26;
            $newBillEntry->quantity=$qty;
            $newBillEntry->rate=$rate;
            $newBillEntry->tax_id=1;
            $newBillEntry->amount=$bill_total_amount;
            $newBillEntry->bill_id=$newBill->id;
            $newBillEntry->created_by=$created_by;
            $newBillEntry->updated_by=$created_by;
            if($newBillEntry->save()){
                $this->StockStore($newBillEntry,$bill_date);
                return $newBill;
            }
            throw new \Exception("bill entry not saved");
        }

        throw new \Exception("bill not saved");

    }

    public function Itempurchase($request)
    {
        $item = Item::find($request['bill_particular']);
        if($item)
        {
            $item->total_purchases = $item->total_purchases+$request['bill_qty'];
            if($item->save())
            {
                return true;
            }

        }

        throw new \Exception("Bill Item not found");


    }

    public function UpdateItempurchase($request,$order)
    {
        $bill_id = $order['bill_id'];
        $stock = Stock::where('bill_id',$bill_id)->first();
        $stock_particular = $stock['item_id'];
        $stock_qty = $stock['total'];
        if($stock_particular==$request['bill_particular'] && $stock_qty == $request['bill_qty'])
        {
            return $stock->delete();
        }
        $old_item= Item::find($stock_particular);

        $item = Item::find($request['bill_particular']);

        if($item)
        {
            // only quantity change
            if($stock_particular==$request['bill_particular'] && $stock_qty != $request['bill_qty'])
            {
                $item->total_purchases = ($item->total_purchases-$stock_qty)+$request['bill_qty'];
                if($item->save())
                {
                    return true;
                }
            }
            // item and quantity change
            $old_item->total_purchases = $old_item->total_purchases - $stock_qty;
            $old_item->save();

            $item->total_purchases = $item->total_purchases+$request['bill_qty'];
            if($item->save())
            {
                return true;
            }

        }

        throw new \Exception("Bill Item not found");


    }

    public function StockStore($billentry,$bill_date)
    {
        $created_by = Auth::id();
        if(!$billentry instanceof BillEntry)
        {
            throw new \Exception("only billentry can store stock");
        }

        if(!$billentry)
        {
            throw new \Exception("no bill entry found");
        }

        $stock =  new Stock();

        $stock->total = $billentry['quantity'];
        $stock->date = date("d-m-Y",strtotime($bill_date));
        $stock->item_category_id = $billentry->item['item_category_id'];
        $stock->item_id = $billentry->item_id;
        $stock->bill_id = $billentry->bill_id;
        $stock->branch_id = session('branch_id');
        $stock->created_by = $created_by;
        $stock->updated_by = $created_by;


        if($stock->save())
        {
            return $stock;
        }
        throw new \Exception("no bill entry found");
    }

    public function BillJournalEntry($bill)
    {
        if(!$bill instanceof Bill)
        {
            throw new \Exception("only Bill can store journal entry");
        }

        $dr_journalentry = new JournalEntry();
        $dr_journalentry->debit_credit= 0;
        $dr_journalentry->amount= $bill['amount'];
        $dr_journalentry->account_name_id= 11;
        $dr_journalentry->jurnal_type= 'bill';
        $dr_journalentry->bill_id= $bill['id'];
        $dr_journalentry->contact_id= $bill['vendor_name'];
        $dr_journalentry->created_by= $bill['created_by'];
        $dr_journalentry->updated_by= $bill['updated_by'];
        $dr_journalentry->assign_date= $bill['bill_date'];
        if(!$dr_journalentry->save())
        {
            throw new \Exception("bill journal entry not saved");
        }

        $cr_journalentry = new JournalEntry();
        $cr_journalentry->debit_credit= 1;
        $cr_journalentry->amount= $bill['amount'];
        $cr_journalentry->account_name_id= 26;
        $cr_journalentry->jurnal_type= 'bill';
        $cr_journalentry->bill_id= $bill['id'];
        $cr_journalentry->contact_id= $bill['vendor_name'];
        $cr_journalentry->created_by= $bill['created_by'];
        $cr_journalentry->updated_by= $bill['updated_by'];
        $cr_journalentry->assign_date= $bill['bill_date'];
        if(!$cr_journalentry->save())
        {
            throw new \Exception("bill journal entry not saved");
        }

        return true;
    }

}