<?php

namespace App\Modules\Flightnew\Http\Controllers;

use App\Lib\sortBydate;
use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use Dompdf\Exception;
use Illuminate\Support\Facades\App;
use Validator;
use App\Models\Visa\Ticket\Order\Order;
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
use App\Models\Flightnew\Confirmation;
use App\Models\Flightnew\Submission;

class BillWebController extends Controller
{
    public function index()
    {
        //
    }
    public function search(Request $request)
    {
        //
    }
    public function create($id)
    {
        $submission = Submission::where('pax_id' , $id)->first();
        if(($submission == Null) || ($submission->owner_approval == 0)){
            return back()->with(['alert.message' => 'Can\'t create because of the submission module owner approval not set' , 'alert.status' => 'danger']);
        }
       // $customers = Contact::whereIn('contact_category_id',[3,4])->get();
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

        return view('flightnew::bill.create', compact('customers','bill_number','id'));
    }

    public function store(Request $request,$id)
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
        if($request->hasFile('file1'))
        {
            $file = $request->file('file1');
            $file_name = $file->getClientOriginalName();
            $without_extention = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention = $file->getClientOriginalExtension();
            $num = rand(1,500);
            $new_file_name = $without_extention.$request->bill_number.'.'.$file_extention;
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
        $bill->bill_date        = date("Y-m-d", strtotime($data['bill_date']));
        $bill->due_date         = date("Y-m-d", strtotime($data['due_date']));
        $bill->item_rates       = $data['item_rates'];
        $bill->note             = $data['customer_note'];
        $bill->total_tax        = $tax_total;
        $bill->vendor_id        = $data['customer_id'];
        $bill->created_by       = $user_id;
        $bill->updated_by       = $user_id;

        if($bill->save())
        {
            $confirmation = Confirmation::where('pax_id' , $id)->first();
            $confirmation->bill_id = $bill->id;
            $confirmation->update();

            $bill = Bill::orderBy('created_at', 'desc')->first();
            $bill_id = $bill['id'];

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

            if(DB::table('bill_entry')->insert($bill_entry))
            {
                if(isset($data['submit']))
                {


                    $status = $this->insertBillInJournalEntries($data, $total_amount, $tax_total, $bill_id);
                    if ($status) {

                        $status2 = $helper->updateItemAfterCreatingBill($data, $bill_id, $user_id);
                        if ($status2) {
                            return redirect()
                                ->route('confirmation')
                                ->with('alert.status', 'success')
                                ->with('alert.message', 'Bill added successfully!');
                        } else {
                            $bill = Bill::find($bill_id);
                            $bill->delete();
                            return redirect()
                                ->route('confirmation')
                                ->with('alert.status', 'danger')
                                ->with('alert.message', 'Something went to wrong! Please check your input field');
                        }
                    } else {
                        $bill = Bill::find($bill_id);
                        $bill->delete();
                        return redirect()
                            ->route('confirmation')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Something went to wrong! Please check your input field');
                    }
                }
                else
                {
                    return redirect()
                        ->route('confirmation')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Bill has been save');
                }
            }
        }
    }

    public function show($id)
    {
        //dd($id);
        $bill = Bill::find($id);
        $bills = Bill::all()->toArray();
        $date="bill_date";
        $sort= new sortBydate();
        $bills= $sort->get('\App\Models\MoneyOut\Bill',$date,'Y-m-d',$bills);
        $bill_entries = BillEntry::where('bill_id',$id)->get();
        $payment_made_entries = PaymentMadeEntry::where('bill_id', $id)->get();
        $OrganizationProfile = OrganizationProfile::find(1);

        $sub_total = 0;
        foreach ($bill_entries as $bill_entry)
        {
            $sub_total = $sub_total + $bill_entry->amount;
        }
        
        return view('flightnew::bill.show', compact('OrganizationProfile','bill', 'bills', 'bill_entries','sub_total', 'payment_made_entries'));
    }
    public function showupload(Request $request,$id=null){
        $bill = Bill::find($id);
        $validator = Validator::make($request->all(), [
            'file1' => 'required|max:10240',

        ]);


        if($validator->fails()){
            return response("file size not allowed ");
        }
        if($request->hasFile('file1')) {
            $file = $request->file('file1');

            if ($bill->file_url) {
                $delete_path = public_path($bill->file_url);
                if(file_exists($delete_path)){
                    $delete = unlink($delete_path);
                }

            }

            $file_name = $file->getClientOriginalName();
            $without_extention = substr($bill, 0, strrpos($file_name, "."));
            $file_extention = $file->getClientOriginalExtension();
            $num = rand(1, 500);
            $new_file_name = "bill-".$bill->bill_number.'.'.$file_extention;

            $success = $file->move('uploads/bill', $new_file_name);

            if ($success) {
                $bill->file_url = 'uploads/bill/' . $new_file_name;
                //$Bank->file_name = $new_file_name;

                $bill->save();
                return response("success");
            }else{
                return response("success");
            }
        }else{
            return response("file not found");
        }

    }
    public function edit($id)
    {
       // $customers = Contact::whereIn('contact_category_id',[3,4])->get();
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
            if(isset($data['submit']))
            {
                $helper->updateItemAfterUpdatingBill($data, $user_id);
            }
            $tax_total = $helper->calculateTotalTax($data['item_rates'],$data['tax_id'], $data['amount']);
            $total_amount = $helper->totalAmount($data['amount']);
            $total_amount = $total_amount + $tax_total;
            $bill = Bill::find($id);
            if($request->hasFile('file1'))
            {
                $file = $request->file('file1');
                if($bill->file_url)
                {
                    $delete_path = public_path($bill->file_url);
                    if(file_exists($delete_path))
                    {
                        $delete = unlink($delete_path);
                    }

                }

                $file_name = $file->getClientOriginalName();
                $without_extention = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention = $file->getClientOriginalExtension();
                $num = rand(1,500);
                $new_file_name = $without_extention.$request->bill_number.'.'.$file_extention;

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
            $bill->bill_date        = date("Y-m-d", strtotime($data['bill_date']));
            $bill->due_date         = date("Y-m-d", strtotime($data['due_date']));
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
                        'created_by'        => $user_id,
                        'updated_by'        => $user_id,
                        'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    ];
                    $i++;
                }

                if (DB::table('bill_entry')->insert($bill_entry_update))
                {
                    if(isset($data['submit'])){


                        $this->updateBillInJournalEntries($data, $total_amount, $tax_total, $id);
                    }

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
    public function markupdate($id)
    {
        DB::beginTransaction();
        $branch_id = session('branch_id');
        try{
            $bill = Bill::find($id);
            $bill->save = null;
            $bill->save();
            $datas= $bill->billEntries->toArray();
            $user_id = Auth::user()->id;
            $i = 0;
            $account_array = array_fill(1, 100, 0);
            foreach($datas as $data)
            {
                $amount = $data['quantity']*$data['rate'];
                $account_array[$data['account_id']] =  $account_array[$data['account_id']] + $amount;
                $i++;
            }
            //insert total amount as debit
            $journal_entry = new JournalEntry;
            $journal_entry->note            = $bill->note;
            $journal_entry->debit_credit    = 0;
            $journal_entry->amount          = $bill->amount;
            $journal_entry->account_name_id = 11;
            $journal_entry->jurnal_type     = "bill";
            $journal_entry->bill_id         =$id;
            $journal_entry->contact_id      = $bill->vendor_id;
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($bill->bill_date));
            if($journal_entry->save())
            {
                     if($bill->total_tax>0)
                     {
                         $journal_entry = new JournalEntry;
                         $journal_entry->note            = $bill->note;
                         $journal_entry->debit_credit    = 1;
                         $journal_entry->amount          = $bill->total_tax;
                         $journal_entry->account_name_id = 9;
                         $journal_entry->jurnal_type     = "bill";
                         $journal_entry->bill_id         = $bill->id;
                         $journal_entry->contact_id      = $bill->vendor_id;
                         $journal_entry->created_by      = $user_id;
                         $journal_entry->updated_by      = $user_id;
                         $journal_entry->assign_date      = date('Y-m-d',strtotime($bill->bill_date));
                         $journal_entry->save();

                     }

                     $bill_entry = [];
                     for($j = 1; $j<count($account_array)-2; $j++)
                     {
                         if ($account_array[$j] != 0)
                         {
                             $bill_entry[] = [
                                 'note'              => $bill->note,
                                 'debit_credit'      => 1,
                                 'amount'            => $account_array[$j],
                                 'account_name_id'   => $j,
                                 'jurnal_type'       => 'bill',
                                 'bill_id'           => $bill->id,
                                 'contact_id'        => $bill->vendor_id,
                                 'created_by'        => $user_id,
                                 'updated_by'        => $user_id,
                                 'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                                 'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                                 'assign_date'      => date('Y-m-d',strtotime($bill->bill_date)),
                             ];

                         }
                     }
                 }
                 else
                 {
                     throw new \Exception();
                 }


          if(DB::table('journal_entries')->insert($bill_entry))
            {


                foreach ($datas as $item)
                {
                    $items = Item::find($item['item_id']);
                    $items->total_purchases += $item['quantity'];
                    $items->save();


                }

                foreach ($datas as $item)
                {
                    $stock = new Stock;
                    $stock->total = $item['quantity'];
                    $stock->date =  $bill->bill_date;
                    $stock->item_category_id = Item::find($item['item_id'])->itemCategory->id;
                    $stock->item_id = $item['item_id'];
                    $stock->bill_id = $bill->id;
                    $stock->branch_id = $branch_id;
                    $stock->created_by = $user_id;
                    $stock->updated_by = $user_id;
                    $stock->save();

                }
                DB::commit();
                return back()
                           ->with('alert.status', 'success')
                                  ->with('alert.message', 'Journal added.');
            }
            else
            {
                throw new \Exception('Unable');
            }

        }
        catch(\Exception $exception)
        {
            DB::rollBack();
            return back()
                       ->with('alert.status', 'danger')
                             ->with('alert.message', 'Transaction fail');
        }


    }
    public function destroy($id)
    {
        $helper = new \App\Lib\Helpers;
        $helper->itemBackAfterDeletingBill($id);

        //check payment made is used in this bill or not
        if($helper->isPaymentMadeInThisBill($id))
        {
            return redirect()
                ->route('bill')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Payment made used in this bill. First You have to delete payment made from this bill.');
        }

        $payment_amount = DB::table('payment_made_entry')
            ->where('bill_id', $id)
            ->groupBy('payment_made_id')
            ->selectRaw('sum(amount) as amount, payment_made_id')
            ->get();

        foreach ($payment_amount as $value)
        {
            $helper->paymentMadeBackAfterDeleteBill($value->payment_made_id, $value->amount);
        }

        $bill = Bill::find($id);
        if($bill)
        {
            if(Order::where('bill_id',$bill->id)->first()){
                $order=Order::where('bill_id',$bill->id)->first();
                $order->bill_id=null;
                $order->save();
            }

            if(Visa::where('bill_id',$bill->id)->first()){
                $visa=Visa::where('bill_id',$bill->id)->first();
                $visa->bill_id=null;
                $visa->save();
            }

            if($bill->delete())
            {
                if ($bill->file_url) {
                    $delete_path = public_path($bill->file_url);
                    if(file_exists($delete_path))
                    {
                        $delete = unlink($delete_path);
                    }

                }
            }

            return redirect()
                ->route('bill')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Bill deleted successfully!!!');
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
        $journal_entry->account_name_id = 11;
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

        if($bill_entries_delete->delete())
        {

        }

        $user_id = Auth::user()->id;
        $i = 0;
        $account_array = array_fill(1, 100, 0);
        foreach($data['item_id'] as $account)
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
        $journal_entry->account_name_id = 11;
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


        $i = 0;
        foreach ($data['excess_payment_amount'] as $excess_payment_amount)
        {
            if($excess_payment_amount)
            {
                $helper->addOrUpdateJournalEntryAfterUsingExcessAmountInBill($data['bill_id'], $data['payment_made_id'][$i], $excess_payment_amount, $user_id);
            }
            $i++;
        }

        return redirect()
            ->route('bill_show', ['id' => $data['bill_id']])
            ->with('alert.status', 'success')
            ->with('alert.message', 'Excess notes used successfully!');
    }
}
