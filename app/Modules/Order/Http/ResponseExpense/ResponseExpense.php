<?php

namespace App\Modules\Order\Http\ResponseExpense;
use App\Models\ManualJournal\JournalEntry;
use App\Models\MoneyOut\Expense;
use App\Models\Recruit\RecruitExpense;
use App\Models\Setting\SalesComission;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: ontik
 * Date: 11/4/2017
 * Time: 2:29 PM
 */
class ResponseExpense
{

    public function expenseEntries($request,$id){

        $expense=Expense::count();
        if($expense>0)
        {
            $expense = Expense::all()->last()->expense_number;
            $expense_number = $expense + 1;
        }
        else
        {
            $expense_number = 1;
        }

        $expense_number = str_pad($expense_number, 6, '0', STR_PAD_LEFT);
        $expense=new Expense();
        $expense->date=date("Y-m-d",strtotime($request->date));
        $expense->amount=$request->amount;
        $expense->paid_through_id=$request->paid_through_id;
        $expense->tax_total=$request->tax_total;
        $expense->reference=$request->reference;
        $expense->note=' ';
        $expense->account_id=$request->account_id;
        $expense->vendor_id=$request->agent_name_id;
        $expense->tax_id=1;
        $expense->tax_type=1;
        $expense->created_by= Auth::user()->id;
        $expense->updated_by= Auth::user()->id;
        $expense->expense_number= $expense_number;
        $expense->save();
        if ($expense){

            $recruitExpense=RecruitExpense::find($id);
            $recruitExpense->expense_id=$expense->id;
            $recruitExpense->save();
        }

        if ($expense){

            $journal_Entry=new JournalEntry();
            $journal_Entry->debit_credit=0;
            $journal_Entry->amount=$request->amount;
            $journal_Entry->account_name_id=$request->paid_through_id;
            $journal_Entry->jurnal_type='expense';
            $journal_Entry->expense_id=$expense->id;
            $journal_Entry->contact_id=$request->agent_name_id;
            $journal_Entry->assign_date=$request->date;
            $journal_Entry->created_by=Auth::user()->id;
            $journal_Entry->updated_by=Auth::user()->id;
            $journal_Entry->save();


            $journal_Entry=new JournalEntry();
            $journal_Entry->debit_credit=1;
            $journal_Entry->amount=$request->amount;
            $journal_Entry->account_name_id=$request->account_id;
            $journal_Entry->jurnal_type='expense';
            $journal_Entry->expense_id=$expense->id;
            $journal_Entry->contact_id=$request->agent_name_id;
            $journal_Entry->assign_date=$request->date;
            $journal_Entry->created_by=Auth::user()->id;
            $journal_Entry->updated_by=Auth::user()->id;
            $journal_Entry->save();

            $journal_Entry=new JournalEntry();
            $journal_Entry->debit_credit=1;
            $journal_Entry->amount=0;
            $journal_Entry->account_name_id=9;
            $journal_Entry->jurnal_type='expense';
            $journal_Entry->expense_id=$expense->id;
            $journal_Entry->contact_id=$request->agent_name_id;
            $journal_Entry->assign_date=$request->date;
            $journal_Entry->created_by=Auth::user()->id;
            $journal_Entry->updated_by=Auth::user()->id;
            $journal_Entry->save();
        }

    }
    public function expenseEntriesUpdate($request,$recruite){

        $recruite->expense->update(
            [
                "date"=>$request->date,
                "amount"=>$request->amount,
                "paid_through_id"=>$request->paid_through_id,
                "tax_total"=>$request->tax_total,
                "reference"=>$request->reference,
                "account_id"=>$request->account_id,
                "updated_by"=>Auth::user()->id,
            ]
        );


        if($recruite)
        {
            $exp_id=$recruite->expense->id;

            JournalEntry::where("expense_id",$exp_id)->delete();
            $journal_Entry=new JournalEntry();
            $journal_Entry->debit_credit=0;
            $journal_Entry->amount=$request->amount;
            $journal_Entry->account_name_id=$request->paid_through_id;
            $journal_Entry->jurnal_type='expense';
            $journal_Entry->expense_id=$exp_id;

            $journal_Entry->assign_date=$request->date;
            $journal_Entry->created_by=Auth::user()->id;
            $journal_Entry->updated_by=Auth::user()->id;
            $journal_Entry->save();


            $journal_Entry=new JournalEntry();
            $journal_Entry->debit_credit=1;
            $journal_Entry->amount=$request->amount;
            $journal_Entry->account_name_id=$request->account_id;
            $journal_Entry->jurnal_type='expense';
            $journal_Entry->expense_id=$exp_id;

            $journal_Entry->assign_date=$request->date;
            $journal_Entry->created_by=Auth::user()->id;
            $journal_Entry->updated_by=Auth::user()->id;
            $journal_Entry->save();

            $journal_Entry=new JournalEntry();
            $journal_Entry->debit_credit=1;
            $journal_Entry->amount=0;
            $journal_Entry->account_name_id=9;
            $journal_Entry->jurnal_type='expense';
            $journal_Entry->expense_id=$exp_id;

            $journal_Entry->assign_date=$request->date;
            $journal_Entry->created_by=Auth::user()->id;
            $journal_Entry->updated_by=Auth::user()->id;
            $journal_Entry->save();
        }

    }
    public function salesComission($request)
    {
        if($request->bill_format!="1")
        {
            return null;
        }
        $number  = new \stdClass();
        $number->id = 1;
        $number_new=DB::table('salescommisions')->max('scNumber');
        $number = $number_new?++$number_new:$number->id;
        $scnumber = $number;
        $comission = new SalesComission();
        $comission->agents_id = $request->agent_name_id;
        $comission->date = date("Y-m-d",strtotime($request->com_date));
        $comission->scNumber = $scnumber;
        $comission->bank_info = $request->bankinfo;
        $comission->show = $request->show?"on":null;
        $comission->amount = $request->com_amount;
        $comission->PersonalNote = $request->PersonalNote;
        $comission->CustomerNote = $request->CustomerNote;
        $comission->paid_through_id = $request->account;
        $comission->created_by = Auth::id();
        $comission->updated_by  = Auth::id();

        if($comission->save())
        {


            //$journal = JournalEntry::where('account_name_id',$comission->paid_through_id)->where('agent_id',$comission->agents_id)->first();

            $newjournal = new JournalEntry();
            $newjournal->debit_credit = 0;
            $newjournal->amount = $comission->amount;
            $newjournal->account_name_id = $comission->paid_through_id;
            $newjournal->jurnal_type = "sales_commission";
            $newjournal->salesComission_id = $comission->id;
            $newjournal->agent_id = $comission->agents_id;
            $newjournal->created_by = Auth::id();
            $newjournal->updated_by = Auth::id();
            $newjournal->assign_date = date('Y-m-d', strtotime($request->com_date));
            $newjournal->save();

            $newjournal2 = new JournalEntry();
            $newjournal2->debit_credit = 1;
            $newjournal2->amount = $comission->amount;
            $newjournal2->account_name_id = 11;
            $newjournal2->jurnal_type = "sales_commission";
            $newjournal2->salesComission_id = $comission->id;
            $newjournal2->agent_id = $comission->agents_id;
            $newjournal2->created_by = Auth::id();
            $newjournal2->updated_by = Auth::id();
            $newjournal2->assign_date = date('Y-m-d', strtotime($request->com_date));
            $newjournal2->save();

            if($newjournal2)
            {
                return $comission["id"];
            }else{
                throw new \Exception();
            }

        }

        return null;

    }
    public function salesComissionUpdate($request,$recruite)
    {

        $recruite->salesCommission->update(
            [
                "date"=>date("Y-m-d",strtotime($request->com_date)),
                "bank_info"=>$request->bankinfo,
                "show"=>$request->show?"on":null,
                "amount"=>$request->com_amount,
                "PersonalNote"=>trim($request->PersonalNote),
                "CustomerNote"=>trim($request->CustomerNote),
                "paid_through_id"=>$request->account,
                "updated_by"=>Auth::user()->id,
            ]
        );


        if($recruite)
        {

            $salesid= $recruite->salesCommission->id;
            //$journal = JournalEntry::where('account_name_id',$comission->paid_through_id)->where('agent_id',$comission->agents_id)->first();
            JournalEntry::where("salesComission_id",$salesid)->delete();
            $newjournal = new JournalEntry();
            $newjournal->debit_credit = 0;
            $newjournal->amount = $request->com_amount;
            $newjournal->account_name_id = $request->account;
            $newjournal->jurnal_type = "sales_commission";
            $newjournal->salesComission_id = $salesid;
            $newjournal->agent_id = $request->agent_name_id;
            $newjournal->created_by = Auth::id();
            $newjournal->updated_by = Auth::id();
            $newjournal->assign_date = date('Y-m-d', strtotime($request->com_date));
            $newjournal->save();

            $newjournal2 = new JournalEntry();
            $newjournal2->debit_credit = 1;
            $newjournal2->amount = $request->com_amount;
            $newjournal2->account_name_id = 11;
            $newjournal2->jurnal_type = "sales_commission";
            $newjournal2->salesComission_id = $salesid;
            $newjournal2->agent_id = $request->agent_name_id;
            $newjournal2->created_by = Auth::id();
            $newjournal2->updated_by = Auth::id();
            $newjournal2->assign_date = date('Y-m-d', strtotime($request->com_date));
            $newjournal2->save();

            if($newjournal2)
            {
                return $salesid;
            }else{
                throw new \Exception();
            }

        }

        return null;

    }

}