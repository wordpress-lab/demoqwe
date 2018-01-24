<?php

namespace App\Modules\Customer\Http\Controllers\account;

use App\Lib\Customerexpense;
use App\Lib\Helpers;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Recruit\RecruiteExpensePax;
use App\Models\Recruit\RecruitExpense;
use App\Models\Recruit\Recruitorder;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class WebController extends Controller
{


  public function index($id)
  {
      $Rorder=Recruitorder::where('paxid',$id)->first();
      $payment_entry= PaymentReceiveEntryModel::where('invoice_id',$Rorder->invoice_id)->get();
      $totalamount = Invoice::find($Rorder->invoice_id);
      $recruitexpensepax = RecruiteExpensePax::where('paxid',$Rorder->id)->get();
      $recruitexpensepax = $recruitexpensepax->unique('recruitExpenseid');
      return view('customer::account.index',compact('id','payment_entry','totalamount','recruitexpensepax'));
  }
}
