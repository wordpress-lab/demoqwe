<?php

namespace App\Modules\Settings\Http\Controllers\Balance;

use App\Models\AccountChart\Account;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Setting\Openingbalance;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class OpeningBalanceController extends Controller
{


    public function index(Request $request)
    {
      try{
          $balance = Openingbalance::find(1);
          if(!$balance){
              $balance= new Openingbalance();
              $balance->id= 1;
              $balance->openningBalanceDate= date('Y-m-d');
              $balance->created_by = auth::id();
              $balance->updated_by = auth::id();
              $balance->save();
          }
          $journal_count = JournalEntry::where('jurnal_type','opening_balance')->count();
          if($journal_count==0)
          {
              return redirect()->route('setting_openingbalance_create')->with('alert.status', 'warning')
                  ->with('alert.message', 'No account found');
          }
          $account = Account::all();
          if($journal_count==0){
              foreach($account as $value)
              {
                  $journal = new JournalEntry();
                  $journal->amount =  0;
                  $journal->account_name_id = $value->id;
                  $journal->jurnal_type = "opening_balance";
                  $journal->created_by = auth::id();
                  $journal->updated_by = auth::id();
                  $journal->debit_credit = 0;
                  $journal->save();
              }
          }
          $journal_up_new = JournalEntry::where('jurnal_type','opening_balance')->get();
          $journal_up = $journal_up_new->filter(function ($value, $key) {
              return $value->account_name_id!=7;
          });
          $adjustment =  $journal_up_new->filter(function ($value, $key) {
              return $value->account_name_id==7;
          });
          $adjustment_id = 7;
          $adjustment_amount=0;
          $adjustment_debit_credit=0;
          foreach ($adjustment as $value)
          {
              $adjustment_id = $value->id;
              $adjustment_amount = $value->amount;
              $adjustment_debit_credit = $value->debit_credit;

          }
          // $account=$filtered->all($filtered);
          return view('settings::Balance.OpeningBalance.index',compact('journal_up','adjustment_id','adjustment_amount','adjustment_debit_credit','balance'));
      }catch(\Illuminate\Database\QueryException $ex)
      {
          return back()->with('alert.status', 'warning')->with('alert.message', 'Openening Balance not found!');
      }

    }

    public function edit(Request $request,$id)
    {
        $balance = Openingbalance::find(1);
        $balance->openningBalanceDate =$request->balance_date;
        $balance->save();

        $input = $request->except(['balance_date','_token']);

       foreach ($input as $key=>$value)
       {
          $account = explode('_',$key);
          $mid= $account[0];
          if($mid)
          {
              $journal = JournalEntry::find($mid);


              $journal->amount =  $value?$value:0;
              $journal->updated_by = auth::id();
              if($account[1]=="crt" && !empty($value))
              {

                  $journal->debit_credit = 0;
                  $journal->save();
              }
              if($account[1]=="dbt" && !empty($value))
              {

                  $journal->debit_credit = 1;
                  $journal->save();
              }



          }



        }

       return back();
       // dd($request->all());
    }

    public function store(Request $request)
    {

        $balance = Openingbalance::find(1);
        $balance->openningBalanceDate = $request->balance_date;
        $balance->save();
        $input = $request->except(['balance_date', '_token']);
        foreach ($input as $key => $value)
        {
            $account = explode('_', $key);
            $mid = $account[0];
            if($mid)
            {
                $journal = new JournalEntry();
                $journal->amount =  $value?$value:0;
                $journal->account_name_id = $mid;
                $journal->jurnal_type = "opening_balance";
                $journal->created_by = auth::id();
                $journal->updated_by = auth::id();

                if($account[1]=="crt" && !empty($value))
                {
                    $journal->debit_credit = 0;
                    $journal->save();
                }
                if($account[1]=="dbt" && !empty($value))
                {
                    $journal->debit_credit = 1;
                    $journal->save();
                }
            }


        }
        //end foreach
        return Redirect::route('setting_openingbalance')->with('alert.status', 'success')
            ->with('alert.message', 'ok!');
    }
    public function create()
    {
        $journal_count = JournalEntry::where('jurnal_type','opening_balance')->count();
       if($journal_count>0)
       {
           return Redirect::route('setting_openingbalance')->with('alert.status', 'warning')
               ->with('alert.message', 'Delete First!');
       }

        $balance = Openingbalance::find(1);
        if(!$balance){
            $balance= new Openingbalance();
            $balance->id= 1;
            $balance->openningBalanceDate= date('Y-m-d');
            $balance->created_by = auth::id();
            $balance->updated_by = auth::id();
            $balance->save();
        }


        $account = Account::all();

        $journal_up = $account->filter(function ($value, $key) {
            return $value->id!=7;
        });



        return view('settings::Balance.OpeningBalance.create',compact('journal_up','balance'));

    }

    public function delete()
    {

        JournalEntry::where('jurnal_type','opening_balance')->delete();

        return redirect()->route('setting_openingbalance_create')->with('alert.status', 'danger')
            ->with('alert.message', 'Deleted !');
    }
}
