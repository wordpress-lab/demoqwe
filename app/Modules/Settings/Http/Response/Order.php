<?php
namespace App\Modules\Settings\Http\Response;

use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\BillEntry;
use App\Models\Visa\Ticket\Order\Order as lastorder;
use App\Models\Visa\Ticket\Order\Ticket_order_tax;
use App\Models\Visa\Ticket\TicketCommission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;

/**
 * Created by Rayhan
 * User: Ontik
 * Date: 10/29/2017
 * Time: 10:04 AM
 */
class Order
{

  public function __construct()
  {

  }

  public function OrderId_generate()
   {
       $order = lastorder::count();
       if($order)
       {
           $order = lastorder::orderBy('id', 'desc')->first();

           $order_id =explode('-',$order['order_id'])[1];
           $order_id=$order_id+1;
           $neworder= str_pad($order_id, 6, '0', STR_PAD_LEFT);
           return $neworder;
       }
       $neworder= str_pad(1, 6, '0', STR_PAD_LEFT);
       return $neworder;

   }

   public function ticketCommission($amount=null,$request)
   {


       $finalValue= 0;
       $input = Input::all();
       $title = $input['title'];
       $amount = $input['amount'];

       if(empty($request->taxOnCommission))
       {

           $comitiontax = TicketCommission::first();
           $ticketComition = $comitiontax->commissionTax;
           $totalamount = 0;
           $bdAmount = 0;
           $utAmount = 0;

           foreach ($title as $key => $value)
           {
               if(empty($value))
               {
                   continue;
               }
               if(is_array($request->title[$key]))
               {
                   $tit = array_keys($request->title[$key])[0];
                   $title = $request->title[$key][$tit];
               }
               else
               {
                   $title = $request->title[$key];
               }

               if(is_array($request->amount[$key]))
               {
                   $amou = array_keys($request->amount[$key])[0];
                   $amount = $request->amount[$key][$amou]?$request->amount[$key][$amou]:0;

                   $totalamount = $totalamount + $amount;
               }
               else
               {
                   $amount = $request->amount[$key];

                   $totalamount = $totalamount + $amount;

               }
               if(trim(strtoupper($title)) == 'BD')
               {
                   $bdAmount = $amount;
               }
               if(trim(strtoupper($title)) == 'UT')
               {
                   $utAmount = $amount;
               }


           }
           $totalFare = $request->fareAmount?$request->fareAmount:null;
           $comitionTax = $ticketComition/100;
           $finalValue = (($totalFare + $totalamount) - ($bdAmount + $utAmount)) * $comitionTax;
           return $finalValue;
       }

       return $finalValue;
   }
   public function ticketCommissionUpdate($request)
   {


       $finalValue= null;
       $input = Input::all();
       $title = $input['title'];

       if(empty($request->taxOnCommission))
       {

           $comitiontax = TicketCommission::first();
           $ticketComition = $comitiontax->commissionTax;
           $totalamount = 0;
           $bdAmount = 0;
           $utAmount = 0;

           foreach ($title as $key => $value)
           {
               if(empty($value))
               {
                   continue;
               }
               if(is_array($request->title[$key]))
               {
                   $tit = array_keys($request->title[$key])[0];
                   $title = $request->title[$key][$tit];
               }
               else
               {
                   $title = $request->title[$key];
               }

               if(is_array($request->amount[$key]))
               {
                   $amou = array_keys($request->amount[$key])[0];
                   $amount = $request->amount[$key][$amou]?$request->amount[$key][$amou]:0;

                   $totalamount = $totalamount + $amount;
               }
               else
               {
                   $amount = $request->amount[$key];

                   $totalamount = $totalamount + $amount;

               }
               if(trim(strtoupper($title)) == 'BD')
               {
                   $bdAmount = $amount;
               }
               if(trim(strtoupper($title)) == 'UT')
               {
                   $utAmount = $amount;
               }


           }
           $totalFare = $request->fareAmount?$request->fareAmount:null;
           $comitionTax = $ticketComition/100;
           $finalValue = (($totalFare + $totalamount) - ($bdAmount + $utAmount)) * $comitionTax;
           return $finalValue;
       }

       return $finalValue;
   }

   public function ticketCommissionStore($request,$order)
   {
       $input = Input::all();
       $title = $input['title'];
       $amount = null;
       $data = [];
       foreach ($title as $key => $cond)
       {


           if (is_array($request->title[$key])) {
               $tit = array_keys($request->title[$key])[0];
               $title = $request->title[$key][$tit];
           } else {
               $title = $request->title[$key];
           }
           if (is_array($request->amount[$key])) {
               $amou = array_keys($request->amount[$key])[0];
               $amount = $request->amount[$key][$amou];
           } else {
               $amount = $request->amount[$key];
           }
           if(empty($title)){
               continue;
           }

           $data[] = array(
               'title' => $title,
               'amount' => $amount?$amount:0,
               'ticket_order_id' => $order,
           );

       }

       return Ticket_order_tax::insert($data);
   }

   public function MakeInvoice($request,$order)
  {

      if(!$request->check_invoice)
      {
       return null;
      }
      $this->Itemsales($request);
      $particular = $request->invoice_particular;
      $qty = $request->invoice_qty;
      $rate = $request->invoice_rate;
      $invoice_Date = $request->issuDate;
      $payment_date = date("Y-m-d",strtotime(date('Y-m-d')."+7 days"));
      $invoice_total_amount = $qty*$rate;
      $invoice_due_amount = $invoice_total_amount;
      $customer_id =$request->contact_id;
      $created_by = Auth::id();
      $invoice_number = Invoice::max('id');
      $invoice_number = str_pad(++$invoice_number, 6, '0', STR_PAD_LEFT);

      $newInvoice = new Invoice();
      $newInvoice->invoice_number= $invoice_number;
      $newInvoice->invoice_date= date("d-m-Y",strtotime($invoice_Date));
      $newInvoice->payment_date= date("d-m-Y",strtotime($payment_date));
      $newInvoice->total_amount= $invoice_total_amount;
      $newInvoice->due_amount= $invoice_due_amount;
      $newInvoice->customer_id= $customer_id;
      $newInvoice->created_by= $created_by;
      $newInvoice->updated_by= $created_by;

      if($newInvoice->save())
      {
         $newInvoiceEntry = new InvoiceEntry();

         $newInvoiceEntry->quantity = $qty;
         $newInvoiceEntry->rate = $rate;
         $newInvoiceEntry->amount = $invoice_total_amount;
         $newInvoiceEntry->item_id = $particular;
         $newInvoiceEntry->invoice_id = $newInvoice->id;
         $newInvoiceEntry->tax_id = 1;
         $newInvoiceEntry->account_id = 16;
         $newInvoiceEntry->account_id = 16;
         $newInvoiceEntry->created_by= $created_by;
         $newInvoiceEntry->updated_by= $created_by;
         if($newInvoiceEntry->save())
         {
             return $newInvoice;
         }
          throw new \Exception("invoice entry not saved");

      }

      throw new \Exception("invoice not saved");

  }

   public function Itemsales($request)
  {
    $item = Item::find($request['invoice_particular']);
    if($item)
    {
        $item->total_sales = $item->total_sales+$request['invoice_qty'];
        if($item->save())
        {

            return true;
        }



    }

    throw new \Exception("Invoice Item not found");


  }
   public function UpdateItemsales($request,$newInvoiceEntry)
  {
      if(!$newInvoiceEntry instanceof InvoiceEntry)
      {
          throw new \Exception("only invoice entry can update item");
      }

    $item = Item::find($request['invoice_particular']);
    $old_item = Item::find($newInvoiceEntry['item_id']);
    $inv_invoice_qty = $request->invoice_qty;

    if($request['invoice_particular'] == $newInvoiceEntry['item_id'] && $request['invoice_qty']==$newInvoiceEntry['quantity'])
    {
       return null;
    }


    if($item)
    {
        if($request['invoice_particular'] == $newInvoiceEntry['item_id'] && $request['invoice_qty']!=$newInvoiceEntry['quantity'])
        {
            $item->total_sales = ($item->total_sales-$newInvoiceEntry['quantity'])+$request['invoice_qty'];
            if($item->save())
            {
                return true;
            }
        }

        if($request['invoice_particular'] != $newInvoiceEntry['item_id'])
        {
            $item->total_sales = $item->total_sales-$newInvoiceEntry['quantity'];
            $item->save();

            $old_item->total_sales = $item->total_sales+$request['invoice_qty'];
            if($old_item->save())
            {
                return true;
            }

        }



    }

    throw new \Exception("Invoice Item not found");


  }


   public function MakeBill($request,$order)
  {
      if(!$request->check_bill)
      {
       return null;
      }
      $this->Itempurchase($request);
      $particular = $request->bill_particular;
      $qty = $request->bill_qty?$request->bill_qty:0;
      $rate = $request->bill_rate?$request->bill_rate:0;
      $bill_date = $request->issuDate;
      $due_date = date("Y-m-d",strtotime(date('Y-m-d')."+7 days"));
      $bill_total_amount = $qty*$rate;
      $bill_due_amount = $bill_total_amount;
      $customer_id = $request->vendor_id;
      $created_by = Auth::id();

      $bill_number = Bill::max('id');
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

   public function InvoiceJournalEntry($invoice)
    {
      if(!$invoice instanceof Invoice)
      {
          throw new \Exception("only invoice can store journal entry");
      }

       $dr_journalentry = new JournalEntry();
       $dr_journalentry->debit_credit= 0;
       $dr_journalentry->amount= $invoice['total_amount'];
       $dr_journalentry->account_name_id= 16;
       $dr_journalentry->jurnal_type= 'invoice';
       $dr_journalentry->invoice_id= $invoice['id'];
       $dr_journalentry->contact_id= $invoice['customer_id'];
       $dr_journalentry->created_by= $invoice['created_by'];
       $dr_journalentry->updated_by= $invoice['updated_by'];
       $dr_journalentry->assign_date= date("Y-m-d",strtotime($invoice['invoice_date']));
       if(!$dr_journalentry->save())
       {
           throw new \Exception("journal entry not saved");
       }

        $cr_journalentry = new JournalEntry();
        $cr_journalentry->debit_credit= 1;
        $cr_journalentry->amount= $invoice['total_amount'];
        $cr_journalentry->account_name_id= 5;
        $cr_journalentry->jurnal_type= 'invoice';
        $cr_journalentry->invoice_id= $invoice['id'];
        $cr_journalentry->contact_id= $invoice['customer_id'];
        $cr_journalentry->created_by= $invoice['created_by'];
        $cr_journalentry->updated_by= $invoice['updated_by'];
        $cr_journalentry->assign_date= date("Y-m-d",strtotime($invoice['invoice_date']));
        if(!$cr_journalentry->save())
        {
            throw new \Exception("journal entry not saved");
        }

        return true;
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
        $dr_journalentry->contact_id= $bill['vendor_id'];
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
        $cr_journalentry->contact_id= $bill['vendor_id'];
        $cr_journalentry->created_by= $bill['created_by'];
        $cr_journalentry->updated_by= $bill['updated_by'];
        $cr_journalentry->assign_date= $bill['bill_date'];
        if(!$cr_journalentry->save())
        {
            throw new \Exception("bill journal entry not saved");
        }

        return true;
    }


   public function invoiceUpdate($request,$order)
   {
       if(!$order instanceof \App\Models\Visa\Ticket\Order\Order)
       {
           throw new \Exception("only ticket can store invoice");
       }
       if(!$order['invoice_id'])
       {
         $newinvoice=$this->MakeInvoice($request,$order);
         $order->invoice_id = $newinvoice['id'];
         if($order->save())
         {
             return $newinvoice;
         }
           throw new \Exception("invoice order update fail");
       }

       //update
       //$this->UpdateInvocieByOrder($request,$order);

   }
   public function UpdateInvocieByOrder($request,$order)
   {
       if(!$request->check_invoice || is_null($order['invoice_id']) || empty($order['invoice_id']))
       {
           return null;
       }

       $particular = $request->invoice_particular;
       $qty = $request->invoice_qty;
       $rate = $request->invoice_rate;
//       $invoice_Date = $request->issuDate;
//       $payment_date = date("Y-m-d",strtotime(date('Y-m-d')."+7 days"));
       $invoice_total_amount = $qty*$rate;
       $invoice_due_amount = $invoice_total_amount;
       $customer_id =$request->contact_id;
       $created_by = Auth::id();
       $newInvoice = Invoice::find($order['invoice_id']);

//       $newInvoice->invoice_date= date("d-m-Y",strtotime($invoice_Date));
//       $newInvoice->payment_date= date("d-m-Y",strtotime($payment_date));
       $newInvoice->total_amount= $invoice_total_amount;
       $newInvoice->due_amount= $invoice_due_amount;
       $newInvoice->customer_id= $customer_id;
       $newInvoice->created_by= $created_by;
       $newInvoice->updated_by= $created_by;

       if($newInvoice->save())
       {

           $newInvoiceEntry = $newInvoice->OrderInvoiceEntries;
           $this->UpdateItemsales($request,$newInvoiceEntry);
           $newInvoiceEntry->quantity = $qty;
           $newInvoiceEntry->rate = $rate;
           $newInvoiceEntry->amount = $invoice_total_amount;
           $newInvoiceEntry->item_id = $particular;

           $newInvoiceEntry->created_by= $created_by;
           $newInvoiceEntry->updated_by= $created_by;
           if($newInvoiceEntry->save())
           {

               return $newInvoice;
           }
           throw new \Exception("invoice entry not updated");

       }

       throw new \Exception("invoice not updated");
   }
   public function billUpdate($request,$order)
   {
       if(!$order instanceof \App\Models\Visa\Ticket\Order\Order)
       {
           throw new \Exception("only ticket can store bill");
       }
       if(!$order['bill_id'])
       {
        $newbill=$this->MakeBill($request,$order);
         $order->bill_id = $newbill['id'];
         if($order->save())
         {
             return $newbill;
         }
           throw new \Exception("bill order update fail");
       }
       // update
      // $this->UpdateBillByOrder($request,$order);

   }

   public function UpdateBillByOrder($request,$order)
   {
       if(!$request->check_bill || is_null($order['bill_id']) || empty($order['bill_id']))
       {
           return null;
       }
       $this->UpdateItempurchase($request,$order);
       $particular = $request->bill_particular;
       $qty = $request->bill_qty?$request->bill_qty:0;
       $rate = $request->bill_rate?$request->bill_rate:0;
       $bill_date = $request->issuDate;
       $due_date = date("Y-m-d",strtotime(date('Y-m-d')."+7 days"));
       $bill_total_amount = $qty*$rate;
       $bill_due_amount = $bill_total_amount;
       $customer_id =$request->vendor_id;
       $created_by = Auth::id();




       $newBill =  Bill::find($order['bill_id']);

       $newBill->amount= $bill_total_amount;
       $newBill->due_amount= $bill_due_amount;
       $newBill->bill_date= $bill_date;
       $newBill->due_date= $due_date;
       $newBill->item_rates= 1;
       $newBill->note= ' ';
       $newBill->total_tax= 0;
       $newBill->vendor_id= $customer_id;

       $newBill->updated_by= $created_by;
       if($newBill->save())
       {
           $newBillEntry =  $newBill->OrderbillEntries;
           $newBillEntry->item_id=$particular;
           $newBillEntry->account_id=26;
           $newBillEntry->quantity=$qty;
           $newBillEntry->rate=$rate;
           $newBillEntry->tax_id=1;
           $newBillEntry->amount=$bill_total_amount;
           $newBillEntry->bill_id=$newBill->id;

           $newBillEntry->updated_by=$created_by;
           if($newBillEntry->save()){
               $this->StockUpdate($newBillEntry,$bill_date);
               return $newBill;
           }
           throw new \Exception("bill entry not saved");
       }

       throw new \Exception("bill not saved");
   }

   public function StockUpdate($billentry,$bill_date)
   {
       $created_by = Auth::id();
       if(!$billentry instanceof BillEntry)
       {
           throw new \Exception("only billentry can update stock");
       }

       if(!$billentry)
       {
           throw new \Exception("no bill entry found");
       }
       $stock = Stock::where('bill_id',$billentry['bill_id'])->first();
       if(!$stock)
       {
        return $this->StockStore($billentry,$bill_date);
       }
       $stock->total = $billentry['quantity'];
       $stock->date = date("d-m-Y",strtotime($bill_date));
       $stock->item_category_id = $billentry->item['item_category_id'];
       $stock->item_id = $billentry->item_id;
       $stock->bill_id = $billentry->bill_id;
       $stock->branch_id = session('branch_id');
       $stock->updated_by = $created_by;
       if($stock->save())
       {
           return $stock;
       }
       throw new \Exception("no bill entry found");
   }

}