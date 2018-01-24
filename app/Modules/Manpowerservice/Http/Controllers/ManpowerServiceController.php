<?php

namespace App\Modules\Manpowerservice\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\Contact\Contact;
use App\Models\Email\Email;
use App\Models\Inventory\Item;
use App\Models\Manpower\Manpower_service;
use App\Models\Manpower\Manpower_service_progress;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Modules\Manpowerservice\Http\Response\Manpowerresponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Barryvdh\DomPDF\Facade as PDF;

class ManpowerServiceController extends Controller
{

    public function pending()
    {
        $auth_id = Auth::id();
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','desc')->get();
        $condition = "YEAR(str_to_date(manpower_service.created_at,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(manpower_service.created_at,'%Y-%m-%d')) = MONTH(CURDATE())";
        if($branch_id==1)
        {
            $manpower = Manpower_service::orderBy('manpower_service.id','desc')
                                         ->where('status', '=', 0)
                                         ->whereRaw($condition)
                                        ->get();
            return view('manpowerservice::manpower_service.pending', compact('manpower', 'branchs'));
        }
        else
        {
            $manpower = Manpower_service::orderBy('manpower_service.id','desc')
                                          ->select(DB::raw('manpower_service.*'))
                                          ->where('status', '=', 0)
                                          ->whereRaw($condition)
                                          ->join('users','users.id','=','manpower_service.created_by')
                                          ->where('users.branch_id',$branch_id)
                                          ->get();
            return view('manpowerservice::manpower_service.pending', compact('manpower', 'branchs'));
        }
    }
    public function pending_search(Request $request)
    {
        $branchs = Branch::orderBy('id','asc')->get();
        $branch_id =  $request->branch_id;
        $from_date =  date('Y-m-d',strtotime($request->from_date));
        $to_date =  date('Y-m-d',strtotime($request->to_date));
        $manpower = [];
        if(session('branch_id')==1)
        {
            $branch_id =  $request->branch_id?$request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id = session('branch_id');
        }

        $condition = "str_to_date(manpower_service.created_at, '%Y-%m-%d') between '$from_date' and '$to_date'";
        if($branch_id==1)
        {
            $manpower = Manpower_service::orderBy('manpower_service.id','desc')
                                         ->select(DB::raw('manpower_service.*'))
                                         ->where('status','=',0)
                                         ->whereRaw($condition)
                                         ->get();
        }
        else
        {
            $manpower = Manpower_service::orderBy('manpower_service.id','desc')
                                          ->select(DB::raw('manpower_service.*'))
                                          ->where('status','=',0)
                                          ->whereRaw($condition)
                                          ->join('users','users.id','=','manpower_service.created_by')
                                          ->where('branch_id',$branch_id)
                                          ->get();
        }

        return view('manpowerservice::manpower_service.pending',compact('manpower','branchs','branch_id','from_date','to_date'));

    }
    public function confirmed()
    {
        $auth_id = Auth::id();
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $condition = "YEAR(str_to_date(manpower_service.created_at,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(manpower_service.created_at,'%Y-%m-%d')) = MONTH(CURDATE())";
        if($branch_id==1)
        {
            $manpower = Manpower_service::orderBy('manpower_service.id','desc')
                                         ->select(DB::raw('manpower_service.*'))
                                         ->where('status', '=', 1)
                                         ->whereRaw($condition)->get();
            return view('manpowerservice::manpower_service.confirmed', compact('manpower', 'branchs'));
        }
        else
        {
            $manpower = Manpower_service::orderBy('manpower_service.id','desc')->select(DB::raw('manpower_service.*'))->where('status', '=', 1)
                                              ->whereRaw($condition)
                                              ->join('users','users.id','=','manpower_service.created_by')
                                              ->where('users.branch_id',$branch_id)
                                              ->get();
            return view('manpowerservice::manpower_service.confirmed', compact('manpower', 'branchs'));
        }

    }
    public function confirmed_search(Request $request)
    {
        $branchs = Branch::orderBy('id','asc')->get();
        $branch_id =  $request->branch_id;
        $from_date =  date('Y-m-d',strtotime($request->from_date));
        $to_date =  date('Y-m-d',strtotime($request->to_date));
        if(session('branch_id')==1)
        {
            $branch_id =  $request->branch_id?$request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id = session('branch_id');
        }
        $condition = "str_to_date(manpower_service.created_at, '%Y-%m-%d') between '$from_date' and '$to_date'";

        if($branch_id==1)
        {
            $manpower = Manpower_service::orderBy('manpower_service.id','desc')
                                         ->select(DB::raw('manpower_service.*'))
                                         ->where('status','=',1)
                                         ->whereRaw($condition)
                                         ->get();

        }
        else
        {
            $manpower = Manpower_service::orderBy('manpower_service.id','desc')
                                          ->select(DB::raw('manpower_service.*'))
                                          ->where('status','=',1)
                                          ->whereRaw($condition)
                                          ->join('users','users.id','=','manpower_service.created_by')
                                          ->where('branch_id',$branch_id)
                                          ->get();
        }

        return view('manpowerservice::manpower_service.confirmed',compact('manpower','branchs','branch_id','from_date','to_date'));
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

        $contact = Contact::all();
        $progress=Manpower_service_progress::all();
        $item = Item::all();
        return view('manpowerservice::manpower_service.create',compact('contact','test','progress','item'));
    }


    public function store(Request $request)
    {
                $manpowerresponse=  new Manpowerresponse();

                $inputdata =[
                    'progress_status_id' => 'required',
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
                if ($validator->fails()) {
                    return redirect::back()->withErrors($validator);
                }
                try{
                    DB::beginTransaction();
                    $neworder_id=Manpower_service::max('id');
                    ++$neworder_id;
                    $order = str_pad($neworder_id, 6, '0', STR_PAD_LEFT);
                    $manpower = new Manpower_service();
                    $manpower->contact_id = $request->contact_id;
                    $manpower->vendor_id = $request->vendor_id;
                    $manpower->first_name = $request->first_name;
                    $manpower->last_name = $request->last_name;

                    $manpower->phone = $request->phone;
                    if(isset($request->confirm))
                    {
                        $manpower->status = 1;
                    }
                    if(isset($request->save))
                    {
                        $manpower->status = 0;
                    }

                    $manpower->order_id = 'SO-'.$order;
                    $manpower->sector = $request->sector;
                    $manpower->issue_date = $request->issue_date;
                    $manpower->delivery_date = $request->delivery_date;
                    $manpower->progress_status_id = $request->progress_status_id;
                    $manpower->passport_number = $request->passport_number;
                    $manpower->created_by = Auth::id();
                    $manpower->updated_by = Auth::id();
                    $result = $manpower->save();
                    if($result)
                    {
                        $newinvoice=$manpowerresponse->MakeInvoice($request);
                        $newbill=$manpowerresponse->MakeBill($request);
                        $manpower->invoice_id = $newinvoice['id'];
                        $manpower->bill_id = $newbill['id'];
                        $manpower->save();
                    }
                    DB::commit();
                    if(!$result)
                    {

                    }
                    if(isset($request->save))
                    {
                        return Redirect::route('manpower_service_pending')->with('msg','Manpower Service Created Successfully');
                    }
                    return Redirect::route('manpower_service_confirmed')->with('msg','Manpower Service Created Successfully');
                }
                catch(\Exception $ex)
                {
                    DB::rollback();
                    $msg = $ex->getMessage();
                    return redirect()->back()->with('del',"$msg");
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

        $contact = Contact::all();
        $progress=Manpower_service_progress::all();
        $manpower=Manpower_service::find($id);
        if(!$manpower)
        {
            return back();
        }
        $item= Item::all();
        return view('manpowerservice::manpower_service.edit',compact('item','contact','test','manpower','progress'));
    }


    public function update(Request $request,$id)
    {
            $manpowerresponse=  new Manpowerresponse();
            $inputdata =[
                'progress_status_id' => 'required',
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
                return redirect::back()->withErrors($validator);
            }
            try{
                DB::beginTransaction();
                $manpower=Manpower_service::find($id);
                $manpower->contact_id = $request->contact_id;
                $manpower->vendor_id = $request->vendor_id;
                $manpower->first_name = $request->first_name;
                $manpower->last_name = $request->last_name;

                $manpower->phone = $request->phone;
                if(isset($request->confirm))
                {
                    $manpower->status = 1;
                }
                if(isset($request->save))
                {
                    $manpower->status = 0;
                }
                $manpower->sector = $request->sector;
                $manpower->issue_date = $request->issue_date;
                $manpower->delivery_date = $request->delivery_date;
                $manpower->progress_status_id = $request->progress_status_id;
                $manpower->passport_number = $request->passport_number;

                $manpower->updated_by = Auth::id();
                $result = $manpower->save();
                if($result)
                {
                    $newinvoie=  $manpowerresponse->invoiceUpdate($request,$manpower);
                    $newbill=  $manpowerresponse->billUpdate($request,$manpower);

                    if(isset($newinvoie['id']))
                    {
                        $manpower->invoice_id = $newinvoie['id'];
                    }
                    if(isset($newbill['id']))
                    {
                        $manpower->bill_id = $newbill['id'];
                    }
                    $manpower->save();
                }
                DB::commit();
                if(!$result)
                {
                  throw new \Exception("not save");
                }
                if(isset($request->save))
                {
                    return Redirect::route('manpower_service_pending')->with('msg','Manpower Service updated Successfully');
                }
                return Redirect::route('manpower_service_confirmed')->with('msg','Manpower Service updated Successfully');
            }catch(\Exception $ex)
            {
                DB::rollback();
               $msg = $ex->getMessage();
               return redirect()->back()->with('del',"$msg");
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

        }else {

            $progress = Manpower_service::find($id);
            $progress->delete();
            return redirect()->back()->with('del','Delete');
        }
    }

    public function pendinUpdate($id){

        $manpower=Manpower_service::find($id);
        if ($manpower->ststus==0){
            $manpower->status=1;
            $manpower->save();
            return Redirect::route('manpower_service_confirmed')->with('alert.status', 'success')
                ->with('alert.message', 'Pending data Confirmed  successfully!');
        }
    }

    public function orderPdf($id){

        $logo=OrganizationProfile::first();

        $progress=Manpower_service::find($id);
        $t = str_pad($progress->order_id, 6, '0', STR_PAD_LEFT);
        $pdf = PDF::loadView('manpowerservice::manpower_service.orderPdf',compact('logo','progress','t'));
        return $pdf->stream('invoice.pdf');
    }


    public function orderMail($id){

        $manpower=Manpower_service::find($id);
        return view('manpowerservice::manpower_service.mailForm',compact('manpower'));
    }

    public function orderMailStore(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'email_address' => 'required',
            'subject' => 'required',
            'details' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $progress = Manpower_service::find($id);
        $t = str_pad($progress->order_id, 6, '0', STR_PAD_LEFT);
        $logo = OrganizationProfile::first();
        $pdf = PDF::loadView('manpowerservice::manpower_service.orderPdf', compact('logo', 'progress', 't'));
        $path = uniqid() . '.pdf';
        $filename = public_path('manpower/' . $path);
        $pdf->save($filename);

        config(['mail.from.name' => $logo->display_name]);

        $email = new Email();
        $email->to = $request->email_address;
        $email->subject = $request->subject;
        $email->details = $request->details;
        $email->file = $path;
        $email->created_by = Auth::user()->id;
        $email->updated_by = Auth::user()->id;
        $email->save();

        Mail::send('manpowerservice::manpower_service.mail', array('order' => $progress, 'logo' => $logo, 't' => $t, 'email' => $email), function ($messeg) use ($pdf) {

            $messeg->to(Input::get('email_address'))->subject(Input::get('subject'));
            $messeg->attachData($pdf->output(), "Ticket_Order.pdf");

        });

        return redirect()->back()->with('msg', 'Email was sent successfully.Pleas Check your Email');
    }


    public function SendMailShow(){

        try{
            $start = date('Y-m-01');
            $end= date("Y-m-t", strtotime($start) ) ;
            $email=Email::whereBetween('created_at',array($start,$end))->get();
            return view('settings::order.order.ShowSendEmail',compact('email','start','end'));
        }catch (\Exception $ex){
            return back()->with('msg','something wrong');
        }
    }

    public function SendMailShowbyfilter(Request $request){

        try{
            $start = $request->from_date;
            $end= $request->to_date;
            $email=Email::whereBetween('created_at',array($start,$end))->get();
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
