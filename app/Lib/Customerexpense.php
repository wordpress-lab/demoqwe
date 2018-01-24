<?php
/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 18-07-17
 * Time: 17.34
 */

namespace App\Lib;


use App\Models\Recruit\RecruiteExpensePax;

class Customerexpense
{


  public function RecruitExpense($id)
  {
     return RecruiteExpensePax::where('recruitExpenseid',$id)->count();
  }

  public function var2($id,$pax_id)
  {
      return RecruiteExpensePax::where('recruitExpenseid',$id)->where('paxid',$pax_id)->count();
  }


}