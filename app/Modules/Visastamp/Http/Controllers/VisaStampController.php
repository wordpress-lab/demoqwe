<?php

namespace App\Modules\Visastamp\Http\Controllers;

use App\Lib\Helpers;
use App\Models\Contact\Contact;
use App\Models\ManualJournal\JournalEntry;
use App\Models\MoneyOut\Bill;
use App\Models\Recruit\Recruitorder;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;


class VisaStampController extends Controller
{
    public function billShow($id,$order){

        if($id==0)
        {
            return Redirect::route('visa_stamp_bill_create',['order' => $order]);
        }
        else
       {

            return Redirect::route('bill_show',$id);
        }
    }

    public function billCreate($order){

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

        return view('visastamp::bill.create', compact('customers','bill_number','order'));
    }

    public function billStore(Request $request){

       //  dd($request->order_id);

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
        ]);

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
        ]);

        $data = $request->all();
        $user_id = Auth::user()->id;

        $helper = new Helpers();
        $tax_total = $helper->calculateTotalTax($data['item_rates'],$data['tax_id'], $data['amount']);
        $total_amount = $helper->totalAmount($data['amount']);
        $total_amount = $total_amount + $tax_total;
        //return $total_amount;


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


        if($bill->save()) {
            $bill = Bill::orderBy('created_at', 'desc')->first();
            $bill_id = $bill['id'];

            if($request->order_id){
                $order= Recruitorder::find($request->order_id);

                $order->bill_id= $bill_id;
                $order->save();

            }

            $i = 0;
            $bill_entry = [];
            foreach ($data['item_id'] as $item)
            {
                $bill_entry[] = [
                    'quantity'          => $data['quantity'][$i],
                    'description'          => $data['description'][$i],
                    'rate'              => $data['rate'][$i],
                    'amount'            => $data['amount'][$i],
                    'item_id'           => $data['item_id'][$i],
                    'bill_id'           => $bill_id,
                    'tax_id'            => $data['tax_id'][$i],
                    'account_id'        => $data['account_id'][$i],
                    'created_by'        => $user_id,
                    'updated_by'        => $user_id,
                    'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                ];
                $i++;
            }

            if (DB::table('bill_entry')->insert($bill_entry))
            {
                $status = $this->insertBillInJournalEntries($data, $total_amount, $tax_total, $bill_id);
                if($status)
                {
                    $status2 = $helper->updateItemAfterCreatingBill($data,$bill_id,$user_id);
                    if($status2)
                    {
                        return redirect()
                            ->route('visastamp')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Bill added successfully!');
                    }
                    else
                    {
                        $bill = Bill::find($bill_id);
                        $bill->delete();
                        return redirect()
                            ->route('visastamp')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Something went to wrong! Please check your input field');
                    }
                }

            }
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
}
