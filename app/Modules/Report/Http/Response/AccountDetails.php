<?php
/**
 * Created by PhpStorm.
 * User: ontik
 * Date: 12/26/2017
 * Time: 10:23 AM
 */

namespace App\Modules\Report\Http\Response;


use App\Models\AccountChart\Account;
use Illuminate\Support\Facades\DB;

class AccountDetails
{

    protected $start = null;
    protected $end = null;
    protected $sum =  0;
    protected $id = null;
    protected $group = null;
    protected $type= null;
    public function __construct($start=null,$end=null,$id,$group,$type=null)
    {
        //default set
        $this->start = date("Y-m-d");
        $this->end = date("Y-m-d");
        //set by user

        $this->group = $group;
        $this->type = $type;
        $this->id = $id;
        $this->start = isset($start)?$start:$this->start;
        $this->end = isset($end)?$end:$this->end;
    }
    public function accountName()
    {
      $name = Account::find($this->id);

      return $name;
    }
    public function findById($id=null)
    {
      $data = [];
      $validgroup = array("visa_processing_expense","visa_processing_income","visa_expense","indirect_expense","indirect_income","direct_expense","direct_income","visa_income");
      if(!in_array($this->group,$validgroup))
      {
          return $data;
      }
      //after validate
      if($this->group=="visa_income")
      {
         $data = $this->companyVisaIncome($id,0);
      }
      if($this->group=="visa_processing_income")
      {
         $data = $this->companyVisaIncome($id,1);
      }
      if($this->group=="visa_expense")
      {
        $data = $this->companyVisaExpense(0);
      }
      if($this->group=="visa_processing_expense")
      {
        $data = $this->companyVisaExpense(1);
      }
      if($this->group=="direct_income")
      {
        $data = $this->directIncome($id);
      }
      if($this->group=="direct_expense")
      {
        $data = $this->directExpense($id);
      }
      if($this->group=="indirect_income")
      {
            $data = $this->indirectIncome($id);
      }
      if($this->group=="indirect_expense")
      {

            $data = $this->indirectExpense($id);
      }
      return $data;
    }

    public function companyVisaIncome($id=null,$type=0)
    {
        $data = [];
        if(!is_null($id) && is_numeric($id))
        {
            $this->id = $id;
        }
        try{
            $data = DB::select( DB::raw("SELECT 'INV' as type, invoices.id as id , invoices.invoice_number as serial_number,sum(invoice_entries.amount) as amount from invoice_entries JOIN recruitingorder ON recruitingorder.invoice_id = invoice_entries.invoice_id JOIN invoices ON invoices.id = invoice_entries.invoice_id WHERE recruitingorder.visa_type='$type' AND invoice_entries.account_id='$this->id' AND (STR_TO_DATE(invoices.invoice_date,'%d-%m-%Y') BETWEEN '$this->start' AND '$this->end') GROUP By invoice_entries.invoice_id"));
            $data = json_decode(json_encode((array) $data), true);
            return $data;
        }catch (\Exception $exception){
            return $data;
        }

    }

    public function companyVisaExpense($type=0,$id=null)
    {
        $mergedata = [];
        $account = [];
        $data = [];
        if(!is_null($id) && is_numeric($id))
        {
            $this->id = $id;
        }

        try{
           $account_id =trim($this->id,'"');
           $start =trim($this->start,'"');
           $end =trim($this->end,'"');
           $account = DB::select( DB::raw("SELECT 'BILL' as type,bill.id as id, bill.bill_number as serial_number,SUM(bill_entry.amount) as amount from bill_entry JOIN account ON account.id = bill_entry.account_id JOIN recruitingorder ON recruitingorder.bill_id = bill_entry.bill_id JOIN bill ON bill.id = bill_entry.bill_id WHERE recruitingorder.visa_type='$type' AND bill_entry.account_id = '$account_id' AND (bill.bill_date BETWEEN '$start' AND '$end') GROUP BY bill_entry.bill_id"));
           $data = DB::select( DB::raw("SELECT 'EXP' as type,expense.id as id,expense.expense_number as serial_number , SUM( DISTINCT expense.amount) as amount from expense JOIN recruiteexpense ON expense.id = recruiteexpense.expense_id JOIN account ON account.id = expense.account_id JOIN recruiteexpensepax ON recruiteexpensepax.recruitExpenseid = recruiteexpense.id JOIN recruitingorder ON recruiteexpensepax.paxid = recruitingorder.id WHERE recruitingorder.visa_type='$type' AND account.id = '$this->id' AND (expense.date BETWEEN '$this->start' AND '$this->end') GROUP BY expense.id"));
           $mergedata = array_merge($data,$account);
           $mergedata = json_decode(json_encode((array) $mergedata), true);
           return $mergedata;
        }catch (\Exception $exception){
         return $mergedata;
        }

    }

    public function directIncome($id=0)
    {
        $account_id =trim($this->id,'"');
        $start =trim($this->start,'"');
        $end =trim($this->end,'"');
        $data = [];
        try{
            $account = DB::select( DB::raw("SELECT * from journal_entries where (journal_entries.assign_date BETWEEN '$start' AND '$end') AND journal_entries.account_name_id = '$account_id' and (journal_entries.invoice_id NOT IN(SELECT recruitingorder.invoice_id FROM recruitingorder WHERE recruitingorder.invoice_id IS NOT NULL) or journal_entries.invoice_id is null)"));
            $data = json_decode(json_encode((array) $account), true);
            return $data;
        }catch (\Exception $exception){
            return $data;
        }


    }
    public function directExpense($id=0)
    {
        $account_id =trim($this->id,'"');
        $start =trim($this->start,'"');
        $end =trim($this->end,'"');
        $data = [];
        try{
            $account = DB::select( DB::raw("SELECT * from journal_entries where (journal_entries.assign_date BETWEEN '$start' AND '$end') AND journal_entries.account_name_id = '$account_id' and (journal_entries.invoice_id NOT IN(SELECT recruitingorder.invoice_id FROM recruitingorder WHERE recruitingorder.invoice_id IS NOT NULL) or journal_entries.invoice_id is null)"));
            $data = json_decode(json_encode((array) $account), true);
            return $data;
        }catch (\Exception $exception){
            return $data;
        }


    }

    public function indirectIncome($id=0)
    {
        $account_id =trim($this->id,'"');
        $start =trim($this->start,'"');
        $end =trim($this->end,'"');
        $data = [];
        try{
           $account = DB::select( DB::raw("SELECT * from journal_entries WHERE (journal_entries.assign_date BETWEEN '$start' AND '$end') AND journal_entries.account_name_id = '$account_id'"));
           $data = json_decode(json_encode((array) $account), true);
           return $data;
        }catch (\Exception $exception){

            return $data;
        }
    }
    public function indirectExpense($id=0)
    {
        $account_id =trim($this->id,'"');
        $start =trim($this->start,'"');
        $end =trim($this->end,'"');
        $data = [];
        try{

            if($this->type==19){

                $account_19 = DB::select( DB::raw("SELECT * from journal_entries WHERE (journal_entries.assign_date BETWEEN '$start' AND '$end') AND journal_entries.account_name_id = '$account_id'"));
                $account_19 = json_decode(json_encode((array) $account_19), true);
                return $account_19;
            }

            if($this->type==17) {

                $account_17 = DB::select(DB::raw("SELECT * from journal_entries where (journal_entries.assign_date BETWEEN '$start' AND '$end') AND journal_entries.account_name_id = '$account_id' and (journal_entries.expense_id NOT IN(SELECT recruiteexpense.expense_id FROM recruiteexpense WHERE recruiteexpense.expense_id IS NOT NULL) or journal_entries.expense_id is null)"));
                $account_17 = json_decode(json_encode((array)$account_17), true);
                return $account_17;

            }
            return $data;
        }catch (\Exception $exception){

            return $data;
        }
    }



}