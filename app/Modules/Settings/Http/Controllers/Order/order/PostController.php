<?php

namespace App\Modules\Settings\Http\Controllers\Order\order;

use App\Lib\FacedeFactory\ArrayRequestFlat;
use App\Models\Branch\Branch;
use App\Models\Contact\Contact;
use App\Models\Contact\ContactCategory;
use App\Models\Email\Email;
use App\Models\Inventory\Item;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Ticket\Ticket_Hotel;
use App\Models\Visa\Ticket\Order\Order;
use App\Models\Visa\Ticket\Order\Ticket_order_tax;
use App\Models\Visa\Ticket\TicketCommission;
use App\Models\Visa\Ticket\TicketTax;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use mPDF;

class PostController extends Controller
{

    public function pending()
    {

        $auth_id = Auth::id();
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $condition = "YEAR(str_to_date(ticketorders.issuDate,'%Y-%m-%d')) = YEAR(CURDATE()) AND (str_to_date(ticketorders.issuDate,'%Y-%m-%d') = CURDATE() || str_to_date(ticketorders.issuDate,'%Y-%m-%d') = DATE_SUB(CURDATE(), INTERVAL 1 DAY))";

        if($branch_id==1)
        {
            $order = Order::orderBy('ticketorders.issuDate','desc')->where('status','=',0)->whereRaw($condition)->get();

            return view('settings::order.order.pending',compact('order','branchs'));
        }
        else
        {
            $order = Order::orderBy('ticketorders.issuDate','desc')->select(DB::raw('ticketorders.*'))->where('status','=',0)
                            ->whereRaw($condition)
                            ->select('ticketorders.*')
                            ->join('users','users.id','=','ticketorders.created_by')
                            ->where('users.branch_id',$branch_id)
                            ->get();



            return view('settings::order.order.pending',compact('order','branchs'));
        }

    }
    public function pending_search(Request $request)
    {
        $branchs = Branch::orderBy('id','asc')->get();
        $branch_id =  $request->branch_id;
        $from_date =  date('Y-m-d',strtotime($request->from_date));
        $to_date =  date('Y-m-d',strtotime($request->to_date));
        $order = [];
        if(session('branch_id')==1)
        {
            $branch_id =  $request->branch_id?$request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id = session('branch_id');
        }

        $condition = "str_to_date(ticketorders.issuDate, '%Y-%m-%d') between '$from_date' and '$to_date'";
       if($branch_id==1)
       {
          $order = Order::orderBy('ticketorders.issuDate','desc')
                            ->select(DB::raw('ticketorders.*'))
                            ->where('status','=',0)
                            ->whereRaw($condition)
                            ->get();

       }
       else
       {
         $order = Order::orderBy('ticketorders.issuDate','desc')
                           ->select(DB::raw('ticketorders.*'))
                           ->where('status','=',0)->whereRaw($condition)
                           ->join('users','users.id','=','ticketorders.created_by')
                           ->where('branch_id',$branch_id)
                           ->get();
       }


        return view('settings::order.order.pending',compact('order','branchs','branch_id','from_date','to_date'));
    }
    public function confirmed()
    {
        $auth_id = Auth::id();
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $condition = "YEAR(str_to_date(ticketorders.issuDate,'%Y-%m-%d')) = YEAR(CURDATE()) AND (str_to_date(ticketorders.issuDate,'%Y-%m-%d') = CURDATE() || str_to_date(ticketorders.issuDate,'%Y-%m-%d') = DATE_SUB(CURDATE(), INTERVAL 1 DAY))";
        if($branch_id==1)
        {
            $order = Order::orderBy('issuDate','desc')->where('status', '=', 1)->whereRaw($condition)->get();
            return view('settings::order.order.confirmed', compact('order', 'branchs'));
        }
        else
        {
            $order = Order::orderBy('issuDate','desc')->select(DB::raw('ticketorders.*'))->where('status','=',1)
                ->whereRaw($condition)
                ->select('ticketorders.*')
                ->join('users','users.id','=','ticketorders.created_by')
                ->where('users.branch_id',$branch_id)
                ->get();
            return view('settings::order.order.confirmed', compact('order', 'branchs'));
        }
    }
    public function confirmed_search(Request $request)
    {
        $branchs = Branch::orderBy('id','asc')->get();
        $branch_id =  $request->branch_id;
        $from_date =  date('Y-m-d',strtotime($request->from_date));
        $to_date =  date('Y-m-d',strtotime($request->to_date));
        $order = [];
        if(session('branch_id')==1)
        {
            $branch_id =  $request->branch_id?$request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id = session('branch_id');
        }
        $condition = "str_to_date(ticketorders.issuDate, '%Y-%m-%d') between '$from_date' and '$to_date'";
        if($branch_id==1)
        {
            $order = Order::orderBy('ticketorders.issuDate','desc')
                            ->select(DB::raw('ticketorders.*'))
                            ->where('status','=',1)
                            ->whereRaw($condition)
                            ->get();

        }
        else
        {
            $order = Order::orderBy('ticketorders.issuDate','desc')
                               ->select(DB::raw('ticketorders.*'))
                               ->where('status','=',1)
                               ->whereRaw($condition)
                               ->join('users','users.id','=','ticketorders.created_by')
                               ->where('branch_id',$branch_id)
                               ->get();
        }


        return view('settings::order.order.confirmed',compact('order','branchs','branch_id','from_date','to_date'));
    }

    public function create()
    {

        $test=Contact::where('contact_category_id',1)
            ->orWhere('contact_category_id',2)
            ->orWhere('contact_category_id',3)
            ->orWhere('contact_category_id',4)
            ->orWhere('contact_category_id',5)
            ->orWhere('contact_category_id',6)
            ->get();

        $commition=TicketCommission::first();
        $contact = Contact::all();
        $ticket_tax=TicketTax::all();
        $ticket_hotel=Ticket_Hotel::all();
        $item = Item::all();
        return view('settings::order.order.create',compact('contact','ticket_tax','ticket_hotel','commition','test','item'));
    }


    public function store(Request $request)
    {
        $inputdata =[
            'title' => 'required',
            'amount' => 'required',
            'issuDate' => 'required',
        ];
        if(isset($request->check_invoice))
        {
            $inputdata['invoice_particular'] = "required";
            $inputdata['invoice_qty'] =  "required";
            $inputdata['invoice_rate'] =  "required";
        }
        if(isset($request->check_bill))
        {
            $inputdata['bill_particular'] = "required";
            $inputdata['bill_qty'] =  "required";
            $inputdata['bill_rate'] =  "required";
        }
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return Redirect::route('ticket_Order_create')->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        $ResponseOrder = new \App\Modules\Settings\Http\Response\Order();
        $neworder = $ResponseOrder->OrderId_generate();
        $finalValue = $ResponseOrder->ticketCommission($request->taxOnCommission, $request);
        $departureSector= explode("_",$request->departureSector);
            try {
                $order = new Order();
                $order->contact_id = $request->contact_id;
                $order->gdsType = $request->gdsType;
                $order->pnr = $request->pnr;
                $order->first_name = $request->first_name;
                $order->last_name = $request->last_name;
                $order->contact_number = $request->contact_number;
                $order->passport_number = $request->passport_number;
                $order->ticket_number = $request->ticket_number;
                $order->pnrcreationDate = $request->pnrcreationDate;
                $order->recordLocator = $request->recordLocator;
                $order->departureflightCode = $request->departureflightCode;
                $order->departureflightClass = $request->departureflightClass;
                $order->departureDate = $request->departureDate;
                $order->departureFrom = $request->departureFrom;
                $order->arriveTo = $request->arriveTo;
                $order->departureTime = $request->departureTime;
                $order->arrivalTime = $request->arrivalTime;
                $order->returnflightCode = $request->returnflightCode;
                $order->returnflightbookingClass = $request->returnflightbookingClass;
                $order->returnflightDate = $request->returnflightDate;
                $order->returnflightFrom = $request->returnflightFrom;
                $order->returnflightTo = $request->returnflightTo;
                $order->returnflightdepartureTime = $request->returnflightdepartureTime;
                $order->returnflightarrivalDate = $request->returnflightarrivalDate;
                $order->issuetimeLimit = $request->issuetimeLimit;
                $order->documentNumber = $request->documentNumber;
                $order->order_id = 'SO-' . $neworder;
                $order->issuDate = $request->issuDate;
                $order->departureSector = isset($departureSector[0])?$departureSector[0]:null;
                $order->returnSector = $request->returnSector;
                $order->adultPassenger = $request->adultPassenger;
                $order->childPassenger = $request->childPassenger;
                $order->infantPassenger = $request->infantPassenger;
                $order->hotel_note = $request->hotel_note;
                $order->status = isset($request->save)?0:1;

                $order->fareAmount = $request->fareAmount;
                $order->commissionRate = $request->commissionRate;
                $order->taxOnCommission = $finalValue?$finalValue:null;
                $order->ticket_hotel_id = $request->ticket_hotel_id ? $request->ticket_hotel_id : null;
                $order->vendor_id = $request->vendor_id;

                $order->created_by = Auth::id();
                $order->updated_by = Auth::id();
                $order->save();
                if($order)
                {
                    $ResponseOrder->ticketCommissionStore($request,$order->id);
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
                        throw new \Exception("ticketorder not created");
                    }
                    DB::commit();
                    if(isset($request->save))
                    {
                        return Redirect::route('ticket_Order_pending')->with('save', 'Pending Data saved!');
                    }

                    return Redirect::route('ticket_Order_confirmed')->with('save', 'Confirmed Data saved!');

                }

                throw new \Exception("order not created");

            }
            catch(\Illuminate\Database\QueryException $ex)
            {
                DB::rollback();
                $msg = $ex->getMessage();
                return Redirect::route('ticket_Order_create')->withInput()->with('alert.status', 'danger')
                    ->with('alert.message', "$msg");
            }
            catch(\Exception $ex){
                DB::rollback();
                $msg = $ex->getMessage();
                return Redirect::route('ticket_Order_create')->withInput()->with('alert.status', 'danger')
                    ->with('alert.message', "$msg");
            }
        }





    public function edit($id)
    {
        $test=Contact::where('contact_category_id',1)
                        ->orWhere('contact_category_id',2)
                        ->orWhere('contact_category_id',3)
                        ->orWhere('contact_category_id',4)
                        ->orWhere('contact_category_id',5)
                        ->orWhere('contact_category_id',6)
                        ->get();

        $order_pax=Ticket_order_tax::where('ticket_order_id',$id)->get();
        $ticket_tax=TicketTax::all();
        $ticket_hotel=Ticket_Hotel::all();
        $order = Order::find($id);
        $commition=TicketCommission::first();
       if(!$order)
       {
           return back()->with('up', 'Order not found!');
       }
        $contact = Contact::all();
        $item = Item::all();
        return view('settings::order.order.edit',compact('commition','item','order','contact','ticket_tax','ticket_hotel','order_pax','test'));
    }


    public function update(Request $request,$id)
    {
        $inputdata =[
            'title' => 'required',
            'amount' => 'required',
            'issuDate' => 'required',
        ];
        if(isset($request->check_invoice))
        {
            $inputdata['invoice_particular'] = "required";
            $inputdata['invoice_qty'] =  "required";
            $inputdata['invoice_rate'] =  "required";
        }
        if(isset($request->check_bill))
        {
            $inputdata['bill_particular'] = "required";
            $inputdata['bill_qty'] =  "required";
            $inputdata['bill_rate'] =  "required";
        }
        $validator = Validator::make($request->all(), $inputdata);

        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }
        DB::beginTransaction();
        $ResponseOrder = new \App\Modules\Settings\Http\Response\Order();
        $finalValue = $ResponseOrder->ticketCommissionUpdate($request);
        $departureSector= explode("_",$request->departureSector);
        try{
            $order = Order::find($id);
            $order->contact_id =$request->contact_id;
            $order->gdsType =$request->gdsType;
            $order->pnr =$request->pnr;
            $order->first_name =$request->first_name;
            $order->last_name =$request->last_name;
            $order->contact_number =$request->contact_number;
            $order->passport_number =$request->passport_number;
            $order->ticket_number =$request->ticket_number;
            $order->pnrcreationDate =$request->pnrcreationDate;
            $order->recordLocator =$request->recordLocator;
            $order->departureflightCode =$request->departureflightCode;
            $order->departureflightClass =$request->departureflightClass;
            $order->departureDate =$request->departureDate;
            $order->departureFrom =$request->departureFrom;
            $order->arriveTo =$request->arriveTo;
            $order->departureTime =$request->departureTime;
            $order->arrivalTime =$request->arrivalTime;
            $order->returnflightCode =$request->returnflightCode;
            $order->returnflightbookingClass =$request->returnflightbookingClass;
            $order->returnflightDate =$request->returnflightDate;
            $order->returnflightFrom =$request->returnflightFrom;
            $order->returnflightTo =$request->returnflightTo;
            $order->returnflightdepartureTime =$request->returnflightdepartureTime;
            $order->returnflightarrivalDate =$request->returnflightarrivalDate;
            $order->issuetimeLimit =$request->issuetimeLimit;
            $order->documentNumber =$request->documentNumber;
            $order->issuDate =$request->issuDate;
            $order->departureSector =isset($departureSector[0])?$departureSector[0]:null;
            $order->returnSector =$request->returnSector;
            $order->adultPassenger =$request->adultPassenger;
            $order->childPassenger =$request->childPassenger;
            $order->infantPassenger =$request->infantPassenger;
            $order->hotel_note =$request->hotel_note;
            if(isset($request->SaveConfirm))
            {
                $order->status =1;
            }
            if(isset($request->Save)) {
                $order->status =0;
            }
            $order->fareAmount =$request->fareAmount;
            $order->commissionRate =$request->commissionRate;
            $order->taxOnCommission =$finalValue?$finalValue:null;
            $order->ticket_hotel_id =$request->ticket_hotel_id?$request->ticket_hotel_id:null;
            $order->vendor_id =$request->vendor_id;
            $order->created_by = Auth::id();
            $order->updated_by = Auth::id();

            if($order->save())
            {
                $delete = Ticket_order_tax::where('ticket_order_id',$id)->delete();
                $ResponseOrder->ticketCommissionStore($request,$id);
                $ResponseOrder->invoiceUpdate($request,$order);
                $ResponseOrder->billUpdate($request,$order);
                DB::commit();
                if(isset($request->SaveConfirm))
                {
                    return Redirect::route('ticket_Order_confirmed')->with('alert.status', 'success')->with('alert.message', 'Confirmed order Data Updated!');
                }
                else
                {
                    return Redirect::route('ticket_Order_pending')->with('alert.status', 'success')->with('alert.message', 'Pending order Data Updated!');
                }

            }

            throw new \Exception("not Updated");

        }catch(\Illuminate\Database\QueryException $ex){
            DB::rollback();
            $msg = $ex->getMessage();

            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "Not updated! $msg");
        }catch(\Exception $ex){
            $msg = $ex->getMessage();
            DB::rollback();
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "Not updated! $msg");
        }
    }

    public function destroy($id,$bill=null,$invoice=null){

        $bill=$bill;

        $invoice=$invoice;

        if ($bill && $invoice){

            return redirect()->back()->with('del','You have a Bill/Invoice attached with this order.Pleas delete the bill/invoice first');

        }

        elseif ($bill){
            return redirect()->back()->with('del','You have a Bill attached with this order.Pleas delete the bill first');

        }

        elseif ($invoice){
            return redirect()->back()->with('del','You have a Invoice attached with this order.Pleas delete the Invoice first');

        }else{

            $order=Order::find($id);
            if ($order->status==1){
                if ($order->delete()){

                    $delete = Ticket_order_tax::where('ticket_order_id',$id)->delete();
                }
                return redirect()->back()->with('del','Confirmed Data Deleted');

            }else{

                if ($order->delete()){

                    $delete = Ticket_order_tax::where('ticket_order_id',$id)->delete();
                }
                return redirect()->back()->with('del','Pending Data Deleted');
            }

        }


    }

    public function pendinUpdate($id){

        $order=Order::find($id);
        if ($order->ststus==0){
            $order->status=1;
            $order->save();
            return Redirect::route('ticket_Order_confirmed')->with('alert.status', 'success')
                ->with('alert.message', 'Pending data Confirmed  successfully!');

        }

    }

    public function orderPdf($id){

        $logo=OrganizationProfile::first();
        //dd($logo);

        $order=Order::find($id);
        //dd($order);
        $t = str_pad($order->order_id, 6, '0', STR_PAD_LEFT);
        $pdf = PDF::loadView('settings::order.order.orderPdf',compact('logo','order','t'));
        return $pdf->stream('invoice.pdf');

    }


    public function orderMail($id){

        $order=Order::find($id);

        return view('settings::order.order.mailForm',compact('order'));


    }

    public function orderMailStore(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'email_address' => 'required',
            'subject' => 'required',
            'details' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $order=Order::find($id);
        $t = str_pad($order->order_id, 6, '0', STR_PAD_LEFT);
        $logo=OrganizationProfile::first();
        $pdf = PDF::loadView('settings::order.order.orderPdf',compact('logo','order','t'));
        $path=uniqid().'.pdf';
        $filename = public_path('path/'.$path);
        $pdf->save($filename);



        config(['mail.from.name' => $logo->display_name]);
        $email=new Email();
        $email->to=$request->email_address;
        $email->subject=$request->subject;
        $email->details=$request->details;
        $email->file=$path;
        $email->created_by=Auth::user()->id;
        $email->updated_by=Auth::user()->id;
        $email->save();

        Mail::send('settings::order.order.mail',array('order'=>$order,'logo'=>$logo,'t'=>$t,'email'=>$email),function($messeg) use ($pdf){

            $messeg->to(Input::get('email_address'))->subject(Input::get('subject'));

            $messeg->attachData($pdf->output(), "Ticket_Order.pdf");

        });

        return redirect()->back()->with('msg','Email was sent successfully.Pleas Check your Email');

    }


    public function SendMailShow(){

        try{
            $start = date('Y-m-01');
            $end= date("Y-m-t", strtotime($start) ) ;
            $email=Email::whereBetween('created_at',array($start,$end))->orderBy('created_at','asc')->get();
            return view('settings::order.order.ShowSendEmail',compact('email','start','end'));
        }catch (\Exception $ex){
            return back()->with('msg','something wrong');
        }


    }

    public function SendMailShowbyfilter(Request $request){

        try{
            $start = $request->from_date;
            $end= $request->to_date;
            $email=Email::whereBetween('created_at',array($start,$end))->orderBy('created_at','asc')->get();
            return view('settings::order.order.ShowSendEmail',compact('email','start','end'));
        }catch (\Exception $ex){
            return back()->with('msg','something wrong');
        }


    }

    public function SendMailShowPerID($id){

        try{
            $email=Email::find($id);
            return view('settings::order.order.ShowSendEmailPerID',compact('email'));
        }catch (\Exception $ex){
            return back()->with('msg','something wrong');
        }


    }


}
