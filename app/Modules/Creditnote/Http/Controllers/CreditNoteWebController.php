<?php

namespace App\Modules\Creditnote\Http\Controllers;

use App\Lib\sortBydate;
use App\Models\Branch\Branch;
use Validator;
use DB;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models...
use App\Models\Contact\Contact;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\CreditNoteEntry;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\Moneyin\CreditNoteRefund;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Inventory\Item;
use App\Models\Tax;
use App\Models\ManualJournal\JournalEntry;

class CreditNoteWebController extends Controller
{
    public function index()
    {
        $invoices = Invoice::all();
        $auth_id = Auth::id();
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $invoices = [];
        $condition = "YEAR(str_to_date(credit_note_date,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(credit_note_date,'%Y-%m-%d')) = MONTH(CURDATE())";
        $credit_notes= [];
        if($branch_id==1){
            $credit_notes = CreditNote::orderBy('credit_note_date','desc')->whereRaw($condition)->get()->toArray();
        }else{
            $credit_notes = CreditNote::orderBy('credit_notes.credit_note_date','desc')->select(DB::raw('credit_notes.*'))->whereRaw($condition)->join('users','users.id','=','credit_notes.created_by')->where('users.branch_id',$branch_id)->get()->toArray();
        }
        $date="credit_note_date";
        $sort= new sortBydate();
        try{
            $credit_notes= $sort->get('\App\Models\Moneyin\CreditNote',$date,'Y-m-d',$credit_notes);
            return view('creditnote::creditnote.index', compact('credit_notes', 'invoices','branchs'));
        }catch (\Exception $exception){
            return view('creditnote::creditnote.index', compact('credit_notes', 'invoices','branchs'));
        }

    }
    public function search(Request $request)
    {
        $invoices = Invoice::all();
        $auth_id = Auth::id();
        $branchs = Branch::orderBy('id','asc')->get();
        $branch_id =  $request->branch_id;
        $from_date =  date('Y-m-d',strtotime($request->from_date));
        $to_date =  date('Y-m-d',strtotime($request->to_date));
        if(session('branch_id')==1)
        {
            $branch_id =  $request->branch_id?$request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id = session('branch_id');
        }
        $condition = "str_to_date(credit_note_date, '%Y-%m-%d') between '$from_date' and '$to_date'";
        $credit_notes= [];
        if($branch_id==1){
            $credit_notes = CreditNote::orderBy('credit_note_date','desc')->select(DB::raw('credit_notes.*'))->whereRaw($condition)->get()->toArray();
        }else{
            $credit_notes = CreditNote::orderBy('credit_note_date','desc')->select(DB::raw('credit_notes.*'))->whereRaw($condition)->join('users','users.id','=','credit_notes.created_by')->where('branch_id',$branch_id)->get()->toArray();

        }
        $date="credit_note_date";
        $sort= new sortBydate();
        try{
            $credit_notes= $sort->get('\App\Models\Moneyin\CreditNote',$date,'Y-m-d',$credit_notes);
            return view('creditnote::creditnote.index', compact('credit_notes', 'invoices','branchs','branch_id','from_date','to_date'));
        }catch (\Exception $exception){

            return view('creditnote::creditnote.index', compact('credit_notes', 'invoices','branchs','branch_id','from_date','to_date'));
        }

    }
    public function create()
    {
        $customers = Contact::all();
        if(count(CreditNote::all())>0)
        {
          $credit_note_number = (CreditNote::all()->last()->id) + 1;
        }else
        {
            $credit_note_number= 1;
        }

        $credit_note_number = str_pad($credit_note_number, 6, '0', STR_PAD_LEFT);

        return view('creditnote::creditnote.create', compact('customers', 'credit_note_number'));
    }

    public function store(Request $request)
    {
        $credit_note_data = $request->all();

        $user_id = Auth::user()->id;

        $credit_note = new CreditNote;
        $credit_note->customer_id = $credit_note_data['customer_id'];
        $credit_note->credit_note_number = $credit_note_data['credit_note_number'];
        $credit_note->reference = $credit_note_data['reference'];
        $credit_note->credit_note_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
        $credit_note->shiping_charge = $credit_note_data['shipping_charge'];
        $credit_note->adjustment = $credit_note_data['adjustment'];
        $credit_note->total_credit_note = $credit_note_data['total'];
        $credit_note->available_credit = $credit_note_data['total'];
        $credit_note->customer_note = $credit_note_data['customer_note'];
        $credit_note->terms_and_condition = $credit_note_data['terms_and_condition'];
        $credit_note->created_by = $user_id;
        $credit_note->updated_by = $user_id;
            if($request->hasFile('file1'))
            {
                $file = $request->file('file1');
                if($credit_note->file_url){
                    $delete_path = public_path($credit_note->file_url);
                    if(file_exists($delete_path)){
                        $delete = unlink($delete_path);
                    }
                }
                $file_name = $file->getClientOriginalName();
                $without_extention = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention = $file->getClientOriginalExtension();
                $num = rand(1, 500);
                $new_file_name = "creditnote-".$credit_note_data['credit_note_number'].'.'.$file_extention;
                $success = $file->move('uploads/creditnote', $new_file_name);
                if($success){
                    $credit_note->file_url = 'uploads/creditnote/' . $new_file_name;
                }else{
                    $credit_note->file_url = null;
                }
            }
        if ($credit_note->save()) {
            $credit_note_entries_array = [];

            $item_id = $credit_note_data['item_id'];
            $description = $credit_note_data['description'];
            $account_id = $credit_note_data['account_id'];
            $quantity = $credit_note_data['quantity'];
            $rate = $credit_note_data['rate'];
            $discount = $credit_note_data['discount'];
            $tax_id = $credit_note_data['tax_id'];
            $amount = $credit_note_data['amount'];

            // return $account_id;

            $length = count($item_id);

            $credit_note_id = CreditNote::all()->last()->id;

            for ($i = 0; $i < $length; $i++) {
                $credit_note_entries_array[] = [
                    'item_id' => $item_id[$i],
                    'description' => $description[$i],
                    'account_id' => $account_id[$i],
                    'quantity' => $quantity[$i],
                    'rate' => $rate[$i],
                    'discount' => $discount[$i],
                    'tax_id' => $tax_id[$i],
                    'amount' => $amount[$i],
                    'credit_note_id' => $credit_note_id,
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                ];
            }

            $save = DB::table('credit_note_entries')->insert($credit_note_entries_array);

            if ($save) {
                $length = count($credit_note_data['discount']);
                $discount = $credit_note_data['discount'];
                $rate = $credit_note_data['rate'];
                $quantity = $credit_note_data['quantity'];
                $total_amount = 0;
                $total_discount = 0;

                for ($i = 0; $i < $length; $i++) {
                    $current_amount = $quantity[$i] * $rate[$i];
                    $total_amount = $total_amount + $current_amount;
                    $total_discount = $total_discount + ($discount[$i] * $rate[$i]) / 100;
                }

                $journal_entry = new JournalEntry;
                $journal_entry->amount = $credit_note_data['total'];
                $journal_entry->debit_credit = 0;
                $journal_entry->account_name_id = 5;
                $journal_entry->jurnal_type = 11;
                $journal_entry->credit_note_id = $credit_note_id;
                $journal_entry->contact_id = $credit_note_data['customer_id'];
                $journal_entry->created_by = $user_id;
                $journal_entry->updated_by = $user_id;
                $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                $journal_entry->save();

                if($credit_note_data['tax_total']>0)
                {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = $credit_note_data['tax_total'];
                    $journal_entry->debit_credit = 0;
                    $journal_entry->account_name_id = 9;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }

                if($total_discount > 0)
                {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = $total_discount;
                    $journal_entry->debit_credit = 0;
                    $journal_entry->account_name_id = 21;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }


                if ($credit_note_data['shipping_charge'] > 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = $credit_note_data['shipping_charge'];
                    $journal_entry->debit_credit = 1;
                    $journal_entry->account_name_id = 20;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }

                if ($credit_note_data['adjustment'] > 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = abs($credit_note_data['adjustment']);
                    $journal_entry->debit_credit = 0;
                    $journal_entry->account_name_id = 18;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                } 
                else if ($credit_note_data['adjustment'] < 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = abs($credit_note_data['adjustment']);
                    $journal_entry->debit_credit = 1;
                    $journal_entry->account_name_id = 18;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }

                $length = count($credit_note_data['discount']);
                $rate = $credit_note_data['rate'];
                $quantity = $credit_note_data['quantity'];
                $account_id = $credit_note_data['account_id'];
                $current_amount = 0;

                for ($i = 0; $i < $length; $i++) {
                    $current_amount = $quantity[$i] * $rate[$i];
                    $current_account_id = $account_id[$i];

                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = $current_amount;
                    $journal_entry->debit_credit = 1;
                    $journal_entry->account_name_id = $current_account_id;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }

                $helper = new \App\Lib\Helpers;
                $status = $helper->updateItemAfterCreatingCreditNote($credit_note_data, $credit_note_id, $user_id);
                

                return redirect()
                    ->route('credit_note')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Credit note added successfully!');

            }

        }

    }

    public function show($id)
    {
        $credit_notes= [];
        $credit_note = CreditNote::find($id);
        $invoices = Invoice::all();
        $items = Item::all();
        $taxes = Tax::all();
        $credit_notes = CreditNote::orderBy('credit_note_date','desc')->take(10)->get()->toArray();
        $date="credit_note_date";
        $sort= new sortBydate();
        $credit_notes= $sort->get('\App\Models\Moneyin\CreditNote',$date,'Y-m-d',$credit_notes);

        $credit_note_entries = CreditNoteEntry::where('credit_note_id', $id)->get();
        $sub_total = 0;
        $OrganizationProfile = OrganizationProfile::find(1);
        foreach ($credit_note_entries as $credit_note_entry)
        {
            $sub_total = $sub_total + $credit_note_entry->amount;
        }

        return view('creditnote::creditnote.show', compact('credit_note', 'invoices', 'credit_notes', 'OrganizationProfile', 'credit_note', 'sub_total','credit_note_entries'));
    }
    public function showupload(Request $request,$id=null){
        $credit = CreditNote::find($id);

        $validator = Validator::make($request->all(),[
            'file1' => 'required|max:10240',
        ]);
        if($validator->fails())
        {
            return response("file size not allowed");
        }
        if($request->hasFile('file1')) {
            $file = $request->file('file1');

            if ($credit->file_url) {
                $delete_path = public_path($credit->file_url);
                if(file_exists($delete_path)){
                    $delete = unlink($delete_path);
                }

            }

            $file_name = $file->getClientOriginalName();
            $without_extention = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention = $file->getClientOriginalExtension();
            $num = rand(1, 500);
            $new_file_name = "creditnote-".$credit->credit_note_number.'.'.$file_extention;

            $success = $file->move('uploads/creditnote', $new_file_name);

            if ($success) {
                $credit->file_url = 'uploads/creditnote/' . $new_file_name;


                $credit->save();
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
        
        $customers = Contact::all();
        $credit_note = CreditNote::find($id);
        $credit_note_number = $credit_note->credit_note_number;
        return view('creditnote::creditnote.edit', compact('customers', 'credit_note_number', 'credit_note'));
    }

    public function update(Request $request, $id)
    {
        $credit_note_data = $request->all();

        $user_id = Auth::user()->id;

        $helper = new \App\Lib\Helpers;
        $helper->updateItemAfterUpdatingCreditNote($credit_note_data, $user_id, $id);

        $credit_note = CreditNote::find($id);
        $credit_note->customer_id         = $credit_note_data['customer_id'];
        $credit_note->credit_note_number  = $credit_note_data['credit_note_number'];
        $credit_note->reference           = $credit_note_data['reference'];
        $credit_note->credit_note_date    = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
        $credit_note->shiping_charge      = $credit_note_data['shipping_charge'];
        $credit_note->adjustment          = $credit_note_data['adjustment'];
        $credit_note->total_credit_note   = $credit_note_data['total'];
        $credit_note->customer_note       = $credit_note_data['customer_note'];
        $credit_note->terms_and_condition = $credit_note_data['terms_and_condition'];
        $credit_note->created_by          = $user_id;
        $credit_note->updated_by          = $user_id;
        if($request->hasFile('file1'))
        {
            $file = $request->file('file1');
            if($credit_note->file_url){
                $delete_path = public_path($credit_note->file_url);
                if(file_exists($delete_path)){
                    $delete = unlink($delete_path);
                }
            }
            $file_name = $file->getClientOriginalName();
            $without_extention = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention = $file->getClientOriginalExtension();
            $num = rand(1, 500);
            $new_file_name = "creditnote-".$credit_note->credit_note_number.'.'.$file_extention;
            $success = $file->move('uploads/creditnote', $new_file_name);
            if($success){
                $credit_note->file_url = 'uploads/creditnote/' . $new_file_name;
            }else{
                $credit_note->file_url = null;
            }
        }

        if($credit_note->update())
        {
            $credit_note_entries_array = [];

            $item_id    = $credit_note_data['item_id'];
            $description    = $credit_note_data['description'];
            $account_id = $credit_note_data['account_id'];
            $quantity   = $credit_note_data['quantity'];
            $rate       = $credit_note_data['rate'];
            $discount   = $credit_note_data['discount'];
            $tax_id     = $credit_note_data['tax_id'];
            $amount     = $credit_note_data['amount'];

            // return $account_id;

            $length = count($item_id);

//            $credit_note_id = CreditNote::all()->last()->id;

            $credit_note_id = $id;

            for($i = 0; $i < $length; $i++)
            {
                $credit_note_entries_array[] = [
                    'item_id'        => $item_id[$i],
                    'description'        => $description[$i],
                    'account_id'     => $account_id[$i],
                    'quantity'       => $quantity[$i],
                    'rate'           => $rate[$i],
                    'discount'       => $discount[$i],
                    'tax_id'         => $tax_id[$i],
                    'amount'         => $amount[$i],
                    'credit_note_id' => $credit_note_id,
                    'created_by'     => $user_id,
                    'updated_by'     => $user_id,
                    'created_at'     => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at'     => \Carbon\Carbon::now()->toDateTimeString()
                ];
            }


            $credit_note_entries = CreditNoteEntry::where('credit_note_id', $credit_note_id)->pluck('id')->toArray();

            if (count($credit_note_entries)) {
                CreditNoteEntry::destroy($credit_note_entries);
            }

            $save = DB::table('credit_note_entries')->insert($credit_note_entries_array);

            if($save)
            {

                $journal_entries = JournalEntry::where('credit_note_id', $credit_note_id)->where('jurnal_type', 11)->pluck('id')->toArray();

                if (count($journal_entries)) {
                    JournalEntry::destroy($journal_entries);
                }

                $length = count($credit_note_data['discount']);
                $discount = $credit_note_data['discount'];
                $rate = $credit_note_data['rate'];
                $quantity = $credit_note_data['quantity'];
                $total_amount = 0;
                $total_discount = 0;

                for ($i = 0; $i < $length; $i++)
                {
                    $current_amount = $quantity[$i] * $rate[$i];
                    $total_amount = $total_amount + $current_amount;
                    $total_discount = $total_discount + ($discount[$i] * $rate[$i]) / 100;
                }

                $journal_entry = new JournalEntry;
                $journal_entry->amount              = $credit_note_data['total'];
                $journal_entry->debit_credit        = 0;
                $journal_entry->account_name_id     = 5;
                $journal_entry->jurnal_type         = 11;
                $journal_entry->credit_note_id      = $credit_note_id;
                $journal_entry->contact_id          = $credit_note_data['customer_id'];
                $journal_entry->created_by          = $user_id;
                $journal_entry->updated_by          = $user_id;
                $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                $journal_entry->save();

                if($credit_note_data['tax_total']>0)
                {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount              = $credit_note_data['tax_total'];
                    $journal_entry->debit_credit        = 0;
                    $journal_entry->account_name_id     = 9;
                    $journal_entry->jurnal_type         = 11;
                    $journal_entry->credit_note_id      = $credit_note_id;
                    $journal_entry->contact_id          = $credit_note_data['customer_id'];
                    $journal_entry->created_by          = $user_id;
                    $journal_entry->updated_by          = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }


                if($total_discount>0)
                {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount              = $total_discount;
                    $journal_entry->debit_credit        = 0;
                    $journal_entry->account_name_id     = 21;
                    $journal_entry->jurnal_type         = 11;
                    $journal_entry->credit_note_id      = $credit_note_id;
                    $journal_entry->contact_id          = $credit_note_data['customer_id'];
                    $journal_entry->created_by          = $user_id;
                    $journal_entry->updated_by          = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }


                if ($credit_note_data['shipping_charge'] > 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = $credit_note_data['shipping_charge'];
                    $journal_entry->debit_credit = 1;
                    $journal_entry->account_name_id = 20;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }

                if ($credit_note_data['adjustment'] > 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = abs($credit_note_data['adjustment']);
                    $journal_entry->debit_credit = 0;
                    $journal_entry->account_name_id = 18;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                } 
                else if ($credit_note_data['adjustment'] < 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = abs($credit_note_data['adjustment']);
                    $journal_entry->debit_credit = 1;
                    $journal_entry->account_name_id = 18;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }

                $length = count($credit_note_data['discount']);
                $rate = $credit_note_data['rate'];
                $quantity = $credit_note_data['quantity'];
                $account_id = $credit_note_data['account_id'];
                $current_amount = 0;

                for ($i = 0; $i < $length; $i++)
                {
                    $current_amount = $quantity[$i] * $rate[$i];
                    $current_account_id = $account_id[$i];

                    $journal_entry = new JournalEntry;
                    $journal_entry->amount              = $current_amount;
                    $journal_entry->debit_credit        = 1;
                    $journal_entry->account_name_id     = $current_account_id;
                    $journal_entry->jurnal_type         = 11;
                    $journal_entry->credit_note_id      = $credit_note_id;
                    $journal_entry->contact_id          = $credit_note_data['customer_id'];
                    $journal_entry->created_by          = $user_id;
                    $journal_entry->updated_by          = $user_id;
                    $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_data['credit_note_date']));
                    $journal_entry->save();
                }

                return redirect()
                    ->route('credit_note')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Credit note updated successfully!');

            }
            else
            {
                return redirect()
                    ->route('credit_note_edit', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Something went wrong! Cannot update data!');

            }
        }
    }

    public function destroy($id)
    {

        $helper = new \App\Lib\Helpers;
        $helper->itemBackAfterDeletingCreditNote($id);
        
        
        $credit_note = CreditNote::find($id);
        if($credit_note->delete())
        {
            if($credit_note->file_url)
            {
                $delete_path = public_path($credit_note->file_url);
                if(file_exists($delete_path)){
                    $delete = unlink($delete_path);
                }
            }
            return redirect()
                ->route('credit_note')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Data deleted Successfully!');
        }
        else
        {
            return redirect()
                ->route('credit_note')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Something went wrong! Data cannot delete!');
        }
    }

}
