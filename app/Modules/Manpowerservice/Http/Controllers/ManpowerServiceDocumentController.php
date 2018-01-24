<?php

namespace App\Modules\Manpowerservice\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\Contact\Contact;
use App\Models\Email\Email;
use App\Models\Manpower\Manpower_service;
use App\Models\Manpower\Manpower_service_document;
use App\Models\OrganizationProfile\OrganizationProfile;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class ManpowerServiceDocumentController extends Controller
{

    public function index()
    {
        $auth_id = Auth::id();
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $condition = "YEAR(str_to_date(manpower_service_ticket_document.created_at,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(manpower_service_ticket_document.created_at,'%Y-%m-%d')) = MONTH(CURDATE())";
        if($branch_id==1)
        {
            $manpower = Manpower_service_document::whereRaw($condition)->get();
            return view('manpowerservice::manpower_service_document.index', compact('manpower', 'branchs'));
        }
        else
        {
            $manpower = Manpower_service_document::select(DB::raw('manpower_service_ticket_document.*'))->whereRaw($condition)
                                                  ->join('users','users.id','=','manpower_service_ticket_document.created_by')
                                                  ->where('users.branch_id',$branch_id)
                                                   ->get();
            return view('manpowerservice::manpower_service_document.index', compact('manpower', 'branchs'));
        }
    }
    public function search(Request $request)
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
        $condition = "str_to_date(manpower_service_ticket_document.created_at, '%Y-%m-%d') between '$from_date' and '$to_date'";

        if($branch_id==1)
        {
            $manpower=Manpower_service_document::orderBy('manpower_service_ticket_document.created_at','desc')
                                                ->select(DB::raw('manpower_service_ticket_document.*'))
                                                ->whereRaw($condition)
                                                ->get();

        }
        else
        {
            $manpower=Manpower_service_document::orderBy('manpower_service_ticket_document.created_at','desc')
                                                ->select(DB::raw('manpower_service_ticket_document.*'))
                                                ->whereRaw($condition)
                                                ->join('users','users.id','=','manpower_service_ticket_document.created_by')
                                                ->where('branch_id',$branch_id)
                                                ->get();
        }



        return view('manpowerservice::manpower_service_document.index', compact('manpower','branchs','branch_id','from_date','to_date'));
    }


    public function create()
    {
        $manpower=Manpower_service::all();
        return view('manpowerservice::manpower_service_document.create',compact('manpower'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'manpower_service_id' => 'required',
            'title' => 'required',
            'file_url' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        if ($request->hasFile('file_url')){
            $file = $request->file('file_url');
            $name =$file->getClientOriginalName();
            $file->move(public_path().'/manpower/', $name);

            $document=new Manpower_service_document();
            $document->title=$request->title;
            $document->file_url=$name;
            $document->note=$request->note;
            $document->manpower_service_id=$request->manpower_service_id;
            $document->created_by=Auth::user()->id;
            $document->updated_by=Auth::user()->id;
            $document->save();

            return Redirect::route('manpower_service_document_index')->with('msg', 'Manpower Service Document Created');

        }else{

            return Redirect::route('manpower_service_document_create')->with('msg', 'Manpower Service Document Not Created');
        }
    }

    public function edit($id){

        $document=Manpower_service_document::find($id);
        $manpower=Manpower_service::all();
        return view('manpowerservice::manpower_service_document.edit',compact('document','manpower'));
    }

    public function update(Request $request,$id){

        if ($request->hasFile('file_url')){

            $validator = Validator::make($request->all(), [
                'manpower_service_id' => 'required',
                'title' => 'required',
                'file_url' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect::back()->withErrors($validator);
            }

            $file = $request->file('file_url');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $file->move(public_path().'/manpower/', $name);

            $ticket=Manpower_service_document::find($id);
            $ticket->title=$request->title;
            $ticket->file_url=$name;
            $ticket->note=$request->note;
            $ticket->manpower_service_id=$request->manpower_service_id;
            $ticket->created_by=Auth::user()->id;
            $ticket->updated_by=Auth::user()->id;
            $ticket->save();

            return Redirect::route('manpower_service_document_index')->with('msg', 'Manpower Service Document Updated');

        }else{

            $validator = Validator::make($request->all(), [
                'manpower_service_id' => 'required',
                'title' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect::back()->withErrors($validator);
            }

            $ticket=Manpower_service_document::find($id);
            $ticket->title=$request->title;
            $ticket->note=$request->note;
            $ticket->manpower_service_id=$request->manpower_service_id;
            $ticket->created_by=Auth::user()->id;
            $ticket->updated_by=Auth::user()->id;
            $ticket->save();

            return Redirect::route('manpower_service_document_index')->with('msg', 'Manpower Service Document Updated');
        }

    }

    public function delete($id){

        $ticket=Manpower_service_document::find($id);
        $ticket->delete();
        return redirect()->back()->with('del','Manpower Service Document Deleted');
    }

    public function sendMail($id){


        $document=Manpower_service_document::find($id);
        $manpower=Manpower_service::where('id',$document->manpower_service_id)->first();
        $contact=Contact::where('id',$manpower->contact_id)->first();

        return view('manpowerservice::manpower_service_document.mailForm',compact('contact','document'));

    }

    public function sendMailStore(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'email_address' => 'required',
            'subject' => 'required',
            'details' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }
        $logo=OrganizationProfile::first();
        $result=$request->file_url;

        config(['mail.from.name' => $logo->display_name]);

        $email=new Email();
        $email->to=$request->email_address;
        $email->subject=$request->subject;
        $email->details=$request->details;
        $email->file=$request->file_url;
        $email->created_by=Auth::user()->id;
        $email->updated_by=Auth::user()->id;
        $email->save();

        Mail::send('settings::order.order.mail',array('email'=>$email,'logo'=>$logo),function($messege) use($result){

            $messege->to(Input::get('email_address'))->subject(Input::get('subject'));

            $messege->attach(public_path('manpower/').$result);

        });

        return redirect()->back()->with('msg','Email sent successfully.Pleas Check your Email');

    }




}