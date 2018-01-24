<?php
namespace App\Modules\Visastamp\Http\Response;
use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\BillEntry;
use App\Models\Recruit\Recruitorder;
use App\Models\Recruit_Customer\Recruit_customer;
use App\Models\Visa\Visa;
use Illuminate\Support\Facades\Auth;

/**
 * Created by Shanto.
 * User: ontik
 * Date: 10/30/2017
 * Time: 10:59 AM
 */
class VisaStampClass
{

    public function customerId($visaentry,$recruit_customer,$pax_id,$customer_id)
    {

     if(!$visaentry)
     {
         return $customer_id;
     }

     if(!$recruit_customer)
     {
         return $customer_id;
     }



     if($recruit_customer->gender=="female")
     {
         return $visaentry->local_Reference;
     }

     return $customer_id;
    }
    public function vendorId($visaentry,$recruit_customer,$customer_id)
    {

        if(!$visaentry)
        {
            return $customer_id;
        }

        if(!$recruit_customer)
        {
            return $customer_id;
        }
        if($recruit_customer->gender=="male")
        {
            return $visaentry->local_Reference;
        }

        return $customer_id;
    }
    public function invoiceBillCreate($request,$pax_id){

        $recruit=Recruitorder::where('id',$pax_id)->first();
        $invoices = Invoice::count();
        $bill=Bill::count(); //Disabled for Female
        $VisaEntry=Visa::where('id',$recruit->registerSerial_id)->first();
        $recruit_customer = Recruit_customer::where("pax_id",$pax_id)->first();

            if($invoices>0)
            {
                $invoice = Invoice::all()->last()->invoice_number;
                $invoice_number = $invoice + 1;
            }
            else
            {
                $invoice_number = 1;
            }
            $invoice_number = str_pad($invoice_number, 6, '0', STR_PAD_LEFT);

            //Bill number ,Disabled for Female
          if($recruit_customer->gender != 'female')
          {
            if($bill>0)
            {
                $bill = Bill::all()->last()->bill_number;
                $bill_number = $bill + 1;
            }
            else
            {
                $bill_number = 1;
            }
            $bill_number = str_pad($bill_number, 6, '0', STR_PAD_LEFT);
           }
            ////Disabled for Female Ends

            $payment_date=date('d-m-Y',strtotime($request->return_date.'+7 days'));

            if($recruit->salesRate != 0 || $recruit->salesRate != Null){
                $invoice=new Invoice();
                $invoice->invoice_number            =$invoice_number;
                $invoice->invoice_date              =date('d-m-Y',strtotime($request->return_date));
                $invoice->payment_date              =$payment_date;
                $invoice->total_amount              =$recruit->salesRate?$recruit->salesRate:0;
                $invoice->due_amount                =$recruit->salesRate?$recruit->salesRate:0;
                $invoice->customer_id               =$this->customerId($VisaEntry,$recruit_customer,$pax_id,$recruit->customer_id);
                $invoice->tax_total                 =0;
                $invoice->shipping_charge           =0;
                $invoice->adjustment                =0;

                if(!empty($recruit->commission_type) && $recruit->agent_commission_amount >0)
                {
                    $invoice->agents_id                 =$recruit->customer_id;
                    $invoice->agentcommissionAmount     =$recruit->agent_commission_amount;
                    $invoice->commission_type           =$recruit->commission_type;
                }

                $invoice->created_by                =Auth::user()->id;
                $invoice->updated_by                =Auth::user()->id;
                $invoice->save();

                if ($invoice)
                {
                    $recruit=Recruitorder::where('id',$pax_id)->first();
                    $recruit->invoice_id=$invoice->id;
                    $recruit->save();
                }

                if ($invoice)
                {
                   $recruit=Recruitorder::where('id',$pax_id)->first();
                   $item=Item::where('company_id',$VisaEntry->company_id)->first();

                    $invoice_entries=new InvoiceEntry();
                    $invoice_entries->quantity=1;
                    $invoice_entries->amount=$invoice->total_amount;
                    $invoice_entries->rate=$recruit->salesRate?$recruit->salesRate:0;
                    $invoice_entries->item_id=$item->id;
                    $invoice_entries->invoice_id=$invoice->id;
                    $invoice_entries->tax_id=1;
                    $invoice_entries->account_id=16;
                    $invoice_entries->created_by=Auth::user()->id;
                    $invoice_entries->updated_by=Auth::user()->id;
                    $invoice_entries->save();

                    if ($invoice_entries){
                        $recruit=Recruitorder::where('id',$pax_id)->first();
                        $VisaEntry=Visa::where('id',$recruit->registerSerial_id)->first();
                        $item=Item::where('company_id',$VisaEntry->company_id)->first();
                        $item->total_sales+=1;
                        $item->save();
                    }

                    if ($invoice_entries){

                        $journal_Entry=new JournalEntry();
                        $journal_Entry->debit_credit=0;
                        $journal_Entry->amount=$invoice->total_amount;
                        $journal_Entry->account_name_id=16;
                        $journal_Entry->jurnal_type='invoice';
                        $journal_Entry->invoice_id=$invoice->id;
                        $journal_Entry->contact_id=$invoice->customer_id;
                        $journal_Entry->assign_date=date('Y-m-d 00:00:00',strtotime($invoice->invoice_date));
                        $journal_Entry->created_by=Auth::user()->id;
                        $journal_Entry->updated_by=Auth::user()->id;
                        $journal_Entry->save();

                        $journal_Entry=new JournalEntry();
                        $journal_Entry->debit_credit=1;
                        $journal_Entry->amount=$invoice->total_amount;
                        $journal_Entry->account_name_id=5;
                        $journal_Entry->jurnal_type='invoice';
                        $journal_Entry->invoice_id=$invoice->id;
                        $journal_Entry->contact_id=$invoice->customer_id;
                        $journal_Entry->assign_date=date('Y-m-d 00:00:00',strtotime($invoice->invoice_date));
                        $journal_Entry->created_by=Auth::user()->id;
                        $journal_Entry->updated_by=Auth::user()->id;
                        $journal_Entry->save();

                        // new journal add for sales commission
                        if(!empty($recruit->commission_type) && $recruit->agent_commission_amount >0)
                        {
                            $journal_Entry=new JournalEntry();
                            $journal_Entry->debit_credit=0;
                            if($recruit->commission_type==1)
                            {
                                $agent_commission_amount = $recruit->agent_commission_amount;
                                $journal_Entry->amount=($invoice->total_amount-$invoice->shipping_charge-$invoice->tax_total)*$agent_commission_amount/100;
                            }
                            else
                            {
                                $journal_Entry->amount=$recruit->agent_commission_amount;
                            }
                            $journal_Entry->account_name_id=11;
                            $journal_Entry->jurnal_type='sales_commission';
                            $journal_Entry->invoice_id=$invoice->id;
                            $journal_Entry->contact_id=$invoice->customer_id;
                            $journal_Entry->assign_date=date('Y-m-d 00:00:00',strtotime($invoice->invoice_date));
                            $journal_Entry->created_by=Auth::user()->id;
                            $journal_Entry->updated_by=Auth::user()->id;
                            $journal_Entry->agent_id=$invoice->customer_id;
                            $journal_Entry->save();

                            $journal_Entry=new JournalEntry();

                            $journal_Entry->debit_credit=1;
                            if($recruit->commission_type==1)
                            {
                                $agent_commission_amount = $recruit->agent_commission_amount;
                                $journal_Entry->amount=($invoice->total_amount-$invoice->shipping_charge-$invoice->tax_total)*$agent_commission_amount/100;
                            }
                            else
                            {
                                $journal_Entry->amount=$recruit->agent_commission_amount;
                            }
                            $journal_Entry->account_name_id=30;
                            $journal_Entry->jurnal_type='sales_commission';
                            $journal_Entry->invoice_id=$invoice->id;
                            $journal_Entry->contact_id=$invoice->customer_id;
                            $journal_Entry->assign_date=date('Y-m-d 00:00:00',strtotime($invoice->invoice_date));
                            $journal_Entry->created_by=Auth::user()->id;
                            $journal_Entry->updated_by=Auth::user()->id;
                            $journal_Entry->agent_id=$invoice->customer_id;
                            $journal_Entry->save();
                        }

                    }
                }
            }

            $VisaEntry=Visa::where('id',$recruit->registerSerial_id)->first();

            //Disabled for Female
            if($recruit_customer->gender != 'female' && ($VisaEntry->purchaseRate != 0 || $VisaEntry->purchaseRate != Null)){
                $bill=new Bill();
                $bill->bill_number=$bill_number;
                $bill->amount=$VisaEntry->purchaseRate?$VisaEntry->purchaseRate:0;
                $bill->due_amount=$bill->amount;
                $bill->bill_date=date('Y-m-d',strtotime($request->return_date));
                $bill->due_date=$payment_date;
                $bill->item_rates=1;
                $bill->note="";
                $bill->total_tax=0;
                $bill->vendor_id=$this->vendorId($VisaEntry,$recruit_customer,$recruit->customer_id);
                $bill->created_by=Auth::user()->id;
                $bill->updated_by=Auth::user()->id;
                $bill->save();

                if ($bill){
                    $recruit=Recruitorder::where('id',$pax_id)->first();
                    $recruit->bill_id=$bill->id;
                    $recruit->save();
                }

                if ($bill) {

                    $recruit = Recruitorder::where('id', $pax_id)->first();
                    $VisaEntry = Visa::where('id', $recruit->registerSerial_id)->first();
                    $item = Item::where('company_id', $VisaEntry->company_id)->first();

                    $bill_entries = new BillEntry();
                    $bill_entries->item_id = $item->id;
                    $bill_entries->account_id = 26;
                    $bill_entries->quantity = 1;
                    $bill_entries->rate = $VisaEntry->purchaseRate?$VisaEntry->purchaseRate:0;
                    $bill_entries->tax_id = 1;
                    $bill_entries->amount = $bill->amount;
                    $bill_entries->bill_id = $bill->id;
                    $bill_entries->created_by = Auth::user()->id;
                    $bill_entries->updated_by = Auth::user()->id;
                    $bill_entries->save();

                    if ($bill_entries){
                        $recruit=Recruitorder::where('id',$pax_id)->first();
                        $VisaEntry=Visa::where('id',$recruit->registerSerial_id)->first();
                        $item=Item::where('company_id',$VisaEntry->company_id)->first();
                        $item->total_purchases+=1;
                        $item->save();
                    }

                    if ($bill_entries){

                        $journal_Entry=new JournalEntry();
                        $journal_Entry->debit_credit=0;
                        $journal_Entry->amount=$bill->amount;
                        $journal_Entry->account_name_id=11;
                        $journal_Entry->jurnal_type='bill';
                        $journal_Entry->bill_id=$bill->id;
                        $journal_Entry->contact_id=$bill->vendor_id;
                        $journal_Entry->assign_date=date('Y-m-d 00:00:00',strtotime($bill->bill_date));
                        $journal_Entry->created_by=Auth::user()->id;
                        $journal_Entry->updated_by=Auth::user()->id;
                        $journal_Entry->save();

                        $journal_Entry=new JournalEntry();
                        $journal_Entry->debit_credit=1;
                        $journal_Entry->amount=$bill->amount;
                        $journal_Entry->account_name_id=26;
                        $journal_Entry->jurnal_type='bill';
                        $journal_Entry->bill_id=$bill->id;
                        $journal_Entry->contact_id=$bill->vendor_id;
                        $journal_Entry->assign_date=date('Y-m-d 00:00:00',strtotime($bill->bill_date));
                        $journal_Entry->created_by=Auth::user()->id;
                        $journal_Entry->updated_by=Auth::user()->id;
                        $journal_Entry->save();

                    }

                    if ($bill_entries && $bill){

                        $stock=new Stock();
                        $stock->total=$bill_entries->quantity;
                        $stock->date=$bill->bill_date;
                        $stock->item_category_id=$item->item_category_id;
                        $stock->item_id=$item->id;
                        $stock->bill_id=$bill->id;
                        $stock->branch_id=session('branch_id');
                        $stock->created_by=Auth::user()->id;
                        $stock->updated_by=Auth::user()->id;
                        $stock->save();
                    }
                }

            }

            //Disabled for Female Ends

        }
    

}