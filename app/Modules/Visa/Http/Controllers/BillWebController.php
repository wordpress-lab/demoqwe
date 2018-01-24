<?php

namespace App\Modules\Visa\Http\Controllers;

use App\Models\Visa\Visa;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;
use Illuminate\Support\Facades\Auth;

use App\Models\Moneyin\Invoice;
use App\Models\Contact\Contact;
use App\Models\ManualJournal\Journal;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\ExcessPayment;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Moneyin\PaymentReceives;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\Moneyin\CreditNote;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\BillEntry;
use App\Models\MoneyOut\Expense;
use App\Models\MoneyOut\PaymentMade;
use App\Models\MoneyOut\PaymentMadeEntry;
use Illuminate\Support\Facades\Redirect;

class BillWebController extends Controller
{
    public function index()
    {
        $bills = Bill::all();
        return view('bill::bill.index', compact('bills'));
    }

    public function create($visa=null)
    {
        $visa = $visa;
        $customers = Contact::all();
        $bills = Bill::all();

        if(count($bills)>0)
        {
            $bill = Bill::orderBy('created_at', 'desc')->first();
            $bill_number = $bill['bill_number'];
            $bill_number = $bill_number + 1;
        }
        else
        {
            $bill_number = 1;
        }
        $bill_number = str_pad($bill_number, 6, '0', STR_PAD_LEFT);

        return view('visa::bill.create', compact('customers','bill_number','visa'));
    }

    public function store(Request $request)
    {


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

        $helper = new \App\Lib\Helpers;
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
        $bill->bill_date        = date("Y-m-d",strtotime($data['bill_date']));
        $bill->due_date         = date("Y-m-d",strtotime($data['due_date']));
        $bill->item_rates       = $data['item_rates'];
        $bill->note             = $data['customer_note'];
        $bill->total_tax        = $tax_total;
        $bill->vendor_id        = $data['customer_id'];
        $bill->created_by       = $user_id;
        $bill->updated_by       = $user_id;

        if($bill->save()) {
            $bill = Bill::orderBy('created_at', 'desc')->first();
            $bill_id = $bill['id'];
            if($request->visa_id){
                $visa = Visa::find($request->visa_id);
                $visa->bill_id = $bill_id;
                $visa->save();
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
                            ->route('visa')
                            ->with('alert.status', 'success')
                            ->with('alert.message', 'Bill added successfully!');
                    }
                    else
                    {
                        $bill = Bill::find($bill_id);
                        $bill->delete();
                        return redirect()
                            ->route('visa')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Something went to wrong! Please check your input field');
                    }
                }

            }
        }
    }

    public function show($id,$visa=null)
    {

        if($id==0)
        {
            return Redirect::route('visa_bill_create',['order' => $visa]);
        }
        $bill = Bill::find($id);
        $bills = Bill::all();
        $bill_entries = BillEntry::where('bill_id',$id)->get();
        $payment_made_entries = PaymentMadeEntry::where('bill_id', $id)->get();
        $OrganizationProfile = OrganizationProfile::find(1);

        $sub_total = 0;
        foreach ($bill_entries as $bill_entry)
        {
            $sub_total = $sub_total + $bill_entry->amount;
        }
        
        return view('bill::bill.show', compact('bill', 'bills', 'bill_entries','sub_total', 'payment_made_entries' , 'OrganizationProfile'));
        //return Redirect::route('bill_show',['id' => $visa]);
    }

    public function edit($id)
    {
        $customers = Contact::all();
        $bill = Bill::find($id);
        return view('bill::bill.edit', compact('customers', 'bill'));
    }

    public function update(Request $request, $id)
    {
        //return $request->all();
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

        try
        {
            $data = $request->all();
            //return $data;
            $user_id = Auth::user()->id;

            $helper = new \App\Lib\Helpers;
            $helper->updateItemAfterUpdatingBill($data);

            $tax_total = $helper->calculateTotalTax($data['item_rates'],$data['tax_id'], $data['amount']);
            $total_amount = $helper->totalAmount($data['amount']);
            $total_amount = $total_amount + $tax_total;

            $bill = Bill::find($id);

            if($request->hasFile('file'))
            {
                $file = $request->file('file');

                if($bill->file_url)
                {
                    $delete_path = public_path($bill->file_url);
                    $delete = unlink($delete_path);
                }

                $file_name = $file->getClientOriginalName();
                $without_extention = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention = $file->getClientOriginalExtension();
                $num = rand(1,500);
                $new_file_name = $without_extention.$num.'.'.$file_extention;

                $success = $file->move('uploads/bill',$new_file_name);

                if($success)
                {
                    $bill->file_url = 'uploads/invoice/'.$new_file_name;
                    $bill->file_name = $new_file_name;
                }
            }

            $bill->order_number     = $data['order_number'];
            $bill->bill_number      = $data['bill_number'];
            $bill->amount           = $total_amount;
            $bill->bill_date        = date("Y-m-d",strtotime($data['bill_date']));
            $bill->due_date         = date("Y-m-d",strtotime($data['due_date']));
            $bill->item_rates       = $data['item_rates'];
            $bill->note             = $data['customer_note'];
            $bill->total_tax        = $tax_total;
            $bill->vendor_id        = $data['customer_id'];
            $bill->created_by       = $user_id;
            $bill->updated_by       = $user_id;

            $bill_entry_update = [];
            if($bill->update())
            {
                $bill_entry = Bill::find($id)->billEntries();

                //Update Time 

                $created = Bill::find($id);

                $created_by = $created->created_by;
                $created_at = $created->created_at->toDateTimeString();
                $updated_at = \Carbon\Carbon::now()->toDateTimeString();

                if($bill_entry->delete())
                {

                }
                $i = 0;
                foreach ($data['item_id'] as $account)
                {
                    $bill_entry_update[] = [
                        'quantity'          => $data['quantity'][$i],
                        'description'          => $data['description'][$i],
                        'rate'              => $data['rate'][$i],
                        'amount'            => $data['amount'][$i],
                        'item_id'           => $data['item_id'][$i],
                        'bill_id'           => $id,
                        'tax_id'            => $data['tax_id'][$i],
                        'account_id'        => $data['account_id'][$i],
                        'created_by'        => $created_by,
                        'updated_by'        => $user_id,
                        'created_at'        => $created_at,
                        'updated_at'        => $updated_at,
                    ];
                    $i++;
                }

                if (DB::table('bill_entry')->insert($bill_entry_update))
                {
                    $this->updateBillInJournalEntries($data, $total_amount, $tax_total, $id);
                    return redirect()
                        ->route('bill_edit', ['id' => $id])
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Bill updated successfully!');
                }
            }
            return redirect()
                ->route('bill_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went to wrong! please check your input field!!!');
        }
        catch (Exception $e)
        {
            return $e->getMessage();
        }
    }

    public function destroy($id)
    {
        return "Code should be implemented";
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

    public function updateBillInJournalEntries($data, $total_amount, $total_tax, $bill_id)
    {

        $bill_entries_delete = Bill::find($bill_id)->journalEntries();

        //Update Time 

        $created = Bill::find($bill_id);

        $created_by = $created->created_by;
        $created_at = $created->created_at->toDateTimeString();
        $updated_at = \Carbon\Carbon::now()->toDateTimeString();

        if($bill_entries_delete->delete())
        {

        }

        $user_id = Auth::user()->id;
        $i = 0;
        $account_array = array_fill(1, 100, 0);
        foreach ($data['item_id'] as $account)
        {
            $amount = $data['quantity'][$i]*$data['rate'][$i];
            $account_array[$data['account_id'][$i]] =  $account_array[$data['account_id'][$i]] + $amount;
            $i++;
        }

        //insert total amount as debit
        $journal_entry = new JournalEntry;
        $journal_entry->note            = $data['customer_note'];
        $journal_entry->debit_credit    = 0;
        $journal_entry->amount          = $total_amount;
        $journal_entry->account_name_id = 26;
        $journal_entry->jurnal_type     = "bill";
        $journal_entry->bill_id         = $bill_id;
        $journal_entry->contact_id      = $data['customer_id'];
        $journal_entry->created_by      = $created_by;
        $journal_entry->updated_by      = $user_id;
        $journal_entry->created_at      = $created_at;
        $journal_entry->updated_at      = $updated_at;
        $journal_entry->assign_date     = date('Y-m-d',strtotime($data['bill_date']));
        if($journal_entry->save())
        {

        }
        else
        {
            //delete all journal entry for this invoice...
        }

        //insert tax total as debit
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
            $journal_entry->created_by      = $created_by;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->created_at      = $created_at;
            $journal_entry->updated_at      = $updated_at;
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

        //return $account_array;

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
                    'created_by'        => $created_by,
                    'updated_by'        => $user_id,
                    'created_at'        => $created_at,
                    'updated_at'        => $updated_at,
                    'assign_date'      => date('Y-m-d',strtotime($data['bill_date'])),
                ];

            }
        }

        if (DB::table('journal_entries')->insert($bill_entry))
        {
            return "successfull...";
        }
        else
        {
            //delete all journal entry for this invoice...
        }

        return "error";
    }

    public function useExcessPayment(Request $request)
    {
        $data = $request->all();
        //return $data;
        $user_id = Auth::user()->id;
        $helper = new \App\Lib\Helpers;
        $i = 0;
        foreach ($data['excess_payment_amount'] as $excess_payment_amount)
        {
            if($excess_payment_amount && $excess_payment_amount > 0)
            {
                $helper->updatePaymentMadeEntryAfterExcessAmountUse($data['bill_id'], $data['payment_made_id'][$i], $excess_payment_amount, $user_id);

                $payment_made = PaymentMade::find($data['payment_made_id'][$i]);
                $payment_made->excess_amount = ($payment_made['excess_amount'] - $excess_payment_amount);
                $payment_made->update();

                $bill = Bill::find($data['bill_id']);
                $bill->due_amount = $bill['due_amount'] - $excess_payment_amount;
                $bill->update();
            }
            $i++;
        }


//        $i = 0;
//        foreach ($data['excess_payment_amount'] as $excess_payment_amount)
//        {
//            if($excess_payment_amount)
//            {
//                $helper->addOrUpdateJournalEntry($data['invoice_id'], $data['payment_receive_id'][$i], $excess_payment_amount, $user_id);
//            }
//            $i++;
//        }

        return redirect()
            ->route('bill_show', ['id' => $data['bill_id']])
            ->with('alert.status', 'success')
            ->with('alert.message', 'Excess notes used successfully!');
    }
}
