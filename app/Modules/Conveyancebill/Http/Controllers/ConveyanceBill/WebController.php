<?php

namespace App\Modules\Conveyancebill\Http\Controllers\ConveyanceBill;

use App\Models\AccountChart\Account;
use App\Models\Branch\Branch;
use App\Models\Contact\Contact;
use App\Models\ManualJournal\JournalEntry;
use App\Models\MoneyOut\Expense;
use App\Models\Tax;
use Illuminate\Http\Request;

use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;

use App\Http\Requests;
use App\Http\Controllers\Controller;


//Models
use App\Models\ConveyanceBill\ConveyanceBill;
use App\Models\ConveyanceBill\ConveyanceBillList;
use App\Models\OrganizationProfile\OrganizationProfile;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class WebController extends Controller
{
    
    public function index()
    {
        $auth_id = Auth::id();
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $condition = "YEAR(str_to_date(date,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(date,'%Y-%m-%d')) = MONTH(CURDATE())";
        if($branch_id==1)
        {
            $conveyance = ConveyanceBill::whereRaw($condition)->get();
            return view('conveyancebill::conveyanceBill.index' , compact('conveyance','branchs'));
        }
        else
        {
            $conveyance = ConveyanceBill::select(DB::raw('conveyance_bills.*'))->whereRaw($condition)
                                          ->join('users','users.id','=','conveyance_bills.created_by')
                                          ->where('users.branch_id',$branch_id)
                                          ->get();

            return view('conveyancebill::conveyanceBill.index' , compact('conveyance','branchs'));
        }

    }
    public function byuser()
    {
        $auth_id = Auth::id();
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $condition = "YEAR(str_to_date(date,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(date,'%Y-%m-%d')) = MONTH(CURDATE())";
        if($branch_id==1)
        {
            $conveyance = ConveyanceBill::whereRaw($condition)->where('user_id',$auth_id)->get();
            return view('conveyancebill::conveyanceBill.mybill.index' , compact('conveyance','branchs'));
        }
        else
        {
            $conveyance = ConveyanceBill::select(DB::raw('conveyance_bills.*'))->whereRaw($condition)
                                          ->join('users','users.id','=','conveyance_bills.created_by')
                                           ->where('conveyance_bills.user_id',$auth_id)
                                          ->where('users.branch_id',$branch_id)
                                          ->get();

            return view('conveyancebill::conveyanceBill.mybill.index' , compact('conveyance','branchs'));
        }

    }
    public function search(Request $request)
    {
        $branchs = Branch::orderBy('id', 'asc')->get();
        $branch_id = $request->branch_id;
        if(session('branch_id')==1)
        {
            $branch_id =  $request->branch_id?$request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id = session('branch_id');
        }
        $conveyance= [];
        $from_date =   date('Y-m-d', strtotime($request->from_date));
        $to_date =     date('Y-m-d', strtotime($request->to_date));
        $condition =  "str_to_date(date, '%Y-%m-%d') between '$from_date' and '$to_date'";
        if($branch_id==1){
            $conveyance = ConveyanceBill::select(DB::raw('conveyance_bills.*'))->whereRaw($condition)->get();


        }
        else
        {
            $conveyance = ConveyanceBill::select(DB::raw('conveyance_bills.*'))->whereRaw($condition)
                ->join('users','users.id','=','conveyance_bills.created_by')
                ->where('branch_id',$branch_id)
                ->get();

        }

        return view('conveyancebill::conveyanceBill.index' , compact('conveyance','branchs','branch_id','from_date','to_date'));

    }


    public function create()
    {
        return view('conveyancebill::conveyanceBill.create');
    }

    
    public function store(Request $request)
    {
        $arr = [];
        $to = $this->flatten($request->to);
        $from = $this->flatten($request->from);
        $transport = $this->flatten($request->transport);
        $amount = $this->flatten($request->amount);

        $arr['to'] = $to;
        $arr['from'] = $from;
        $arr['transport'] = $transport;
        $arr['amount'] = $amount;

        $conveyance = new ConveyanceBill;

        $conveyance->user_id            = Auth::user()->id;
        $conveyance->date               = $request->date;
        $conveyance->created_by         = Auth::user()->id;
        $conveyance->updated_by         = Auth::user()->id;
        
        $conveyance->save();

        $last = ConveyanceBill::all()->last();

        for($i=0; $i<count($arr['to']);$i++) 
        {

            $list = new ConveyanceBillList;

            $list->conveyance_bill_id       = $last->id;
            $list->from                     = $arr['from'][$i];
            $list->to                       = $arr['to'][$i];
            $list->transport                = $arr['transport'][$i];
            $list->amount                   = $arr['amount'][$i];
            $list->created_by               = Auth::user()->id;
            $list->updated_by               = Auth::user()->id;

            $list->save();
            
        }

        return Redirect::route('cnb')->with('message' , 'Conveyance Bill Insert Successfully');

    }

    function flatten(array $array) 
    {
        $return = array();
        array_walk_recursive($array, function($a) use (&$return) { $return[] = $a; });
        return $return;
    }
    
    public function show($id)
    {
        $conveyance = ConveyanceBill::find($id);
        $list = ConveyanceBillList::where('conveyance_bill_id' , $id)->get();
        $sum = ConveyanceBillList::where('conveyance_bill_id' , $id)->sum('amount');
        
        return view('conveyancebill::conveyanceBill.show' , compact('conveyance' , 'list' , 'sum'));
    }

    
    public function edit($id)
    {
        $conveyance = ConveyanceBill::find($id);
        $list = ConveyanceBillList::where('conveyance_bill_id' , $id)->get();


        return view('conveyancebill::conveyanceBill.edit' , compact('conveyance' , 'list'));
    }

    
    public function update(Request $request, $id)
    {
        $arr = [];
        $to = $this->flatten($request->to);
        $from = $this->flatten($request->from);
        $transport = $this->flatten($request->transport);
        $amount = $this->flatten($request->amount);

        $arr['to'] = $to;
        $arr['from'] = $from;
        $arr['transport'] = $transport;
        $arr['amount'] = $amount;

        $delete_form = ConveyanceBillList::where('conveyance_bill_id' , $id)->get();

        foreach($delete_form as $all)
        {
            $all->delete();
        }

        for($i=0; $i<count($arr['to']);$i++) 
        {

            $list = new ConveyanceBillList;

            $list->conveyance_bill_id       = $id;
            $list->from                     = $arr['from'][$i];
            $list->to                       = $arr['to'][$i];
            $list->transport                = $arr['transport'][$i];
            $list->amount                   = $arr['amount'][$i];
            $list->created_by               = Auth::user()->id;
            $list->updated_by               = Auth::user()->id;

            $list->save();
            
        }

        return back()->with('message' , 'Conveyance Bill Updated Successfully');

    }

    
    public function destroy($id)
    {
        $information = ConveyanceBill::find($id);

        if($information->delete()){
            return back()->with('message' , 'Conveyance Bill Deleted Successfully');
        }
        else{
            return back()->with('message' , 'Conveyance Bill Update Failed');
        }
    }

    public function checkBy($id)
    {
        $information = ConveyanceBill::find($id);
        return view('conveyancebill::conveyanceBill.check' , compact('information'));
    }

    public function checkByUpdate(Request $request, $id)
    {
        $check_approve = ConveyanceBill::find($id);

        $check_approve->checked_by              = Auth::user()->id;
        $check_approve->comments                = $request->comment;

        $check_approve->update();

        return redirect('conveyancebill/')->with('message' , 'Conveyance Bill Checked Successfully');
    }

    public function approveByUpdate(Request $request, $id, $value)
    {

        $check_approve = ConveyanceBill::find($id);

        if($value == 0)
        {
            $check_approve->approved_by               = Auth::user()->id;
            $check_approve->updated_by                = Auth::user()->id;

            $check_approve->update();

        }
        else
        {
            $check_approve->approved_by               = Null;
            $check_approve->updated_by                = Auth::user()->id;

            $check_approve->update();

        }

        
    }

    public function approvedByChairmanUpdate(Request $request, $id, $value)
    {

        $check_approve = ConveyanceBill::find($id);

        if($value == 0)
        {
            $check_approve->approved_by_chairman                = Auth::user()->id;
            $check_approve->updated_by                          = Auth::user()->id;

            $check_approve->update();
        }
        else
        {
            $check_approve->approved_by_chairman                = Null;
            $check_approve->updated_by                          = Auth::user()->id;

            $check_approve->update();
        }

        return redirect('conveyancebill/')->with('message' , 'Conveyance Bill Approved Successfully');
    }

    public function pdf($id)
    {
        $conveyance = ConveyanceBill::find($id);
        $list = ConveyanceBillList::where('conveyance_bill_id' , $id)->get();
        $sum = ConveyanceBillList::where('conveyance_bill_id' , $id)->sum('amount');
        $OrganizationProfile = OrganizationProfile::find(1);
        $pdf = PDF::loadView('conveyancebill::conveyanceBill.cnbPdf', compact('conveyance' , 'list' , 'sum' , 'OrganizationProfile'));


        return $pdf->stream('invoice.pdf');
    }

    public function myBill()
    {
        $conveyance = ConveyanceBill::where('user_id' , Auth::user()->id)->get();

        return view('conveyancebill::conveyanceBill.my_bill' , compact('conveyance'));
    }



    public function createExpense($id){

        $customers = Contact::all();
        $accounts = Account::all();
        $paid_throughs = Account::where('account_type_id',4)->get();

        $conveyance = ConveyanceBill::find($id);

        if(!$conveyance)
        {
            return redirect()
                ->route('cnb')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Conveyance Bill not found!');
        }
        $conveyance_amount = $conveyance->conveyance_bill_list()->sum('amount');

      //  dd($conveyance_amount);


        return view('conveyancebill::expense.create' , compact('conveyance','customers','accounts','paid_throughs','id'));
    }



    public function storeExpense(Request $request)
    {
        $data = $request->all();


        $this->validate($request, [
            'expense_date'      => 'required',
            'account_id'        => 'required',
            'amount'            => 'required',
            'tax_id'            => 'required',
            'amount_is'         => 'required',
            'customer_id'       => 'required',
            'amount_is'         => 'required',
            'paid_through_id'   => 'required',
        ]);

        $total_tax = 0;
        $user_id = Auth::user()->id;

        $tax_amount = Tax::find($data['tax_id'])->amount_percentage;
        if($data['amount_is'] == 1)
        {
            $total_tax = ($data['amount']*($tax_amount/100));
        }
        else
        {
            $total_tax = ($data['amount']*($tax_amount/110));
        }
        $expense_number_count = Expense::orderBy('expense_number','desc')->first();
        if(count($expense_number_count)){
            $expense_number = $expense_number_count->expense_number+1;
        }else{
            $expense_number= 1;
        }

        $expense = new Expense;

        if(isset($data['save']))
        {
            $expense->save = 1;
        }
        $expense->date              = date("Y-m-d", strtotime($data['expense_date']));
        $expense->amount            = round($data['amount']+$total_tax, 2);
        $expense->expense_number    = $expense_number;
        $expense->paid_through_id   = $data['paid_through_id'];
        $expense->tax_total         = round($total_tax, 2);
        $expense->reference         = $data['reference'];
        $expense->note              = $data['customer_note'];
        $expense->account_id        = $data['account_id'];
        $expense->vendor_id         = $data['customer_id'];
        $expense->tax_id            = $data['tax_id'];
        $expense->tax_type          = $data['amount_is'];
        $expense->created_by        = $user_id;
        $expense->updated_by        = $user_id;
        if($request->hasFile('file1'))
        {
            $file = $request->file('file1');
            if($expense->file_url){
                $delete_path = public_path($expense->file_url);
                if(file_exists($delete_path)){
                    $delete = unlink($delete_path);
                }
            }
            $file_name = $file->getClientOriginalName();
            $without_extention = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention = $file->getClientOriginalExtension();
            $num = rand(1, 500);
            $new_file_name = "expense-".$expense_number.'.'.$file_extention;
            $success = $file->move('uploads/expense', $new_file_name);
            if($success){
                $expense->file_url = 'uploads/expense/' . $new_file_name;
            }else{
                $expense->file_url = null;
            }
        }
        if(isset($data['bank_info']))
        {
            $expense->bank_info = $data['bank_info'];
        }

        if(isset($data['invoice_show']))
        {
            $expense->invoice_show = "on";
        }

        if($expense->save())
        {
            $id=$request->id;
            $convence=ConveyanceBill::find($id);
            $convence->expense_id=$expense->id;
            $convence->save();
            $expense = Expense::orderBy('created_at', 'desc')->first();
            $expense_id = $expense['id'];
            if(isset($data['submit']))
            {
                $status = $this->insertExpenseInJournal($total_tax, $data['amount'], $data, $expense_id);
                if($status)
                {
                    return redirect()
                        ->route('cnb')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Conveyance Bill Expense added successfully!');
                }
                else
                {
                    $expense = Expense::find($expense_id);
                    $expense->delete();
                    {
                        return redirect()
                            ->route('cnb')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Something went to wrong! Please check your input field');
                    }
                }
            }
            else
            {
                return redirect()
                    ->route('cnb')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Conveyance Bill added successfully!');
            }




        }
    }

    public function insertExpenseInJournal($total_tax, $total_amount, $data, $expense_id)
    {
        $user_id = Auth::user()->id;

        $journal_entry = new JournalEntry;
        $journal_entry->debit_credit    = 0;
        $journal_entry->amount          = round(($total_tax + $total_amount) , 2);
        $journal_entry->jurnal_type    = "expense";
        $journal_entry->account_name_id = $data['paid_through_id'];
        $journal_entry->contact_id      = $data['customer_id'];
        $journal_entry->note            = $data['customer_note'];
        $journal_entry->expense_id      = $expense_id;
        $journal_entry->assign_date      = date('Y-m-d',strtotime($data['expense_date']));
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;

        if($journal_entry->save())
        {
            $journal_entry = new JournalEntry;
            $journal_entry->debit_credit    = 1;
            $journal_entry->amount          = round($total_amount, 2);
            $journal_entry->jurnal_type    = "expense";
            $journal_entry->account_name_id = $data['account_id'];
            $journal_entry->contact_id      = $data['customer_id'];
            $journal_entry->note            = $data['customer_note'];
            $journal_entry->expense_id      = $expense_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['expense_date']));
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;

            if($journal_entry->save())
            {
                $journal_entry = new JournalEntry;
                $journal_entry->debit_credit    = 1;
                $journal_entry->amount          = round($total_tax, 2);
                $journal_entry->jurnal_type    = "expense";
                $journal_entry->account_name_id = 9;
                $journal_entry->contact_id      = $data['customer_id'];
                $journal_entry->note            = $data['customer_note'];
                $journal_entry->assign_date      = date('Y-m-d',strtotime($data['expense_date']));
                $journal_entry->expense_id      = $expense_id;
                $journal_entry->created_by      = $user_id;
                $journal_entry->updated_by      = $user_id;

                if($journal_entry->save())
                {
                    return true;
                }
                else
                {
                    return false;
                }
            }
            else
            {
                return false;
            }
        }
        else
        {
            return false;
        }
    }


}
