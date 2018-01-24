<?php
/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 05-08-17
 * Time: 16.31
 */

namespace App\Lib;


use App\Models\Contact\Contact;
use App\Models\ManualJournal\JournalEntry;

class BankReport
{

  protected $totaldeposit = null;
  protected $totalwithdraw = null;
  protected $start = null;
  protected $end = null;

  public function setDate($start=null,$end=null)
  {
   $this->start =   $start;
   $this->end =   date('Y-m-d', strtotime($end . ' +1 day'));
  }

  public function deposit($account_id=null)
  {
      if(is_null($account_id)){
          return 0;
      }
     $dep = JournalEntry::where('debit_credit',1)->where('account_name_id',$account_id)->whereBetween('assign_date',array($this->start,$this->end))->sum('amount');
     return $dep;
  }
    public function deposit_openning_balance($account_id=null)
    {
        if(is_null($account_id)){
            return 0;
        }


        $dep = JournalEntry::where('debit_credit',1)->where('account_name_id',$account_id)->whereDate('assign_date','<',$this->start)->sum('amount');
        return $dep;
    }

    public function withdraw($account_id=null)
    {
        if(is_null($account_id)){
            return 0;
        }
        $withdraw =JournalEntry::where('debit_credit',0)->where('account_name_id',$account_id)->whereBetween('assign_date',array($this->start,$this->end))->sum('amount');
        return $withdraw;
    }
    public function withdraw_openning_balance($account_id=null)
    {
        if(is_null($account_id)){
            return 0;
        }
        $withdraw =JournalEntry::where('debit_credit',0)->where('account_name_id',$account_id)->whereDate('assign_date','<',$this->start)->sum('amount');
        return $withdraw;
    }
    public function contact($id= null)
    {
       $name= Contact::where('account_id',$id)->first();
       $name = isset($name->display_name)?$name->display_name:'No Name';
       return $name;
    }
}