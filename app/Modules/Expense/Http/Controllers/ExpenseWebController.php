<?php

namespace App\Modules\Expense\Http\Controllers;

use App\Lib\sortBydate;
use App\Models\Branch\Branch;
use App\Models\ConveyanceBill\ConveyanceBill;
use App\Models\Recruit\RecruitExpense;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use RuntimeException;
use Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\MoneyOut\Expense;
use App\Models\Contact\Contact;
use App\Models\AccountChart\Account;
use App\Models\Tax;
use App\Models\ManualJournal\JournalEntry;
use App\Models\OrganizationProfile\OrganizationProfile;

class ExpenseWebController extends Controller
{
    public function index()
    {
        $expenses = [];
        $auth_id = Auth::id();
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $sort = new sortBydate();
        $date = "date";
        $condition = "YEAR(str_to_date(date,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(date,'%Y-%m-%d')) = MONTH(CURDATE())";
        if($branch_id==1)
         {

         $expenses = Expense::whereRaw($condition)->get()->toArray();

         try{
             $expenses = $sort->get('\App\Models\MoneyOut\Expense', $date, 'Y-m-d', $expenses);
                         return view('expense::expense.index', compact('expenses', 'branchs'));
            }catch(\Exception $exception){
                         return view('expense::expense.index', compact('expenses', 'branchs'));
            }
        }
        else
        {

        $expenses = Expense::select(DB::raw('expense.*'))->whereRaw($condition)->join('users','users.id','=','expense.created_by')->where('users.branch_id',$branch_id)->get()->toArray();
        try{
           $expenses = $sort->get('\App\Models\MoneyOut\Expense', $date, 'Y-m-d', $expenses);
                       return view('expense::expense.index', compact('expenses', 'branchs'));
            }catch(\Exception $exception){
                       return view('expense::expense.index', compact('expenses', 'branchs'));
            }
          catch(RuntimeException $e) {
            echo ("RuntimeException...");
        }
        }
    }

    public function search(Request $request)
    {
        $branchs = Branch::orderBy('id','asc')->get();
        $branch_id =  $request->branch_id;

        if(session('branch_id')==1)
        {
            $branch_id =  $request->branch_id?$request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id = session('branch_id');
        }

        $from_date =  date('Y-m-d',strtotime($request->from_date));
        $to_date =  date('Y-m-d',strtotime($request->to_date));
        $condition = "str_to_date(date, '%Y-%m-%d') between '$from_date' and '$to_date'";
        if($branch_id==1){
            $expenses = Expense::select(DB::raw('expense.*'))->whereRaw($condition)->get()->toArray();
        }else{
            $expenses = Expense::select(DB::raw('expense.*'))->whereRaw($condition)->join('users','users.id','=','expense.created_by')->where('users.branch_id',$branch_id)->get()->toArray();

        }
        $date="date";
        $sort= new sortBydate();
        try{
            $expenses= $sort->get('\App\Models\MoneyOut\Expense',$date,'Y-m-d',$expenses);
            return view('expense::expense.index', compact('expenses','branchs','branch_id','from_date','to_date'));
        }catch (\Exception $exception){
            return view('expense::expense.index', compact('expenses','branchs','branch_id','from_date','to_date'));
        }

    }
    
    public function create()
    {
        $customers = Contact::all();
        $accounts = Account::all();
        $paid_throughs = Account::where('account_type_id',4)->get();
        return view('expense::expense.create', compact('customers', 'accounts', 'taxes', 'paid_throughs'));
    }
    
    public function store(Request $request)
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
            $expense = Expense::orderBy('created_at', 'desc')->first();
            $expense_id = $expense['id'];
            if(isset($data['submit']))
            {
                $status = $this->insertExpenseInJournal($total_tax, $data['amount'], $data, $expense_id);
                if($status)
                {
                    return redirect()
                        ->route('expense')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Expense added successfully!');
                }
                else
                {
                    $expense = Expense::find($expense_id);
                    $expense->delete();
                    {
                        return redirect()
                            ->route('expense')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Something went to wrong! Please check your input field');
                    }
                }
            }
          else
          {
                return redirect()
                    ->route('expense')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Expense added successfully!');
          }




        }
    }


    public function show($id)
    {
        $expenses= [];
        $expense = Expense::find($id);
        $expenses = Expense::all()->toArray();
        $date="date";
        $sort= new sortBydate();
        $expenses= $sort->get('\App\Models\MoneyOut\Expense',$date,'Y-m-d',$expenses);
        $OrganizationProfile = OrganizationProfile::find(1);

        return view('expense::expense.show', compact('OrganizationProfile','expense', 'expenses'));
    }
    public function showupload(Request $request,$id=null){
        $expense = Expense::find($id);
        $validator = Validator::make($request->all(),[
            'file1' => 'required|max:10240',
        ]);
        if($validator->fails())
        {
            return response("file size not allowed");
        }

        if($request->hasFile('file1'))
        {
            $file = $request->file('file1');

            if($expense->file_url)
            {
                $delete_path = public_path($expense->file_url);
                if(file_exists($delete_path))
                {
                   unlink($delete_path);
                }

            }

            $file_name = $file->getClientOriginalName();
            $without_extention = substr($expense, 0, strrpos($file_name, "."));
            $file_extention = $file->getClientOriginalExtension();
            $num = rand(1, 500);
            $new_file_name = "expense-".$expense->expense_number.'.'.$file_extention;

            $success = $file->move('uploads/expense', $new_file_name);

            if($success)
            {
                $expense->file_url = 'uploads/expense/' . $new_file_name;
                //$Bank->file_name = $new_file_name;

                $expense->save();
                return response("success");
            }
            else
            {
                return response("success");
            }
        }
        else
        {
            return response("file not found");
        }

    }

    public function edit($id)
    {
        $expense = Expense::find($id);
        $customers = Contact::all();
        $accounts = Account::all();
        $paid_throughs = Account::where('account_type_id',4)->get();
        return view('expense::expense.edit', compact('customers', 'accounts', 'taxes', 'paid_throughs','expense'));
    }


    public function update(Request $request, $id)
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

        $expense = Expense::find($id);
        $expense->date              =  date("Y-m-d", strtotime($data['expense_date']));
        $expense->amount            = round($data['amount']+$total_tax, 2);
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
            $new_file_name = "expense-".$expense->expense_number.'.'.$file_extention;
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
        else
        {
            $expense->invoice_show = "";
        }

        if($expense->update())
        {
            if(isset($data['submit']))
            {
                $status = $this->updateExpenseInJournal($total_tax, $data['amount'], $data, $id);
                if($status)
                {
                    return redirect()
                        ->route('expense')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Expense updated successfully!');
                }
                else
                {
                    $expense = Expense::find($id);
                    $expense->delete();
                    {
                        return redirect()
                            ->route('expense')
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'Something went to wrong! Please check your input field');
                    }
                }
            }
            else
           {

                return redirect()
                    ->route('expense')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Expense updated successfully!');
            }


        }
    }

   public function expense_update_mark($id)
   {
       DB::beginTransaction();
       try{
           $user_id = Auth::user()->id;
           $expense = Expense::find($id);
           $expense->save = null;
           $expense->save();
           $data = $expense->toArray();
           $total_tax= $data['tax_total'];
           $total_amount= $data['amount'];
           $expense_id = $data['id'];
           $journal_entry = new JournalEntry;
           $journal_entry->debit_credit    = 0;
           $journal_entry->amount          = round(($total_amount) , 2);
           $journal_entry->jurnal_type    = "expense";
           $journal_entry->account_name_id = $data['paid_through_id'];
           $journal_entry->contact_id      = $data['vendor_id'];
           $journal_entry->note            = $data['note'];
           $journal_entry->expense_id      = $expense_id;
           $journal_entry->assign_date      = date('Y-m-d',strtotime($data['date']));
           $journal_entry->created_by      = $user_id;
           $journal_entry->updated_by      = $user_id;

           if($journal_entry->save())
           {
               $journal_entry = new JournalEntry;
               $journal_entry->debit_credit = 1;
               $journal_entry->amount = round($total_amount-$total_tax, 2);
               $journal_entry->jurnal_type = "expense";
               $journal_entry->account_name_id = $data['account_id'];
               $journal_entry->contact_id = $data['vendor_id'];
               $journal_entry->note = $data['note'];
               $journal_entry->expense_id = $expense_id;
               $journal_entry->assign_date = date('Y-m-d', strtotime($data['date']));
               $journal_entry->created_by = $user_id;
               $journal_entry->updated_by = $user_id;

               if ($journal_entry->save())
               {
                   $journal_entry = new JournalEntry;
                   $journal_entry->debit_credit = 1;
                   $journal_entry->amount = round($total_tax, 2);
                   $journal_entry->jurnal_type = "expense";
                   $journal_entry->account_name_id = 9;
                   $journal_entry->contact_id = $data['vendor_id'];
                   $journal_entry->note = $data['note'];
                   $journal_entry->assign_date = date('Y-m-d', strtotime($data['date']));
                   $journal_entry->expense_id = $expense_id;
                   $journal_entry->created_by = $user_id;
                   $journal_entry->updated_by = $user_id;

                   if ($journal_entry->save()){
                       DB::commit();
                      return back()
                           ->with('alert.status', 'success')
                           ->with('alert.message', 'Expense journal added successfully!!!');
                   } else {
                       throw new \Exception();
                   }
               }
            }else{
               throw new \Exception();
           }


       }catch (\Exception $exception){


           DB::rollBack();
           return back()
               ->with('alert.status', 'danger')
               ->with('alert.message', 'Expense journal add fail!!!');
       }

   }
    public function destroy($id)
    {
        try{


            $expense = Expense::find($id);
           if($expense->delete())
            {
                $recruit_expense=RecruitExpense::where('expense_id',$id)->first();

                if (!empty($recruit_expense)){

                    $recruit_expense->expense_id=null;
                    $recruit_expense->save();
                }

                $convienci_bill=ConveyanceBill::where('expense_id',$id)->first();

                if (!empty($convienci_bill)){

                    $convienci_bill->expense_id=null;
                    $convienci_bill->save();
                }


                if($expense->file_url){
                    $delete_path = public_path($expense->file_url);
                    if(file_exists($delete_path)){
                        $delete = unlink($delete_path);
                    }
                }

                return redirect()
                    ->route('expense')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Expense deleted successfully!!!');
            }

          throw new \Exception(" ");
        }catch (\Exception $exception){
            $msg = $exception->getMessage();
            return redirect()
                ->route('expense')
                ->with('alert.status', 'danger')
                ->with('alert.message', "Expense not deleted!!!. $msg ");
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

    public function updateExpenseInJournal($total_tax, $total_amount, $data, $expense_id)
    {
        $user_id = Auth::user()->id;

        $expense_entries_delete = Expense::find($expense_id)->journalEntries();

        if($expense_entries_delete->delete())
        {

        }

        $journal_entry = new JournalEntry;
        $journal_entry->debit_credit    = 0;
        $journal_entry->amount          = round(($total_tax + $total_amount), 2);
        $journal_entry->jurnal_type    = "expense";
        $journal_entry->account_name_id = $data['paid_through_id'];
        $journal_entry->contact_id      = $data['customer_id'];
        $journal_entry->note            = $data['customer_note'];
        $journal_entry->expense_id      = $expense_id;
        $journal_entry->created_by      = $user_id;
        $journal_entry->updated_by      = $user_id;
        $journal_entry->assign_date      = date('Y-m-d',strtotime($data['expense_date']));

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
            $journal_entry->created_by      = $user_id;
            $journal_entry->updated_by      = $user_id;
            $journal_entry->assign_date      = date('Y-m-d',strtotime($data['expense_date']));

            if($journal_entry->save())
            {
                $journal_entry = new JournalEntry;
                $journal_entry->debit_credit    = 1;
                $journal_entry->amount          = round($total_tax, 2);
                $journal_entry->jurnal_type    = "expense";
                $journal_entry->account_name_id = 9;
                $journal_entry->contact_id      = $data['customer_id'];
                $journal_entry->note            = $data['customer_note'];
                $journal_entry->expense_id      = $expense_id;
                $journal_entry->created_by      = $user_id;
                $journal_entry->updated_by      = $user_id;
                $journal_entry->assign_date      = date('Y-m-d',strtotime($data['expense_date']));

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
