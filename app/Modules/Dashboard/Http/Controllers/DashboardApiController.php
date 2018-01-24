<?php

namespace App\Modules\Dashboard\Http\Controllers;

use App\Models\Deshboard\Reminder;
use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\MoneyOut\Bill;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashboardApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function overDueReceivable()
    {
        $Invoice_condition = "CURDATE() + 0 >= STR_TO_DATE(payment_date, '%d-%m-%Y')+0";
        $overdue_receivable = Invoice::whereRaw($Invoice_condition)->select("due_amount","id","payment_date","invoice_number")->where('due_amount','!=',0)->get();

        return response($overdue_receivable);
     }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function overDueReceivableInvoiceShow($id=null)
    {
        if(is_null($id) || empty($id)){
            abort(404);
        }

      return redirect()->route("invoice_show",$id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function reOrder()
    {

        $item = [];
        $item = DB::select(DB::raw("SELECT item.item_name as item,((select sum(total) from `stock` WHERE stock.item_id = item.id) - (select sum(quantity) from `invoice_entries` WHERE invoice_entries.item_id = item.id)) as instock,item.id as id, IF(`reorder_point` IS NULL or `reorder_point` = '', '0', `reorder_point`) as `reorder_point` from item ORDER BY `instock` DESC") );
        foreach($item as $key=>$value)
        {
            if($value->instock <= $value->reorder_point || $value->reorder_point==0)
            {
                $reorder[$value->id][] = $value->instock;
                $reorder[$value->id][] = $value->item;
            }
        }
        return response($reorder);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function overduePayable()
    {
        $overdue_payable = Bill::where('due_date','<=',date('Y-m-d'))->where('due_amount','!=',0)->get();

        return response($overdue_payable);
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
