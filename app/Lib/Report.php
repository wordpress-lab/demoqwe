<?php
/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 27-07-17
 * Time: 18.44
 */

namespace App\Lib;


use App\Models\AccountChart\Account;
use App\Models\Contact\Contact;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Setting\SalesComission;

class Report
{
      public $OperatingincomeTotal = null;
      public $CostofGoodTotal = null;
      public $OperatingExpense = null;
      public $nonoperatingix = null;
      public $start = null;
      public $end = null;

      public function definedate($start,$end)
      {
        $this->start = date('Y-m-d',strtotime($start));
        $this->end = date('Y-m-d',strtotime($end));



      }

      public function InvoiceCount($id)
      {
           return JournalEntry::where('agent_id',$id)->whereNotNull('invoice_id')->count();
      }
      public function InvoiceAmount($id)
      {
          $sum = 0;
          $invoice=JournalEntry::where('agent_id',$id)->whereNotNull('invoice_id')->get();
          foreach ($invoice as $value){
              $sum= $sum+ $value->invoice->total_amount;
          }

          return $sum;
      }

      public function payable($journal){



              $comiss = 0;
              if($journal->commission_type==1){

                  $comiss+=($journal->total_amount*$journal->agentcommissionAmount)/100;
              }elseif($journal->commission_type==2){
                  $comiss+=$journal->agentcommissionAmount;
              }
              return $comiss;


          return $comiss;
      }
      public function Paid($id,$start,$end)
      {
          $pay=SalesComission::where('agents_id',$id)->whereBetween('date',array($start, $end))->sum('amount');
           return $pay;
      }

      public function Customer($id)
      {
        return Contact::find($id)['display_name'];
      }

      public function OperatingincomeTotal($id)
      {
        if(is_null($this->start) && is_null($this->end)){
            $debt= JournalEntry::where('account_name_id',$id)->where('debit_credit',0)->whereYear('assign_date',date('Y'))->sum('amount');
            $crt= JournalEntry::where('account_name_id',$id)->where('debit_credit',1)->whereYear('assign_date',date('Y'))->sum('amount');
            $total = (int)$debt-$crt;
            $this->OperatingincomeTotal = $this->OperatingincomeTotal+$total;
            return $total;
        }else{
            $debt= JournalEntry::where('account_name_id',$id)->where('debit_credit',0)->whereBetween('assign_date',array($this->start,$this->end))->sum('amount');
            $crt= JournalEntry::where('account_name_id',$id)->where('debit_credit',1)->whereBetween('assign_date',array($this->start,$this->end))->sum('amount');
            $total = (double)$debt-$crt;
            $this->OperatingincomeTotal = $this->OperatingincomeTotal+$total;
            return $total;
        }

      }

      public function TotalOperatingincome()
      {
         return $this->OperatingincomeTotal;
      }

    public function CostofGoodTotal($id)
    {
        if(is_null($this->start) && is_null($this->end)) {
            $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereYear('assign_date', date('Y'))->sum('amount');
            $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereYear('assign_date', date('Y'))->sum('amount');
            $total = (double)$debt - $crt;

            $this->CostofGoodTotal = $this->CostofGoodTotal + $total;
            return $total;
        }else{
            $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereBetween('assign_date',array($this->start,$this->end))->sum('amount');
            $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereBetween('assign_date',array($this->start,$this->end))->sum('amount');
            $total = (double)$debt - $crt;

            $this->CostofGoodTotal = $this->CostofGoodTotal + $total;
            return $total;
        }
    }

    public function TotalCostofGood()
    {
        return $this->CostofGoodTotal;
    }

    public function OperatingExpenseTotal($id)
    {
        if(is_null($this->start) && is_null($this->end)) {
            $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereYear('assign_date', date('Y'))->sum('amount');
            $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereYear('assign_date', date('Y'))->sum('amount');
            $total = (double)$debt - $crt;

            $this->OperatingExpense = $this->OperatingExpense + $total;
            return $total;
        }else{
            $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereBetween('assign_date',array($this->start,$this->end))->sum('amount');
            $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereBetween('assign_date',array($this->start,$this->end))->sum('amount');
            $total = (double)$debt - $crt;

            $this->OperatingExpense = $this->OperatingExpense + $total;
            return $total;
        }
    }

    public function TotalOperatingExpense()
    {
        return $this->OperatingExpense;
    }


    public function nonoperatingixTotal($id)
    {
        if(is_null($this->start) && is_null($this->end)) {
            $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereYear('assign_date', date('Y'))->sum('amount');
            $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereYear('assign_date', date('Y'))->sum('amount');
            $total = (double)$debt - $crt;

            $this->nonoperatingix = $this->nonoperatingix + $total;
            return $total;
        }else{
            $debt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 0)->whereBetween('assign_date',array($this->start,$this->end))->sum('amount');
            $crt = JournalEntry::where('account_name_id', $id)->where('debit_credit', 1)->whereBetween('assign_date',array($this->start,$this->end))->sum('amount');
            $total = (double)$debt - $crt;

            $this->nonoperatingix = $this->nonoperatingix + $total;
            return $total;
        }
    }

    public function Totalnonoperatingix()
    {
        return $this->nonoperatingix;
    }



    public function netprofit()
    {
        $operatingincome = Account::where('account_type_id', 15)->get();
        foreach ($operatingincome as $item) {
            $this->OperatingincomeTotal($item->id);
        }

        $costofgoods = Account::where('account_type_id', 18)->get();
        foreach ($costofgoods as $item) {
            $this->CostofGoodTotal($item->id);
        }

        $operatingExpense = Account::where('account_type_id', 17)->get();
        foreach ($operatingExpense as $item) {
            $this->OperatingExpenseTotal($item->id);
        }

        $nonoperatingix = Account::whereIn('account_type_id', array(16, 19))->get();
        foreach ($nonoperatingix as $item)
        {
            $this->nonoperatingixTotal($item->id);
        }



        return $this->TotalOperatingincome()-$this->TotalCostofGood()-$this->TotalOperatingExpense()-$this->Totalnonoperatingix() ;
    }





}