<?php

namespace App\Modules\Settings\Http\Controllers\ticket\refund_others;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Models
use App\Models\Ticket\TicketRefundOthers;
use App\Models\Inventory\Item;
use App\Models\Contact\Contact;

use App\Modules\Settings\Http\Controllers\ticket\refund_others\TicketBillInvoiceController;

class PostController extends Controller
{
    public function index()
    {
        $refund = TicketRefundOthers::latest()->get();

        return view('settings::ticket.refund_others.index' , compact('refund'));
    }

    public function create()
    {
        $item = Item::all();
        //$contact = Contact::where('display_name','IATA')->latest()->first();
        $contact = Contact::all();

        // if(!$contact){
        //     return back()->with(['alert.message' => 'Please add a customer with Display Name = "IATA"','alert.status' => 'danger']);
        // }

        return view('settings::ticket.refund_others.create',compact('item','contact'));
    }

    public function store(Request $request)
    {
        $inputdata =[
            'date' => 'required',
            'adm_fee' => 'required',
            'difference_of_airline_commission' => 'required',
        ];
        
        if(isset($request->check_invoice))
        {
            $inputdata['contact_id'] = "required";
            $inputdata['invoice_particular'] = "required";
            $inputdata['invoice_qty'] =  "required";
            $inputdata['invoice_rate'] =  "required";
        }
        if(isset($request->check_bill))
        {
            $inputdata['vendor_id'] = "required";
            $inputdata['bill_particular'] = "required";
            $inputdata['bill_qty'] =  "required";
            $inputdata['bill_rate'] =  "required";
        }

        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $user_id = Auth::id();
        $input = $request->all();

        DB::beginTransaction();
        $ResponseOrder = new TicketBillInvoiceController;

        try{
            $insert = new TicketRefundOthers;

            $insert->date                               = $input['date'];
            $insert->adm_fee                            = $input['adm_fee'];
            $insert->difference_of_airline_commission   = $input['difference_of_airline_commission'];
            $insert->created_by                         = $user_id;
            $insert->updated_by                         = $user_id;

            $insert->save();

            if($input['adm_fee'] == 0 && $input['difference_of_airline_commission'] == 0){
                return Redirect::route('ticket_refund_others_index')->with(['alert.message' => 'Ticket Refund Others Inserted Successfully','alert.status' => 'success']);
            }

            if($insert)
            {
               
                $new_bill = $ResponseOrder->MakeBill($request,$insert->id);
                $insert->bill_id = $new_bill['id'];
                if($new_bill)
                {
                    $ResponseOrder->BillJournalEntry($new_bill);
                }
            
            
                $new_invoice = $ResponseOrder->MakeInvoice($request,$insert->id);
                $insert->invoice_id = $new_invoice['id'];
                if($new_invoice)
                {
                    $ResponseOrder->InvoiceJournalEntry($new_invoice);
                }
                
                
                if(!$insert->save())
                {
                    throw new \Exception("Ticket refund others not created");
                }

                DB::commit();
                if(isset($request->save))
                {
                    return Redirect::route('ticket_refund_others_index')->with(['alert.message' => 'Ticket Refund Others Inserted Successfully','alert.status' => 'success']);
                }

                return Redirect::route('ticket_refund_others_index')->with(['alert.message' => 'Ticket Refund Others Inserted Successfully','alert.status' => 'success']);

            }

            throw new \Exception("Ticket refund others not created");

        }

        catch(\Illuminate\Database\QueryException $ex)
        {
            DB::rollback();
            $msg = $ex->getMessage();
            return Redirect::route('ticket_refund_others_create')->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "$msg");
        }
        catch(\Exception $ex){
            
            DB::rollback();
            $msg = $ex->getMessage();
            return Redirect::route('ticket_refund_others_create')->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "$msg");
        }
        
        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $refund = TicketRefundOthers::find($id);
        // $contact = Contact::where('display_name','IATA')->latest()->first();

        // if(!$contact){
        //     return back()->with(['alert.message' => 'Please add a customer with Display Name = "IATA"','alert.status' => 'danger']);
        // }

        $contact = Contact::all();
        
        $item = Item::all();

        return view('settings::ticket.refund_others.edit' , compact('refund','item','contact'));
    }

    public function update(Request $request, $id)
    {
        $inputdata =[
            'date' => 'required',
            'adm_fee' => 'required',
            'difference_of_airline_commission' => 'required',
        ];

        if(isset($request->check_invoice))
        {
            $inputdata['contact_id'] = "required";
            $inputdata['invoice_particular'] = "required";
            $inputdata['invoice_qty'] =  "required";
            $inputdata['invoice_rate'] =  "required";
        }
        if(isset($request->check_bill))
        {
            $inputdata['vendor_id'] = "required";
            $inputdata['bill_particular'] = "required";
            $inputdata['bill_qty'] =  "required";
            $inputdata['bill_rate'] =  "required";
        }
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $user_id = Auth::id();
        $input = $request->all();

        DB::beginTransaction();
        $ResponseOrder = new TicketBillInvoiceController;
        
        try{
            $insert = TicketRefundOthers::find($id);

            $insert->date                               = $input['date'];
            $insert->adm_fee                            = $input['adm_fee'];
            $insert->difference_of_airline_commission   = $input['difference_of_airline_commission'];
            $insert->updated_by                         = $user_id;

            if($insert->save())
            {
                if($input['adm_fee'] == 0 && $input['difference_of_airline_commission'] == 0){
                    return Redirect::route('ticket_refund_others_index')->with(['alert.message' => 'Ticket Refund Others Inserted Successfully','alert.status' => 'success']);
                }

                if(!$insert->bill_id){
                    
                        $new_bill = $ResponseOrder->MakeBill($request,$insert->id);
                        $insert->bill_id = $new_bill['id'];
                        if($new_bill)
                        {
                            $ResponseOrder->BillJournalEntry($new_bill);
                        }
                    
                }

                if(!$insert->invoice_id){
                    
                        $new_invoice = $ResponseOrder->MakeInvoice($request,$insert->id);
                        $insert->invoice_id = $new_invoice['id'];
                        if($new_invoice)
                        {
                            $ResponseOrder->InvoiceJournalEntry($new_invoice);
                        }
                    
                }
                
                if(!$insert->save())
                {
                    throw new \Exception("Ticket refund not created");
                }

                DB::commit();

                if(isset($request->save))
                {
                    return Redirect::route('ticket_refund_others_index')->with(['alert.message' => 'Ticket Refund Others Updated Successfully','alert.status' => 'success']);
                }

                return Redirect::route('ticket_refund_others_index')->with(['alert.message' => 'Ticket Refund Others Updated Successfully','alert.status' => 'success']);

            }

            throw new \Exception("Ticket refund not created");

        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            DB::rollback();
            $msg = $ex->getMessage();
            return Redirect::route('ticket_refund_others_index')->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "$msg");
        }
        catch(\Exception $ex){
            
            DB::rollback();
            $msg = $ex->getMessage();
            return Redirect::route('ticket_refund_others_index')->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "$msg");
        }
        
    }

    public function destroy($id)
    {
        $refund = TicketRefundOthers::find($id);

        if($refund->delete()){
            return back()->with(['alert.message' => 'Ticket Refund Others Deleted Successfully','alert.status' => 'success']);
        }
        else{
            return back()->with(['alert.message' => 'Ticket Refund Others Deleted Fail!!','alert.status' => 'danger']);
        }
    }
}
