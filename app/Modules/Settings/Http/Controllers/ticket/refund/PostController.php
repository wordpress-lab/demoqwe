<?php

namespace App\Modules\Settings\Http\Controllers\ticket\refund;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Models
use App\Models\Contact\Contact;
use App\Models\Inventory\Item;
use App\Models\Ticket\TicketRefund;

use App\Modules\Settings\Http\Response\Order;


class PostController extends Controller
{
    public function index()
    {
        $refund = TicketRefund::latest()->get();

        return view('settings::ticket.refund.index' , compact('refund'));
    }

    public function create()
    {
        $contact = Contact::all();
        $item = Item::all();
        $date = date('Y-m-d');

        return view('settings::ticket.refund.create' , compact('contact','item','date'));
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $inputdata =[
            'contact_id' => 'required',
            'vendor_id' => 'required',
            'issuDate' => 'required',
        ];
        if(isset($request->check_invoice))
        {
            $inputdata['invoice_qty'] =  "required";
            $inputdata['invoice_rate'] =  "required";
        }
        if(isset($request->check_bill))
        {
            $inputdata['bill_qty'] =  "required";
            $inputdata['bill_rate'] =  "required";
        }
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return Redirect::route('ticket_refund_create')->withErrors($validator)->withInput();
        }

        $receive_date = $request->receive_date;
        $issue_date = $request->issue_date;
        $statement_date = $request->statement_date;

        if($request->receive_date == ""){
            $receive_date = Null;
        }

        if($request->issue_date == ""){
            $issue_date = Null;
        }

        if($request->statement_date == ""){
            $statement_date = Null;
        }

        DB::beginTransaction();
        $ResponseOrder = new Order;

        try {
            $order = new TicketRefund;
            $order->receive_date        = $receive_date;
            $order->issue_date          = $issue_date;
            $order->submit_date         = $request->issuDate;
            $order->first_name          = $request->first_name;
            $order->last_name           = $request->last_name;
            $order->ticket_number       = $request->ticket_number;
            $order->statement_date      = $statement_date;
            $order->refund_sector       = $request->refund_sector;
            $order->customer_id         = $request->vendor_id;
            $order->vendor_id           = $request->contact_id;
            $order->created_by          = Auth::id();
            $order->updated_by          = Auth::id();
            $order->save();
            if($order)
            {
                $new_bill = $ResponseOrder->MakeBill($request,$order->id);
                $order->bill_id = $new_bill['id'];
                      if($new_bill)
                      {
                      $ResponseOrder->BillJournalEntry($new_bill);
                      }
                      $new_invoice = $ResponseOrder->MakeInvoice($request,$order->id);
                      $order->invoice_id = $new_invoice['id'];
                     if($new_invoice)
                     {
                        $ResponseOrder->InvoiceJournalEntry($new_invoice);
                     }
                if(!$order->save())
                {
                    throw new \Exception("Ticket refund not created");
                }
                DB::commit();
                if(isset($request->save))
                {
                    return Redirect::route('ticket_refund_index')->with(['alert.message' => 'Ticket Refund Inserted Successfully','alert.status' => 'success']);
                }

                return Redirect::route('ticket_refund_index')->with(['alert.message' => 'Ticket Refund Inserted Successfully','alert.status' => 'success']);

            }

            throw new \Exception("Ticket refund not created");

        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            DB::rollback();
            $msg = $ex->getMessage();
            return Redirect::route('ticket_refund_create')->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "$msg");
        }
        catch(\Exception $ex){
            
            DB::rollback();
            $msg = $ex->getMessage();
            return Redirect::route('ticket_refund_create')->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "$msg");
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $refund = TicketRefund::find($id);
        $contact = Contact::all();
        $item = Item::all();

        return view('settings::ticket.refund.edit' , compact('contact','item','refund'));
    }

    public function update(Request $request, $id)
    {
        //dd($request->all());
        $inputdata =[
            'contact_id' => 'required',
            'vendor_id' => 'required',
            'issuDate' => 'required',
        ];
        if(isset($request->check_invoice))
        {
            $inputdata['invoice_qty'] =  "required";
            $inputdata['invoice_rate'] =  "required";
        }
        if(isset($request->check_bill))
        {
            $inputdata['bill_qty'] =  "required";
            $inputdata['bill_rate'] =  "required";
        }
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return Redirect::route('ticket_refund_create')->withErrors($validator)->withInput();
        }

        $receive_date = $request->receive_date;
        $issue_date = $request->issue_date;
        $statement_date = $request->statement_date;

        if($request->receive_date == ""){
            $receive_date = Null;
        }

        if($request->issue_date == ""){
            $issue_date = Null;
        }

        if($request->statement_date == ""){
            $statement_date = Null;
        }

        DB::beginTransaction();
        $ResponseOrder = new Order;

        try {
            $order = TicketRefund::find($id);
            //dd($order);
            $order->receive_date        = $receive_date;
            $order->issue_date          = $issue_date;
            $order->submit_date         = $request->issuDate;
            $order->first_name          = $request->first_name;
            $order->last_name           = $request->last_name;
            $order->ticket_number       = $request->ticket_number;
            $order->statement_date      = $statement_date;
            $order->refund_sector       = $request->refund_sector;
            $order->customer_id         = $request->vendor_id;
            $order->vendor_id           = $request->contact_id;
            $order->updated_by          = Auth::id();
            
            if($order->save())
            {
                if(!$order->bill_id){
                    $new_bill = $ResponseOrder->MakeBill($request,$order->id);
                    $order->bill_id = $new_bill['id'];
                    if($new_bill)
                    {
                        $ResponseOrder->BillJournalEntry($new_bill);
                    }
                }

                if(!$order->invoice_id){
                    $new_invoice = $ResponseOrder->MakeInvoice($request,$order->id);
                    $order->invoice_id = $new_invoice['id'];
                    if($new_invoice)
                    {
                        $ResponseOrder->InvoiceJournalEntry($new_invoice);
                    }
                }
                
                
                if(!$order->save())
                {
                    throw new \Exception("Ticket refund not created");
                }

                DB::commit();

                if(isset($request->save))
                {
                    return Redirect::route('ticket_refund_index')->with(['alert.message' => 'Ticket Refund Inserted Successfully','alert.status' => 'success']);
                }

                return Redirect::route('ticket_refund_index')->with(['alert.message' => 'Ticket Refund Updated Successfully','alert.status' => 'success']);

            }

            throw new \Exception("Ticket refund not created");

        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            DB::rollback();
            $msg = $ex->getMessage();
            return Redirect::route('ticket_refund_create')->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "$msg");
        }
        catch(\Exception $ex){
            
            DB::rollback();
            $msg = $ex->getMessage();
            return Redirect::route('ticket_refund_create')->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "$msg");
        }

    }

    public function destroy($id)
    {
        $refund = TicketRefund::find($id);

        if($refund->invoice_id == Null && $refund->bill_id == Null){
            $refund->delete();

            return back()->with(['alert.message' => 'Ticket Refund Deleted Successfully','alert.status' => 'success']);
        }
        else{
            return back()->with(['alert.message' => 'Ticket Refund Deleted Fail!!','alert.status' => 'danger']);
        }
    }
}
