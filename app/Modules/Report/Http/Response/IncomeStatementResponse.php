<?php
/**
 * Created by PhpStorm.
 * User: ontik
 * Date: 12/23/2017
 * Time: 10:19 AM
 */

namespace App\Modules\Report\Http\Response;


use Illuminate\Support\Facades\DB;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class IncomeStatementResponse
{
   protected $start = null;
   protected $end = null;
   protected $sum =  0;
   protected $groupdata = [];
   public function __construct($start=null,$end=null)
   {
     //default set
     $this->start = date("Y-m-d");
     $this->end = date("Y-m-d");
     //set by user
     $this->start = isset($start)?$start:$this->start;
     $this->end = isset($end)?$end:$this->end;
   }

    function traverseArray($array)
    {

        foreach($array as $key=>$value)
        {
            if(is_array($value))
            {
              if(array_key_exists("amount",$value))
              {
               $this->sum +=$value["amount"];
              }
             $this->traverseArray($value);
            }
        }
      return $this->sum;
    }

    public function all()
    {
        $datalist= [];
        $datalist["visa_income"] = $this->companyVisaIncome(0);
        $datalist["visa_processing_income"] = $this->companyVisaIncome(1);
        $datalist["visa_expense"] = $this->companyVisaExpense(0);

        $datalist["visa_processing_expense"] = $this->companyVisaExpense(1);
        $datalist["visa_total_amount"] = $this->traverseArray($datalist);
        $this->sum = 0;
        $datalist["gross_profit_1"] = $this->traverseArray($datalist["visa_income"]);
        $this->sum = 0;
        $datalist["gross_profit_2"] = $this->traverseArray($datalist["visa_expense"]);
        $this->sum = 0;

        $datalist["gross_profit_3"] = $this->traverseArray($datalist["visa_processing_income"]);
        $this->sum = 0;
        $datalist["gross_profit_4"] = $this->traverseArray($datalist["visa_processing_expense"]);
        $this->sum = 0;
        $datalist["direct_income"] = $this->directIncomeExpense(15);
        $datalist["direct_income_debit"] = array_sum(array_column($datalist["direct_income"],'debit'));
        $datalist["direct_income_credit"] = array_sum(array_column($datalist["direct_income"],'credit'));
        $this->sum = 0;
        $datalist["direct_expense"] = $this->directIncomeExpense(18);
        $datalist["direct_expense_debit"] = array_sum(array_column($datalist["direct_expense"],'debit'));
        $datalist["direct_expense_credit"] = array_sum(array_column($datalist["direct_expense"],'credit'));
        $datalist["indirect_income"] = $this->indirectIncome(16);
        $datalist["indirect_income_debit"] = array_sum(array_column($datalist["indirect_income"],'debit'));
        $datalist["indirect_income_credit"] = array_sum(array_column($datalist["indirect_income"],'credit'));
        $datalist["indirect_expense_17"] = $this->indirectExpense(17);
        $datalist["indirect_expense_debit_17"] = array_sum(array_column($datalist["indirect_expense_17"],'debit'));
        $datalist["indirect_expense_credit_17"] = array_sum(array_column($datalist["indirect_expense_17"],'credit'));

        $datalist["indirect_expense_19"] = $this->indirectExpense(19);
        $datalist["indirect_expense_debit_19"] = array_sum(array_column($datalist["indirect_expense_19"],'debit'));
        $datalist["indirect_expense_credit_19"] = array_sum(array_column($datalist["indirect_expense_19"],'credit'));
        return $datalist;
    }

    public function companyVisaIncome($type=0)
    {
      $data = [];

     try{
         $data = DB::select( DB::raw("SELECT account.id as id, account.account_name as account_name,SUM(invoice_entries.amount) as amount from invoice_entries JOIN account ON account.id = invoice_entries.account_id JOIN recruitingorder ON recruitingorder.invoice_id = invoice_entries.invoice_id JOIN invoices ON invoices.id = invoice_entries.invoice_id WHERE recruitingorder.visa_type='$type' AND (STR_TO_DATE(invoices.invoice_date,'%d-%m-%Y') BETWEEN '$this->start' AND '$this->end') GROUP BY invoice_entries.account_id"));
         $data = json_decode(json_encode((array) $data), true);
         return $data;
     }catch (\Exception $exception){
         return $data;
     }

    }

    public function companyVisaExpense($type=0)
    {
        $mergedata = [];
        $account = [];

        try{
           $account = DB::select( DB::raw("SELECT account.id as id, GROUP_CONCAT(DISTINCT bill_entry.bill_id) as bill_id,account.account_name as account_name,SUM(bill_entry.amount) as amount from bill_entry JOIN account ON account.id = bill_entry.account_id JOIN recruitingorder ON recruitingorder.bill_id = bill_entry.bill_id JOIN bill ON bill.id = bill_entry.bill_id WHERE recruitingorder.visa_type='$type' AND (bill.bill_date BETWEEN '$this->start' AND '$this->end') GROUP BY bill_entry.account_id"));

           $data = DB::select( DB::raw("SELECT account.id as id,GROUP_CONCAT( DISTINCT expense.id) as expense_id ,account.account_name as account_name, SUM( DISTINCT expense.amount) as amount from expense JOIN recruiteexpense ON expense.id = recruiteexpense.expense_id JOIN account ON account.id = expense.account_id JOIN recruiteexpensepax ON recruiteexpensepax.recruitExpenseid = recruiteexpense.id JOIN recruitingorder ON recruiteexpensepax.paxid = recruitingorder.id WHERE recruitingorder.visa_type='$type' AND (expense.date BETWEEN '$this->start' AND '$this->end') GROUP BY expense.account_id"));

           $mergedata = array_merge($data,$account);
           $mergedata = json_decode(json_encode((array) $mergedata), true);
           $mergedata = $this->groupByAccount($mergedata);

           return $mergedata;
        }catch (\Exception $exception){

            return $mergedata;
        }

    }
    public function directIncomeExpense($type=0)
    {
        $data = [];
        try{
            if($type==15){
                $account = DB::select( DB::raw("SELECT account.id as id, account.account_name ,(SELECT SUM(journal_entries.amount) FROM journal_entries WHERE (journal_entries.assign_date BETWEEN '$this->start' AND '$this->end') AND journal_entries.debit_credit=0  AND journal_entries.account_name_id = account.id AND (journal_entries.invoice_id NOT IN(SELECT recruitingorder.invoice_id FROM recruitingorder WHERE recruitingorder.invoice_id IS NOT NULL) OR journal_entries.invoice_id is null )) as credit,(SELECT SUM(journal_entries.amount) FROM journal_entries WHERE (journal_entries.assign_date BETWEEN '$this->start' AND '$this->end') AND journal_entries.debit_credit=1 AND journal_entries.account_name_id = account.id AND (journal_entries.invoice_id NOT IN(SELECT recruitingorder.invoice_id FROM recruitingorder WHERE recruitingorder.invoice_id IS NOT NULL) OR journal_entries.invoice_id is null )) as debit FROM `account` WHERE account.account_type_id = '$type'"));
                $data = json_decode(json_encode((array) $account), true);
            }

            if($type==18){
                $account = DB::select( DB::raw("SELECT account.id as id, account.account_name ,(SELECT SUM(journal_entries.amount) FROM journal_entries WHERE (journal_entries.assign_date BETWEEN '$this->start' AND '$this->end') AND journal_entries.debit_credit=0 AND journal_entries.bill_id IS NOT NULL AND journal_entries.account_name_id = account.id AND (journal_entries.bill_id  NOT IN(SELECT recruitingorder.bill_id  FROM recruitingorder WHERE recruitingorder.bill_id  IS NOT NULL) OR journal_entries.bill_id is null)) as credit,(SELECT SUM(journal_entries.amount) FROM journal_entries WHERE (journal_entries.assign_date BETWEEN '$this->start' AND '$this->end') AND journal_entries.debit_credit=1 AND journal_entries.bill_id  IS NOT NULL AND journal_entries.account_name_id = account.id AND (journal_entries.bill_id  NOT IN(SELECT recruitingorder.bill_id  FROM recruitingorder WHERE recruitingorder.bill_id  IS NOT NULL) OR journal_entries.bill_id is null)) as debit FROM `account` WHERE account.account_type_id = '$type'"));
                $data = json_decode(json_encode((array) $account), true);
            }

            return $data;
        }catch (\Exception $exception){

            return $data;
        }


    }
    public function indirectIncome($type=0)
    {
        $data = [];
        try{
            if($type==0)
            {
                return $data;
            }
            if($type==16)
            {
                $account = DB::select( DB::raw("SELECT account.id as id, account.account_name as account_name , (SELECT SUM(journal_entries.amount) FROM journal_entries WHERE journal_entries.debit_credit=0 AND journal_entries.account_name_id = account.id AND (journal_entries.assign_date BETWEEN '$this->start' AND '$this->end')) as credit,(SELECT SUM(journal_entries.amount) FROM journal_entries WHERE journal_entries.debit_credit=1 AND journal_entries.account_name_id = account.id AND (journal_entries.assign_date BETWEEN '$this->start' AND '$this->end')) as debit from account WHERE account.account_type_id = 16"));
                $data = json_decode(json_encode((array) $account), true);
            }
            return $data;
        }catch (\Exception $exception){

            return $data;
        }
    }
    public function indirectExpense($type=0)
    {
        $data = [];
        try{
            if($type==17){
                $account_17 = DB::select( DB::raw("SELECT account.id as id, account.account_name ,(SELECT SUM(journal_entries.amount) FROM journal_entries WHERE (journal_entries.assign_date BETWEEN '$this->start' AND '$this->end') AND journal_entries.debit_credit=0 AND journal_entries.expense_id IS NOT NULL AND journal_entries.account_name_id = account.id AND (journal_entries.expense_id NOT IN(SELECT recruiteexpense.expense_id FROM recruiteexpense WHERE recruiteexpense.expense_id IS NOT NULL) OR journal_entries.expense_id is null)) as credit,(SELECT SUM(journal_entries.amount) FROM journal_entries WHERE (journal_entries.assign_date BETWEEN '$this->start' AND '$this->end') AND journal_entries.debit_credit=1 AND journal_entries.expense_id IS NOT NULL AND journal_entries.account_name_id = account.id AND (journal_entries.expense_id NOT IN(SELECT recruiteexpense.expense_id FROM recruiteexpense WHERE recruiteexpense.expense_id IS NOT NULL) OR journal_entries.expense_id is null)) as debit FROM `account` WHERE account.account_type_id = 17"));
                $data_17 = json_decode(json_encode((array) $account_17), true);
                return $data_17;
            }
            if($type==19){
                $account_19 = DB::select( DB::raw("SELECT account.id as id, account.account_name as account_name , (SELECT SUM(journal_entries.amount) FROM journal_entries WHERE journal_entries.debit_credit=0 AND journal_entries.account_name_id = account.id AND (journal_entries.assign_date BETWEEN '$this->start' AND '$this->end')) as credit,(SELECT SUM(journal_entries.amount) FROM journal_entries WHERE journal_entries.debit_credit=1 AND journal_entries.account_name_id = account.id AND (journal_entries.assign_date BETWEEN '$this->start' AND '$this->end')) as debit from account WHERE account.account_type_id = 19"));
                $data_19 = json_decode(json_encode((array) $account_19), true);
                return $data_19;
            }
           return $data;
        }catch(\Exception $exception){
            return $data;
        }

    }
    public function groupByAccount($data){
        $tmp = [];
        try{

            foreach($data as $arg)
            {
                $tmp[$arg["account_name"]][] = $arg;
            }


            $output = array();

            foreach($tmp as $type => $labels)
            {
                if(is_array($labels))
                {
                    $output[] = array(
                        'account_name' => $type,
                        'id' => $labels[0]["id"],
                        'amount' =>array_sum(array_column($labels,'amount')),
                        'expense_id' =>array_column($labels,'expense_id'),
                        'bill_id' =>array_column($labels,'bill_id'),
                    );
                }

            }
            return $output;
        }catch (\Exception $exception){
           return $data;
        }

    }


}
