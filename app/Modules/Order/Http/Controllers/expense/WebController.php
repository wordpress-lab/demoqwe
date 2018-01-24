<?php

namespace App\Modules\Order\Http\Controllers\expense;

use App\Models\AccountChart\Account;
use App\Models\Backup\backup;
use App\Models\Contact\Contact;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\Invoice;
use App\Models\MoneyOut\Expense;
use App\Models\Recruit\ExpenseSector;
use App\Models\Recruit\RecruiteExpensePax;
use App\Models\Recruit\RecruitExpense;
use App\Models\Recruit\Recruitorder;
use App\Models\Setting\SalesComission;
use App\Models\Tax;

use App\Modules\Order\Http\ResponseExpense\ResponseExpense;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Response;
use Illuminate\Validation\Validator;
use League\Flysystem\Exception;

class WebController extends Controller
{

    public function index()
    {
      $sector = RecruitExpense::all();

      return view('order::expense.index', compact('sector'));
    }


    public function create()
    {
        $expence_account=Account::all();
        $paid_through=Account::where('account_type_id',4)
                                ->orWhere('account_type_id',5)
                                ->groupBy('account_type_id')
                                ->get();
        $vendor=Contact::all();
        $sector = ExpenseSector::all();
        $pax= Recruitorder::all();
        $account = Account::whereIn('account_type_id',[4,5])->get();
        return view('order::expense.create', compact('sector','pax','expence_account','paid_through','vendor','account'));
    }

    public function apiJournal(Request $request)
    {

         $journal = JournalEntry::paginate(1);
         return Response::json($journal);
    }
    public function apiAgent(Request $request)
    {
        $id = $request->id;
        $number  = new \stdClass();
        $number->id = 1;
        $number_new=DB::table('salescommisions')->latest('id')->first();
        $number = $number_new?$number_new->id:$number->id;
        $scnumber = decbin(++$number);

        $commision= 0;
        $account = Account::whereIn('account_type_id',[4,5])->get();
        $payable = Invoice::where('agents_id',$id)->where('commission_type',2)->sum('agentcommissionAmount');
        $totalpayable = Invoice::where('agents_id',$id)->where('commission_type',1)->get();
        foreach ($totalpayable as $item)
        {
            $percent = ($item->total_amount/100)*$item->agentcommissionAmount;
            $commision = $commision+$percent;
        }
        $totalpayable = $payable + $commision;
        $com_amount = SalesComission::where('agents_id',$id)->sum('amount');
        $agent  = Contact::find($id);
        $data["agent"] = $agent;
        $data["com_amount"] = $com_amount;
        $data["totalpayable"] = $totalpayable;
        $data["scnumber"] = str_pad($scnumber,6,0,STR_PAD_LEFT);
        $data["account"] = $account;

        return Response::json($data);
    }

    public function expensSectorPax(Request $request)
    {
        $id= $request->id;
        if(!is_numeric($id) || is_null($id) || !isset($request->id)){
            return [];
        }

        try{
            $data = Recruitorder::select("recruitingorder.id as id","recruitingorder.paxid as title","recruitingorder.paxid as url")
                ->distinct("recruitingorder.id")
                ->whereNOTIn("recruitingorder.id",function ($quary) use ($id){
                    $quary->select( DB::raw("DISTINCT recruitingorder.id as id from `recruitingorder` 
                        left join `recruiteexpensepax` on `recruiteexpensepax`.`paxid` = `recruitingorder`.`id` 
                        left join `recruiteexpense` on `recruiteexpensepax`.`recruitExpenseid` = `recruiteexpense`.`id`
                        left join `expensesector` on `expensesector`.`id` = `recruiteexpense`.`expenseSectorid`
                        WHERE recruiteexpense.expenseSectorid =$id") );
                })
                ->get();
            return response($data);
        }catch (\Exception $exception){
           return [];
        }

    }
    public function apiPayable(Request $request)
    {
        $expenseData = [];
        $totalpayable = 0;
        $totalcommission = 0;

        foreach ($request->paxid as $pax)
        {
            $nulljournal = [];
            $salescommission =  RecruitExpense::join("recruiteexpensepax","recruiteexpensepax.recruitExpenseid","recruiteexpense.id")
                                                ->leftjoin("salescommisions","salescommisions.id","recruiteexpense.sales_commission_id")
                                                ->where("salescommisions.agents_id",$request->agentid)
                                                ->where("recruiteexpensepax.paxid",$pax)
                                                ->groupBy("recruiteexpense.id")
                                                ->selectRaw('((sum(salescommisions.amount))/(select count(recruiteexpensepax.recruitExpenseid) from recruiteexpensepax  where recruiteexpensepax.recruitExpenseid=recruiteexpense.id)) as sum,(select count(recruiteexpensepax.recruitExpenseid) from recruiteexpensepax  where recruiteexpensepax.recruitExpenseid=recruiteexpense.id) as count_exp')
                                                ->get();
            $salescommission = $salescommission->sum('sum');
            $totalcommission= $totalcommission+$salescommission;
            $journal = JournalEntry::join("recruitingorder","recruitingorder.invoice_id","journal_entries.invoice_id")
                                    ->where("journal_entries.agent_id",$request->agentid)
                                    ->where("journal_entries.account_name_id",30)
                                    ->where("recruitingorder.id",$pax)
                                    ->where("journal_entries.jurnal_type","sales_commission")
                                    ->select("journal_entries.amount","recruitingorder.paxid as paxid")
                                    ->first();
            if(!$journal)
            {
                $singlepax= Recruitorder::find($pax);
                $nulljournal["id"] =$pax;
                $nulljournal["amount"] =0;
                $nulljournal["paxid"] =$singlepax->paxid;
                $nulljournal["commisionamount"] =$salescommission;
                $nulljournal["expense"] =null;
            }
            else
            {
                $totalpayable=$totalpayable+$journal["amount"];
                $nulljournal["id"] =$pax;
                $nulljournal["amount"] =$journal["amount"];
                $nulljournal["paxid"] =$journal["paxid"];
                $nulljournal["commisionamount"] =$salescommission;
                $nulljournal["expense"] =null;
            }
            $expenseData[] = $nulljournal;
            $salescommission = 0;
        }
        $nulljournal["id"] ="null";
        $nulljournal["amount"] =$totalpayable;
        $nulljournal["paxid"] ="Total";
        $nulljournal["commisionamount"] =$totalcommission;
        $expenseData[]=$nulljournal;

        return Response::json($expenseData);
    }
    public function store(Request $request)
    {
        $validationdata = [
            'sector_id' => 'required',
            'recruit_id.*' => 'required',
        ];
        if($request->bill_format=="0")
        {
            $validationdata["account_id"] = "required";
            $validationdata["date"] = "required";
            $validationdata["paid_through_id"] = "required";
            $validationdata["amount"] = "required";
        }
        if($request->bill_format=="1")
        {
            $validationdata["account"] = "required";
            $validationdata["com_date"] = "required";
            $validationdata["com_amount"] = "required";

        }
        $this->validate($request,$validationdata );
        DB::beginTransaction();
       try{

          $ResponseExpense=new ResponseExpense();
          $salescommisson_id = $ResponseExpense->salesComission($request);

          $recruit =  new RecruitExpense();
          $recruit->expenseSectorid =$request->sector_id;
          $recruit->sales_commission_id = $salescommisson_id;
          if ($request->hasFile('img_url'))
          {
            $file= $request->img_url;

            $fileName=uniqid(). '.' .$file->getClientOriginalName();
            $file->move(public_path('all_image'), $fileName);
            $recruit->img_url = $fileName;

          }

          if($recruit->save())
          {
              if($request->bill_format=="0")
              {
              $ResponseExpense->expenseEntries($request,$recruit->id);
              }
              foreach($request->recruit_id as $value)
              {
                  $pax  = new RecruiteExpensePax();

                  $pax->recruitExpenseid = $recruit->id;
                  $pax->paxid = $value? $value:null ;

                  $pax->save();
              }

              DB::commit();
              return redirect()
                  ->route('order_expense_accounts')
                  ->with('alert.status', 'success')
                  ->with('alert.message', 'Expense data inserted successfully.');
          }
      }catch(\Illuminate\Database\QueryException $e){


          DB::rollback();

          return redirect()
              ->route('order_expense_accounts')
              ->with('alert.status', 'danger')
              ->with('alert.message', 'Expense data inserted failed.');
      }catch(\Exception $exception){
          DB::rollback();
          return redirect()
              ->route('order_expense_accounts')
              ->with('alert.status', 'danger')
              ->with('alert.message', 'Expense data inserted failed.');
      }
    }

    public function recruitExpenseApi(Request $request)
    {
        if(!isset($request->id)){
            return [];
        }
        $data = [];
        $null=[];
        $recruit = RecruitExpense::find($request->id);
        foreach($recruit->paxid as $value){
            $null["id"] = $value->id;
            $null["title"] = $value->paxid;
            $null["url"] = route("customer_dashboard",$value->paxid);
            $data[] = $null;
        }
        return response($data);
    }

    public function edit($id)
    {

        try{
            $recruit = RecruitExpense::find($id);
            $sec_id = $recruit["expenseSectorid"];

            $expence_account=Account::all();
            $paid_through=Account::where('account_type_id',4)
                ->orWhere('account_type_id',5)
                ->groupBy('account_type_id')
                ->get();
            $account = Account::whereIn('account_type_id',[4,5])->get();
            $type=null;
            $vendor=Contact::all();
            $sector = ExpenseSector::all();
             $expense=Expense::where('id',$recruit->expense_id)->first();
            $sales_commission = SalesComission::find($recruit->sales_commission_id);
            if($sales_commission)
            {
            $type = "salescommission";
            }

            if($expense)
            {
            $type = "expense";
            }
            $selected_pax = $recruit->paxId->pluck('id');
            $selected_pax = $selected_pax->all();


            return view('order::expense.edit', compact('selected_pax','type','sector','recruit','expence_account','paid_through','vendor','expense','account'));
        }catch(\Exception $exception){

          return back()->with('alert.status', 'danger')
              ->with('alert.message', 'not found.');;
        }

    }


    public function update(Request $request, $id)
    {

        $validationdata = [
            'sector_id' => 'required',
        ];
        if($request->recruite_expense_type=="expense")
        {
            $validationdata["account_id"] = "required";
            $validationdata["date"] = "required";
            $validationdata["paid_through_id"] = "required";
            $validationdata["amount"] = "required";
        }
        if($request->recruite_expense_type=="salescommission")
        {
            $validationdata["account"] = "required";
            $validationdata["com_date"] = "required";
            $validationdata["com_amount"] = "required";

        }
        $this->validate($request,$validationdata );
        try{

            $ResponseExpense=new ResponseExpense();
            DB::beginTransaction();
            $recruit =  RecruitExpense::find($id);
            $recruit->expenseSectorid =$request->sector_id;
            if ($request->hasFile('img_url'))
            {
            $file= $request->img_url;
            $fileName=uniqid(). '.' .$file->getClientOriginalName();
            $file->move(public_path('all_image'), $fileName);
            $recruit->img_url = $fileName;
            }
            if($recruit->save())
            {
              $delete=RecruiteExpensePax::where('recruitExpenseid',$id);
              $delete->delete();
              foreach($request->pax_id as $value)
             {
                    $pax  = new RecruiteExpensePax();
                    $pax->recruitExpenseid = $recruit->id;
                    $pax->paxid = $value?$value:null ;
                    $pax->save();
             }
                if($request->recruite_expense_type=="expense")
                {
                    $ResponseExpense->expenseEntriesUpdate($request,$recruit);
                }
                if($request->recruite_expense_type=="salescommission")
                {
                    $ResponseExpense->salesComissionUpdate($request,$recruit);
                }


                DB::commit();
                return redirect()
                    ->route('order_expense_accounts')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'saved.');
            }
        }catch(\Illuminate\Database\QueryException $e){
            DB::rollback();

            return redirect()
                ->route('order_expense_accounts')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'not saved.');
        }catch(\Exception $e){
            DB::rollback();

            return redirect()
                ->route('order_expense_accounts')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'not saved.');
        }

    }


    public function destroy($id,$ex=null)
    {
        DB::beginTransaction();

          try{
              $category = RecruitExpense::find($id);
              if($category->expense_id == null && $category->sales_commission_id==null)
              {
                  if($category->delete())
                  {
                      $delete=RecruiteExpensePax::where('recruitExpenseid',$id)->delete();
                      DB::commit();
                      return redirect()
                          ->route('order_expense_accounts')
                          ->with('alert.status', 'success')
                          ->with('alert.message', 'Recruit Expense  deleted successfully!');
                  }
                  else
                  {
                      throw new \Exception();
                  }
              }
              else
              {
                  throw new \Exception();
              }
            }catch(\Exception $exception){
              DB::rollback();
              return back()->with(['alert.status' => 'danger' , 'alert.message' => 'Delete failed! Because expense/commission exists.']);
           }
     }

   public function expense($id,$ex=null)
   {

       if(is_null($ex))
       {

           $customers = Contact::all();
           $accounts = Account::all();
           $paid_throughs = Account::where('account_type_id',4)->get();
           return view('order::mainexpense.create', compact('customers', 'accounts', 'taxes', 'paid_throughs','id'));
       }
       else
       {
//           $expense = Expense::find($ex);
//           $customers = Contact::all();
//           $accounts = Account::all();
//           $paid_throughs = Account::where('account_type_id',4)->get();

           return redirect()->route('expense_show', ['id' => $ex]);
           //  return view('expense::expense.edit', compact('customers', 'accounts', 'taxes', 'paid_throughs','expense'));
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
   public function storeExpense(Request $request,$id)
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

       $expense = new Expense;
       $expense->date              = $data['expense_date'];
       $expense->amount            = round($data['amount'], 2);
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

       if($expense->save())
       {
           $expense = Expense::orderBy('created_at', 'desc')->first();
           $expense_id = $expense['id'];


           $status = $this->insertExpenseInJournal($total_tax, $data['amount'], $data, $expense_id);
           if($status)
           {
             $rec=  RecruitExpense::find($id);
             $rec->expense_id = $expense_id;
             if($rec->save()){
                 return redirect()
                     ->route('order_expense_accounts')
                     ->with('alert.status', 'success')
                     ->with('alert.message', 'Expense added successfully!');
             }else{
                 $expense = Expense::find($expense_id);
                 $expense->delete();
                 {
                     return redirect()
                         ->route('order_expense_accounts')
                         ->with('alert.status', 'danger')
                         ->with('alert.message', 'Something went to wrong! Please check your input field');
                 }
             }

           }
           else
           {
               $expense = Expense::find($expense_id);
               $expense->delete();
               {
                   return redirect()
                       ->route('order_expense_accounts')
                       ->with('alert.status', 'danger')
                       ->with('alert.message', 'Something went to wrong! Please check your input field');
               }
           }

       }
   }
}
