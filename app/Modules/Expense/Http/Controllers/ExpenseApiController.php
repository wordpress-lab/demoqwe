<?php

namespace App\Modules\Expense\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

use App\Models\Contact\Contact;
use App\Models\Contact\ContactCategory;
use App\Models\ManualJournal\Journal;
use App\Models\ManualJournal\JournalEntry;
use App\Models\MoneyOut\Expense;

class ExpenseApiController extends Controller
{
    public function getExpenseContactAccountTaxName($expense_d)
    {
        $item = DB::table('item')->select('item_name as text', 'id as value')->get();
        $account = DB::table('account')->select('account_name as text', 'id as value')->get();
        $contact = DB::table('contact')->select('display_name as text', 'id as value')->get();
        $tax = DB::table('tax')->select('tax_name as text', 'id as value')->get();
        $account = DB::table('account')->select('account_name as text', 'id as value')->get();
        $expense = Expense::find($expense_d);
        $account_id = Expense::find($expense_d)->paid_through_id;
        $paid_throughs  = DB::table('account')->select('account_name as text', 'id as value')
            ->whereIn('account_type_id',[4,5])->orderBy('account_name','asc')->get();

        return response()->json([
            'item'              =>  $item,
            'account'           =>  $account,
            'contact'           =>  $contact,
            'tax'               =>  $tax,
            'account'           =>  $account,
            'expense'           =>  $expense,
            'paid_throughs'     =>  $paid_throughs,
            'account_id'        =>  $account_id,
        ], 201);
    }
}
