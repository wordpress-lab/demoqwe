<?php
/**
 * Created by PhpStorm.
 * User: ontik
 * Date: 12/11/2017
 * Time: 10:52 AM
 */

namespace App\Modules\Report\Http\Response;


use Illuminate\Support\Facades\DB;

class GeneralLedgerResponse
{

  public function All($end,$start=null)
  {
      try{
          $input_to_date = date("Y-m-d",strtotime($end));
          $data = DB::select( DB::raw("SELECT account.id as id, account.account_name as account_name, (SELECT SUM(journal_entries.amount) from journal_entries where journal_entries.account_name_id = account.id  AND journal_entries.debit_credit =0 AND journal_entries.assign_date<='$input_to_date') as debit ,(SELECT SUM(journal_entries.amount) from journal_entries where journal_entries.account_name_id = account.id  AND journal_entries.debit_credit =1 AND journal_entries.assign_date<='$input_to_date') as credit   FROM `account` ORDER BY `debit`  DESC"));
          return response($data);
      }catch(\Exception $exception){
       return [];
      }

  }
}