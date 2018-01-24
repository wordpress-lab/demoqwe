<?php

namespace App\Modules\Income\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use App\Models\Moneyin\Income;

class IncomeApiController extends Controller
{
    public function getIncomeContactAccountTaxName($income_d)
    {
        $item = DB::table('item')->select('item_name as text', 'id as value')->get();
        $account = DB::table('account')->select('account_name as text', 'id as value')->get();
        $contact = DB::table('contact')->select('display_name as text', 'id as value')->get();
        $tax = DB::table('tax')->select('tax_name as text', 'id as value')->get();
        $account = DB::table('account')->select('account_name as text', 'id as value')->get();
        $income = Income::find($income_d);
        $account_id = Income::find($income_d)->receive_through_id;
        $paid_throughs  = DB::table('account')->select('account_name as text', 'id as value')
            ->whereIn('account_type_id',[4,5])->get();

        return response()->json([
            'item'   =>  $item,
            'account'   =>  $account,
            'contact'   =>  $contact,
            'tax'       =>  $tax,
            'account'   =>  $account,
            'income'   =>  $income,
            'paid_throughs'     =>  $paid_throughs,
            'account_id'        =>  $account_id,
        ], 201);
    }
}
