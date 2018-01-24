<?php

namespace App\Modules\Manpowerservice\Http\Controllers;

use App\Lib\Helpers;
use App\Models\Contact\Contact;
use App\Models\Manpower\Manpower_service;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\Invoice;
use App\Models\MoneyOut\Bill;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class ManpowerServiceBillInvoiceController extends Controller
{
    public function billShow($id,$progress){

        if($id==0)
        {
            return Redirect::route('manpower_service_bill_create',['order' => $progress]);
        }else {

            return Redirect::route('bill_show',$id);
        }
    }

    public function billCreate($progress=null){


        $progress = $progress;

        $customers = Contact::all();
        $bills = Bill::all();

        if(count($bills)>0)
        {
            $bill = Bill::all()->last()->bill_number;
            $bill_number = $bill + 1;
        }
        else
        {
            $bill_number = 1;
        }
        $bill_number = str_pad($bill_number, 6, '0', STR_PAD_LEFT);
        return view('manpowerservice::manpower_bill.create', compact('customers','bill_number','progress'));
    }

    public function billStore(Request $request){



        $this->validate($request, [
            'customer_id'    => 'required',
            'bill_number'    => 'required',
            'bill_date'      => 'required',
            'due_date'       => 'required',
            'item_id.*'      => 'required',
            'quantity.*'     => 'required',
            'rate.*'         => 'required',
            'tax_id.*'       => 'required',
            'amount.*'       => 'required',
            'account_id'     => 'required',
            'ticket_id'     => 'required',
        ]);


        $data = $request->all();

        $user_id = Auth::user()->id;

        $helper = new Helpers();
        $tax_total = $helper->calculateTotalTax($data['item_rates'],$data['tax_id'], $data['amount']);
        $total_amount = $helper->totalAmount($data['amount']);
        $total_amount = $total_amount + $tax_total;

        try{
            DB::beginTransaction();
            $bill = new Bill;
            if($request->hasFile('file'))
            {
                $file = $request->file('file');
                $file_name = $file->getClientOriginalName();
                $without_extention = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention = $file->getClientOriginalExtension();
                $num = rand(1,500);
                $new_file_name = $without_extention.$num.'.'.$file_extention;
                $success = $file->move('uploads/bill',$new_file_name);
                if($success)
                {
                    $bill->file_url = 'uploads/bill/'.$new_file_name;
                    $bill->file_name = $new_file_name;
                }
            }
            if(isset($data['save']))
            {
                $bill->save = 1;
            }
            $bill->order_number     = $data['order_number'];
            $bill->bill_number      = $data['bill_number'];
            $bill->amount           = $total_amount;
            $bill->due_amount       = $total_amount;
            $bill->bill_date        = $data['bill_date'];
            $bill->due_date         = $data['due_date'];
            $bill->item_rates       = $data['item_rates'];
            $bill->note             = $data['customer_note'];
            $bill->total_tax        = $tax_total;
            $bill->vendor_id        = $data['customer_id'];
            $bill->created_by       = $user_id;
            $bill->updated_by       = $user_id;

            if($bill->save())
            {


                $bill = Bill::orderBy('created_at', 'desc')->first();
                $bill_id = $bill['id'];

                if($request->ticket_id)
                {
                    $order= Manpower_service::find($request->ticket_id);
                    $order->bill_id= $bill_id;
                    $order->save();
                }

                $i = 0;
                $bill_entry = [];
                foreach ($data['item_id'] as $item)
                {
                    $bill_entry[] = [
                        'quantity'          => $data['quantity'][$i],
                        'rate'              => $data['rate'][$i],
                        'amount'            => $data['amount'][$i],
                        'item_id'           => $data['item_id'][$i],
                        'bill_id'           => $bill_id,
                        'tax_id'            => $data['tax_id'][$i],
                        'description'       => $data['description'][$i],
                        'account_id'        => $data['account_id'][$i],
                        'created_by'        => $user_id,
                        'updated_by'        => $user_id,
                        'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    ];
                    $i++;
                }

                if(DB::table('bill_entry')->insert($bill_entry))
                {
                    if(isset($data['submit']))
                    {
                        $status = $this->insertBillInJournalEntries($data, $total_amount, $tax_total, $bill_id);
                        if ($status) {
                            $status2 = $helper->updateItemAfterCreatingBill($data, $bill_id, $user_id);
                            if ($status2) {
                                DB::commit();
                                return redirect()
                                    ->route('manpower_service_confirmed')
                                    ->with('alert.status', 'success')
                                    ->with('alert.message', 'Bill added successfully!');
                            } else {
                                DB::rollBack();
                                throw new \Exception();
                            }
                        }
                    }
                    else
                    {
                        DB::commit();
                        return redirect()
                            ->route('manpower_service_confirmed')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Bill added successfully!');
                    }

                }
            }


            throw new \Exception();
        }catch (\Exception $exception){

            DB::rollBack();

            return redirect()
                ->route('manpower_service_confirmed')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went to wrong! Please check your input field');
        }




    }

    public function insertBillInJournalEntries($data, $total_amount, $total_tax, $bill_id)
    {
        $user_id = Auth::user()->id;
        $i = 0;
        $account_array = array_fill(1, 100, 0);
        foreach ($data['item_id'] as $item_id)
        {
            $amount = $data['quantity'][$i]*$data['rate'][$i];
            $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + $amount;
            $i++;
        }

        $journal_entry = new JournalEntry;
        $journal_entry->note            = $data['customer_note'];
        $journal_entry->debit_credit    = 0;
        $journal_entry->amount          = $total_amount;
        $journal_entry->account_name_id = 26;
        $journal_entry->jurnal_type     = "bill";
        $journal_entry->bill_id         = $bill_id;
        $journal_entry->contact_id      = $data['customer_id'];
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;
        $journal_entry->assign_date      = date('Y-m-d',strtotime($data['bill_date']));
        if($journal_entry->save())
        {

        }
        else
        {
            //delete all journal entry for this invoice...
            $bill = Bill::find($bill_id);
            $bill->delete();
            return false;
        }

        if($total_tax>0)
        {
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->debit_credit    = 1;
            $journal_entry->amount          = $total_tax;
            $journal_entry->account_name_id = 9;
            $journal_entry->jurnal_type     = "bill";
            $journal_entry->bill_id         = $bill_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['bill_date']));
            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $bill = Bill::find($bill_id);
                $bill->delete();
                return false;
            }
        }

        $bill_entry = [];
        for($j = 1; $j<count($account_array)-2; $j++) {
            if ($account_array[$j] != 0)
            {
                $bill_entry[] = [
                    'note'              => $data['customer_note'],
                    'debit_credit'      => 1,
                    'amount'            => $account_array[$j],
                    'account_name_id'   => $j,
                    'jurnal_type'       => 'bill',
                    'bill_id'           => $bill_id,
                    'contact_id'        => $data['customer_id'],
                    'created_by'        => $user_id,
                    'updated_by'        => $user_id,
                    'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'assign_date'      => date('Y-m-d',strtotime($data['bill_date'])),
                ];

            }
        }

        if (DB::table('journal_entries')->insert($bill_entry))
        {
            return true;
        }
        else
        {
            //delete all journal entry for this invoice...
            $bill = Bill::find($bill_id);
            $bill->delete();
            return false;
        }

        return false;
    }


    public function invoiceShow($id,$progress){

        $manpower  = Manpower_service::find($progress);
        if($manpower->count())
        {
           if(!$manpower->bill_id && $id==0)
           {
              return back()->with('del',"Please create bill first");
           }
        }

        if($id==0)
        {
            return Redirect::route('manpower_service_invoice_create',['order' => $progress]);
        }else {

            return Redirect::route('invoice_show',$id);
        }
    }



    public function invoiceCreate($progress=null){
        $progress = $progress;

        $customers = Contact::all();
        $invoices = Invoice::all();
        if(count($invoices)>0)
        {
            $invoice = Invoice::all()->last()->id;
            $invoice_number = $invoice + 1;
        }
        else
        {
            $invoice_number = 1;
        }

        $invoice_number = str_pad($invoice_number, 6, '0', STR_PAD_LEFT);
        return view('manpowerservice::manpower_bill.createInvoice', compact('customers','invoice_number','progress'));
    }

    public function invoiceStore(Request $request){


        $this->validate($request, [
            'customer_id'    => 'required',
            'invoice_number' => 'required',
            'invoice_date'   => 'required',
            'due_date'       => 'required',
            'item_id.*'      => 'required',
            'quantity.*'     => 'required',
            'rate.*'         => 'required',
            'tax_id.*'       => 'required',
            'amount.*'       => 'required',
            'account_id'     => 'required',
        ]);

        try
        {
            $data = $request->all();


            $user_id = Auth::user()->id;
            $helper = new \App\Lib\Helpers;

            $status1 = $helper->checkItemQuantity($data);
            if(!$status1)
            {
                return redirect()
                    ->route('invoice')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Quantity is not available for item Item_name. Only Item_quantity is available!!!');
            }

            $invoice = new Invoice;

            if($request->hasFile('file'))
            {
                $file = $request->file('file');
                $file_name = $file->getClientOriginalName();
                $without_extention = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention = $file->getClientOriginalExtension();
                $num = rand(1,500);
                $new_file_name = $without_extention.$num.'.'.$file_extention;
                $success = $file->move('uploads/invoice',$new_file_name);

                if($success)
                {
                    $invoice->file_url = 'uploads/invoice/'.$new_file_name;
                    $invoice->file_name = $new_file_name;
                }
            }

            $invoice->invoice_number    = $data['invoice_number'];
            $invoice->invoice_date      = date("d-m-Y",strtotime($data['invoice_date']));
            $invoice->payment_date      = date("d-m-Y",strtotime($data['due_date']));
            $invoice->customer_note     = $data['customer_note'];
            $invoice->tax_total         = $data['tax_total'];
            $invoice->shipping_charge   = $data['shipping_charge'];
            $invoice->adjustment        = $data['adjustment'];
            $invoice->total_amount      = $data['total_amount'];
            $invoice->customer_id       = $data['customer_id'];
            $invoice->created_by        = $user_id;
            $invoice->updated_by        = $user_id;
            if($data['submit'] == 'save'){
             $invoice->save    = 1;
            }else{
                $invoice->save    = null;
            }

            if($invoice->save())
            {

                $invoice = Invoice::orderBy('created_at', 'desc')->first();
                $invoice_id = $invoice['id'];

                $i = 0;
                if($request->invoice_id){
                    $order= Manpower_service::find($request->invoice_id);
                    $order->invoice_id= $invoice_id;
                    $order->save();
                }

                foreach ($data['item_id'] as $account)
                {
                    if(!$data['discount'][$i])
                    {
                        $invoice_entry[] = [
                            'quantity'          => $data['quantity'][$i],
                            'rate'              => $data['rate'][$i],
                            'amount'            => $data['amount'][$i],
                            'discount'          => 0,
                            'item_id'           => $data['item_id'][$i],
                            'invoice_id'        => $invoice_id,
                            'tax_id'            => $data['tax_id'][$i],
                            'account_id'        => $data['account_id'][$i],
                            'created_by'        => $user_id,
                            'updated_by'        => $user_id,
                            'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        ];
                    }
                    else
                    {
                        $invoice_entry[] = [
                            'quantity'          => $data['quantity'][$i],
                            'rate'              => $data['rate'][$i],
                            'amount'            => $data['amount'][$i],
                            'discount'          => $data['discount'][$i],
                            'item_id'           => $data['item_id'][$i],
                            'invoice_id'        => $invoice_id,
                            'tax_id'            => $data['tax_id'][$i],
                            'account_id'        => $data['account_id'][$i],
                            'created_by'        => $user_id,
                            'updated_by'        => $user_id,
                            'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                            'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        ];
                    }

                    $i++;
                }

                if (DB::table('invoice_entries')->insert($invoice_entry))
                {
                    if($data['submit'] == 'save')
                    {
                        return redirect()
                            ->route('manpower_service_confirmed')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Invoice added successfully!');
                    }
                    $status = $this->insertManualJournalEntries($data);
                    if($status)
                    {
                        $status2 = $helper->updateItemAfterCreatingInvoice($data);
                        if($status2)
                        {
                            return redirect()
                                   ->route('manpower_service_confirmed')
                                   ->with('alert.status', 'success')
                                   ->with('alert.message', 'Invoice added successfully!');
                        }
                    }
                }
            }

            throw new \Exception();
        }
        catch (\Exception $e)
        {
            $msg= $e->getMessage();
            return redirect()
                ->route('manpower_service_confirmed')
                ->with('alert.status', 'danger')
                ->with('alert.message', "Something went to wrong! Please check your input field, $msg");
        }
    }

    public function insertManualJournalEntries($data)
    {
        $user_id = Auth::user()->id;

        $i = 0;
        $discount = 0;
        $account_array = array_fill(1, 100, 0);
        foreach ($data['item_id'] as $account)
        {
            if($data['discount'][$i] == "")
            {

            }
            else
            {
                $amount = $data['quantity'][$i]*$data['rate'][$i];
                $discount = $discount + ($data['discount'][$i]*$amount)/100;
            }

            $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + ($data['quantity'][$i]*$data['rate'][$i]);

            $i++;
        }

        $invoice = Invoice::orderBy('created_at', 'desc')->first();
        $invoice_id = $invoice['id'];

        //insert total amount as debit
        $journal_entry = new JournalEntry;
        $journal_entry->note            = $data['customer_note'];
        $journal_entry->debit_credit    = 1;
        $journal_entry->amount          = $data['total_amount'];
        $journal_entry->account_name_id = 5;
        $journal_entry->jurnal_type     = "invoice";
        $journal_entry->invoice_id      = $invoice_id;
        $journal_entry->contact_id      = $data['customer_id'];
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;
        $journal_entry->assign_date      = date('Y-m-d',strtotime($data['invoice_date']));
        if($journal_entry->save())
        {

        }
        else
        {
            //delete all journal entry for this invoice...
            $invoice = Invoice::find($invoice_id);
            $invoice->delete();
            return false;
        }

        //insert discount as credit
        if($discount>0)
        {
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->debit_credit    = 1;
            $journal_entry->amount          = $discount;
            $journal_entry->account_name_id = 21;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['invoice_date']));
            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $invoice = Invoice::find($invoice_id);
                $invoice->delete();
                return false;
            }
        }


        //insert tax total as credit
        if($data['tax_total']>0)
        {
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $data['tax_total'];
            $journal_entry->account_name_id = 9;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['invoice_date']));
            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $invoice = Invoice::find($invoice_id);
                $invoice->delete();
                return false;
            }
        }

        //insert shipping charge as credit
        if($data['shipping_charge']>0)
        {
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $data['shipping_charge'];
            $journal_entry->account_name_id = 20;
            $journal_entry->jurnal_type     = "invoice";
            $journal_entry->invoice_id      = $invoice_id;
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['invoice_date']));
            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $invoice = Invoice::find($invoice_id);
                $invoice->delete();
                return false;
            }
        }


        //insert adjustment as credit
        if($data['adjustment'] != 0)
        {
            $journal_entry = new JournalEntry;
            $journal_entry->note                = $data['customer_note'];
            if($data['adjustment']>0)
            {
                $journal_entry->debit_credit    = 0;
            }
            else
            {
                $journal_entry->debit_credit    = 1;
            }
            $journal_entry->amount              = abs($data['adjustment']);
            $journal_entry->account_name_id     = 18;
            $journal_entry->jurnal_type         = "invoice";
            $journal_entry->invoice_id          = $invoice_id;
            $journal_entry->contact_id          = $data['customer_id'];
            $journal_entry->created_by          = $user_id;
            $journal_entry->updated_by          = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['invoice_date']));
            if($journal_entry->save())
            {

            }
            else
            {
                //delete all journal entry for this invoice...
                $invoice = Invoice::find($invoice_id);
                $invoice->delete();
                return false;
            }
        }


        //return $account_array;
        $invoice_entry = [];
        for($j = 1; $j<count($account_array)-2; $j++) {
            if ($account_array[$j] != 0)
            {
                $invoice_entry[] = [
                    'note'              => $data['customer_note'],
                    'debit_credit'      => 0,
                    'amount'            => $account_array[$j],
                    'account_name_id'   => $j,
                    'jurnal_type'       => 'invoice',
                    'invoice_id'        => $invoice_id,
                    'contact_id'        => $data['customer_id'],
                    'created_by'        => $user_id,
                    'updated_by'        => $user_id,
                    'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'assign_date'      => date('Y-m-d',strtotime($data['invoice_date'])),
                ];

            }
        }

        if (DB::table('journal_entries')->insert($invoice_entry))
        {
            return true;
        }
        else
        {
            //delete all journal entry for this invoice...
            $invoice = Invoice::find($invoice_id);
            $invoice->delete();
            return false;
        }

        return false;

    }










}