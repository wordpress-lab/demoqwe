<?php

namespace App\Modules\Dashboard\Http\Controllers;

use App\Lib\Concatenote;
use App\Models\Bank\Bank;
use App\Models\Deshboard\Reminder;
use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\MoneyOut\Bill;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $nextdatetime = Carbon::today()->addYear(2);
        $nextreminder  =  Reminder::whereBetween('reminddatetime',array(Carbon::tomorrow(),$nextdatetime))->get();
        $todayreminder  =  Reminder::whereDate('reminddatetime',date('Y-m-d'))->get();

        $today = date('Y-m-d');
        $total_receivale = Invoice::sum('due_amount');
        $total_invoice= Invoice::where('due_amount','!=',0)->count();
        $total_payable = Bill::sum('due_amount');
        $total_bill = Bill::where('due_amount','!=',0)->count();
        $todayincome =   DB::table('journal_entries') ->join('account', 'journal_entries.account_name_id', '=', 'account.id')->whereDate('journal_entries.assign_date',date('Y-m-d'))->where('journal_entries.debit_credit',1)->where('account.account_type_id',4)->sum('journal_entries.amount');
        $todayexpense =   DB::table('journal_entries') ->join('account', 'journal_entries.account_name_id', '=', 'account.id')->whereDate('journal_entries.assign_date',date('Y-m-d'))->where('journal_entries.debit_credit',0)->where('account.account_type_id',4)->sum('journal_entries.amount');
        $cash_in_hand =   DB::table('journal_entries') ->join('account', 'journal_entries.account_name_id', '=', 'account.id')->where('journal_entries.debit_credit',0)->where('account.account_type_id',4)->sum('journal_entries.amount');
        $total_minus =   DB::table('journal_entries') ->join('account', 'journal_entries.account_name_id', '=', 'account.id')->where('journal_entries.debit_credit',1)->where('account.account_type_id',4)->sum('journal_entries.amount');
        $cash_in_hand = $total_minus-$cash_in_hand;


        $today_stock = Stock::whereDate('created_at',date('Y-m-d'))->groupBy('item_id')->selectRaw('*, sum(total) as sum')->get();

        $today_out_stock =  InvoiceEntry::whereDate('created_at',date('Y-m-d'))->groupBy('item_id')->selectRaw('*, sum(quantity) as sum')->get();
        $total_deposit = JournalEntry::whereDate('journal_entries.assign_date',date('Y-m-d'))->join('account','journal_entries.account_name_id','=','account.id')->where('account.account_type_id',5)->where('journal_entries.debit_credit',1)->sum('journal_entries.amount');
        $total_withdraw = JournalEntry::whereDate('journal_entries.assign_date',date('Y-m-d'))->join('account','journal_entries.account_name_id','=','account.id')->where('account.account_type_id',5)->where('journal_entries.debit_credit',0)->sum('journal_entries.amount');
        $reorder = [];
        return view('dashboard::index',compact('todayreminder','nextreminder','total_receivale','total_invoice','total_payable','total_bill','todayincome','todayexpense','cash_in_hand','total_deposit','today_stock','total_withdraw','today_out_stock','reorder'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function todayreminder()
    {
        $todayreminder  =  Reminder::whereDate('reminddatetime',date('Y-m-d'))->get();

       $con =  new Concatenote();
       echo $con->todaynote($todayreminder);



        return json_encode($todayreminder );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reOrder()
    {
        $reorder = [];

        $in_stock = Stock::groupBy('item_id')->selectRaw('*, sum(total) as sum')->get();
        $out_stock =  InvoiceEntry::groupBy('item_id')->selectRaw('*, sum(quantity) as sum')->get();

        $item = Item::all();

        foreach ($item as $value){
            $new_in_stock = $in_stock->where('item_id', $value->id)->first();
            $new_out_stock = $out_stock->where('item_id', $value->id)->first();
            if(isset($new_in_stock) && isset($new_out_stock)){


                $after_minus = $new_in_stock->sum-$new_out_stock->sum;
                if($after_minus)
                {
                    if($after_minus<=$value->reorder_point|| empty($value->reorder_point)){
                        $reorder[$value->id][] =  $after_minus;
                        $reorder[$value->id][] =  $value->item_name;
                    }
                }
            }

        }

        //return response($reorder);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
