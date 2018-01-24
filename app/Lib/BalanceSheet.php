<?php
/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 07-08-17
 * Time: 17.43
 */

namespace App\Lib;


use App\Models\ManualJournal\JournalEntry;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class BalanceSheet
{

  protected $start = null;
  protected $end = null;
 public function setDate($start,$end)
 {
     $this->start = date('Y-m-d',strtotime($start.'-1 day'));

     $this->end = date('Y-m-d',strtotime($end.'+1 day'));


 }

    public function current_asset()
  {

      $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
          ->select( DB::raw('account.id'))
          ->where('account.account_type_id',2)
          ->groupBy('journal_entries.account_name_id')
          ->get();

      $assets = [];
      $account_name= '';
      foreach ($accounts as $key=>$item){
          $debit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
              ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
              ->where('journal_entries.account_name_id',$item->id)
              ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
              ->where('journal_entries.debit_credit',1)
              ->groupBy('journal_entries.account_name_id')
              ->first();

          $credit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
              ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
              ->where('journal_entries.account_name_id',$item->id)
              ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
              ->where('journal_entries.debit_credit',0)
              ->groupBy('journal_entries.account_name_id')
              ->first();
          if(isset($credit->account_name)){
              $account_name = $credit->account_name;
          }elseif(isset($debit->account_name)){
              $account_name = $debit->account_name;
          }
          if(isset($credit->total)){
              $credit = $credit->total;

          }else{
              $credit = 0;
          }
          if(isset($debit->total)){
              $debit = $debit->total;

          }else{
              $debit = 0;
          }
          $total = $debit-$credit;

          if(!is_null($total) && !empty($total) ){
              $assets[$key]['name'] = $account_name;
              $assets[$key]['total'] = $total;
          }
      }



      return $assets;

  }

    public function others_asset()
    {

        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
            ->select( DB::raw('account.id'))
            ->where('account.account_type_id',1)
            ->groupBy('journal_entries.account_name_id')
            ->get();

        $assets = [];
        $account_name= '';
        foreach ($accounts as $key=>$item){
            $debit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',1)
                ->groupBy('journal_entries.account_name_id')
                ->first();

            $credit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',0)
                ->groupBy('journal_entries.account_name_id')
                ->first();
            if(isset($credit->account_name)){
                $account_name = $credit->account_name;
            }elseif(isset($debit->account_name)){
                $account_name = $debit->account_name;
            }
            if(isset($credit->total)){
                $credit = $credit->total;

            }else{
                $credit = 0;
            }
            if(isset($debit->total)){
                $debit = $debit->total;

            }else{
                $debit = 0;
            }
            $total = $debit-$credit;

            if(!is_null($total) && !empty($total) ){
                $assets[$key]['name'] = $account_name;
                $assets[$key]['total'] = $total;
            }
        }



        return $assets;

    }

    public function others_current_asset()
    {


        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
            ->select( DB::raw('account.id'))
            ->where('account.account_type_id',3)
            ->groupBy('journal_entries.account_name_id')
            ->get();

        $assets = [];
        $account_name= '';
        foreach ($accounts as $key=>$item){
            $debit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',1)
                ->groupBy('journal_entries.account_name_id')
                ->first();

            $credit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',0)
                ->groupBy('journal_entries.account_name_id')
                ->first();
            if(isset($credit->account_name)){
                $account_name = $credit->account_name;
            }elseif(isset($debit->account_name)){
                $account_name = $debit->account_name;
            }
            if(isset($credit->total)){
                $credit = $credit->total;

            }else{
                $credit = 0;
            }
            if(isset($debit->total)){
                $debit = $debit->total;

            }else{
                $debit = 0;
            }
            $total = $debit-$credit;

            if(!is_null($total) && !empty($total) ){
                $assets[$key]['name'] = $account_name;
                $assets[$key]['total'] = $total;
            }
        }




        return $assets;

    }
    public function cash()
    {


        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
            ->select( DB::raw('account.id'))
            ->where('account.account_type_id',4)
            ->groupBy('journal_entries.account_name_id')
            ->get();

        $assets = [];
        $account_name= '';
        foreach ($accounts as $key=>$item){
            $debit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',1)
                ->groupBy('journal_entries.account_name_id')
                ->first();

            $credit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',0)
                ->groupBy('journal_entries.account_name_id')
                ->first();

            if(isset($credit->account_name)){
                $account_name = $credit->account_name;
            }elseif(isset($debit->account_name)){
                $account_name = $debit->account_name;
            }
            if(isset($credit->total)){
                $credit = $credit->total;

            }else{
                $credit = 0;
            }
            if(isset($debit->total)){
                $debit = $debit->total;

            }else{
                $debit = 0;
            }
            $total = $debit-$credit;


           if(!is_null($total) && !empty($total) ){
               $assets[$key]['name'] = $account_name;
               $assets[$key]['total'] = $total;
           }




        }



       return $assets;

    }
    public function bank()
    {


        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
            ->select( DB::raw('account.id'))
            ->where('account.account_type_id',5)
            ->groupBy('journal_entries.account_name_id')
            ->get();

        $assets = [];
        $account_name= '';
        foreach ($accounts as $key=>$item){
            $debit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',1)
                ->groupBy('journal_entries.account_name_id')
                ->first();

            $credit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',0)
                ->groupBy('journal_entries.account_name_id')
                ->first();
            if(isset($credit->account_name)){
                $account_name = $credit->account_name;
            }elseif(isset($debit->account_name)){
                $account_name = $debit->account_name;
            }
            if(isset($credit->total)){
                $credit = $credit->total;

            }else{
                $credit = 0;
            }
            if(isset($debit->total)){
                $debit = $debit->total;

            }else{
                $debit = 0;
            }
            $total = $debit-$credit;


            if(!is_null($total) && !empty($total) ){
                $assets[$key]['name'] = $account_name;
                $assets[$key]['total'] = $total;
            }
        }

        return $assets;
    }
    public function stock()
    {


        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
            ->select( DB::raw('account.id'))
            ->where('account.account_type_id',7)
            ->groupBy('journal_entries.account_name_id')
            ->get();

        $assets = [];
        $account_name= '';
        foreach ($accounts as $key=>$item){
            $debit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',1)
                ->groupBy('journal_entries.account_name_id')
                ->first();

            $credit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',0)
                ->groupBy('journal_entries.account_name_id')
                ->first();
            if(isset($credit->account_name)){
                $account_name = $credit->account_name;
            }elseif(isset($debit->account_name)){
                $account_name = $debit->account_name;
            }
            if(isset($credit->total)){
                $credit = $credit->total;

            }else{
                $credit = 0;
            }
            if(isset($debit->total)){
                $debit = $debit->total;

            }else{
                $debit = 0;
            }
            $total = $debit-$credit;

            if(!is_null($total) && !empty($total) ){
                $assets[$key]['name'] = $account_name;
                $assets[$key]['total'] = $total;
            }
        }

        return $assets;
    }
    public function FixedAsset()
    {


        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
            ->select( DB::raw('account.id'))
            ->where('account.account_type_id',6)
            ->groupBy('journal_entries.account_name_id')
            ->get();

        $assets = [];
        $account_name= '';
        foreach ($accounts as $key=>$item){
            $debit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',1)
                ->groupBy('journal_entries.account_name_id')
                ->first();

            $credit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',0)
                ->groupBy('journal_entries.account_name_id')
                ->first();
            if(isset($credit->account_name)){
                $account_name = $credit->account_name;
            }elseif(isset($debit->account_name)){
                $account_name = $debit->account_name;
            }
            if(isset($credit->total)){
                $credit = $credit->total;

            }else{
                $credit = 0;
            }
            if(isset($debit->total)){
                $debit = $debit->total;

            }else{
                $debit = 0;
            }
            $total = $debit-$credit;

            if(!is_null($total) && !empty($total) ){
                $assets[$key]['name'] = $account_name;
                $assets[$key]['total'] = $total;
            }
        }

        return $assets;

    }
    public function currentLibilities()
    {


        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
            ->select( DB::raw('account.id'))
            ->whereIn('account.account_type_id',array(9,10,12,13))
            ->groupBy('journal_entries.account_name_id')
            ->get();

        $assets = [];
        $account_name= '';
        foreach ($accounts as $key=>$item){
            $debit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',0)
                ->groupBy('journal_entries.account_name_id')
                ->first();

            $credit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',1)
                ->groupBy('journal_entries.account_name_id')
                ->first();
            if(isset($credit->account_name)){
                $account_name = $credit->account_name;
            }elseif(isset($debit->account_name)){
                $account_name = $debit->account_name;
            }
            if(isset($credit->total)){
                $credit = $credit->total;

            }else{
                $credit = 0;
            }
            if(isset($debit->total)){
                $debit = $debit->total;

            }else{
                $debit = 0;
            }
            $total = $debit-$credit;

            if(!is_null($total) && !empty($total) ){
                $assets[$key]['name'] = $account_name;
                $assets[$key]['total'] = $total;
            }
        }

        return $assets;

    }
    public function longTermLibilities()
    {
        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
            ->select( DB::raw('account.id'))
            ->where('account.account_type_id',11)
            ->groupBy('journal_entries.account_name_id')
            ->get();

        $assets = [];
        $account_name= '';
        foreach ($accounts as $key=>$item){
            $debit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',0)
                ->groupBy('journal_entries.account_name_id')
                ->first();

            $credit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',1)
                ->groupBy('journal_entries.account_name_id')
                ->first();
            if(isset($credit->account_name)){
                $account_name = $credit->account_name;
            }elseif(isset($debit->account_name)){
                $account_name = $debit->account_name;
            }
            if(isset($credit->total)){
                $credit = $credit->total;

            }else{
                $credit = 0;
            }
            if(isset($debit->total)){
                $debit = $debit->total;

            }else{
                $debit = 0;
            }
            $total = $debit-$credit;

            if(!is_null($total) && !empty($total) ){
                $assets[$key]['name'] = $account_name;
                $assets[$key]['total'] = $total;
            }
        }

        return $assets;

    }
    public function currentYearEarning()
    {

        $accounts = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
            ->select( DB::raw('account.id'))
            ->where('account.account_type_id',14)
            ->groupBy('journal_entries.account_name_id')
            ->get();

        $assets = [];
        $account_name= '';
        foreach ($accounts as $key=>$item){
            $debit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',0)
                ->groupBy('journal_entries.account_name_id')
                ->first();

            $credit = JournalEntry::join('account', 'account.id', '=', 'journal_entries.account_name_id')
                ->select( DB::raw("sum(journal_entries.amount) as total,account.account_name"))
                ->where('journal_entries.account_name_id',$item->id)
                ->whereBetween('journal_entries.assign_date',array($this->start,$this->end))
                ->where('journal_entries.debit_credit',1)
                ->groupBy('journal_entries.account_name_id')
                ->first();
            if(isset($credit->account_name)){
                $account_name = $credit->account_name;
            }elseif(isset($debit->account_name)){
                $account_name = $debit->account_name;
            }
            if(isset($credit->total)){
                $credit = $credit->total;

            }else{
                $credit = 0;
            }
            if(isset($debit->total)){
                $debit = $debit->total;

            }else{
                $debit = 0;
            }
            $total = $debit-$credit;

            if(!is_null($total) && !empty($total) ){
                $assets[$key]['name'] = $account_name;
                $assets[$key]['total'] = $total;
            }
        }

        return $assets;
    }

}