<?php

namespace App\Modules\Settings\Http\Controllers\ticket\ticket_document;

use App\Models\Contact\Contact;
use App\Models\Email\Email;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Recruit\Recruitorder;
use App\Models\Ticket\Ticket_Document;
use App\Models\Visa\Ticket\Order\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TicketDocumentController extends Controller
{

    public function index()
    {
        $ticket=Ticket_Document::all();

        return view('settings::ticket.ticket_document.index', compact('ticket'));
    }

    public function create()
    {
        $order=Order::all();
        return view('settings::ticket.ticket_document.create',compact('order'));
    }

    public function store(Request $request){


        $validator = Validator::make($request->all(), [
            'order_id' => 'required',
            'title' => 'required',
            'file_url' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }


        if ($request->hasFile('file_url')){
            $file = $request->file('file_url');
            $name =$file->getClientOriginalName();
            $file->move(public_path().'/path/', $name);


            $ticket=new Ticket_Document();
            $ticket->title=$request->title;
            $ticket->file_url=$name;
            $ticket->note=$request->note;
            $ticket->order_id=$request->order_id;
            $ticket->created_by=Auth::user()->id;
            $ticket->updated_by=Auth::user()->id;
            $ticket->save();

            return Redirect::route('ticket_document_index')->with('msg', 'Ticket Inserted');

          }

    }


    public function edit($id){

        $ticket=Ticket_Document::find($id);
       // dd($ticket);
        $order=Order::all();


        return view('settings::ticket.ticket_document.edit',compact('ticket','order'));
    }



    public function update(Request $request,$id){




        if ($request->hasFile('file_url')){

            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
                'title' => 'required',
                'file_url' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect::back()->withErrors($validator);
            }

            $file = $request->file('file_url');
            $timestamp = str_replace([' ', ':'], '-', Carbon::now()->toDateTimeString());
            $name = $timestamp. '-' .$file->getClientOriginalName();
            $file->move(public_path().'/path/', $name);


            $ticket=Ticket_Document::find($id);
            $ticket->title=$request->title;
            $ticket->file_url=$name;
            $ticket->note=$request->note;
            $ticket->order_id=$request->order_id;
            $ticket->created_by=Auth::user()->id;
            $ticket->updated_by=Auth::user()->id;
            $ticket->save();

            return Redirect::route('ticket_document_index')->with('msg', 'Ticket Updated');

        }else{

            $validator = Validator::make($request->all(), [
                'order_id' => 'required',
                'title' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect::back()->withErrors($validator);
            }

            $ticket=Ticket_Document::find($id);
            $ticket->title=$request->title;
            $ticket->note=$request->note;
            $ticket->order_id=$request->order_id;
            $ticket->created_by=Auth::user()->id;
            $ticket->updated_by=Auth::user()->id;
            $ticket->save();

            return Redirect::route('ticket_document_index')->with('msg', 'Ticket Updated');
        }

    }


    public function delete($id){

        $ticket=Ticket_Document::find($id);

        $ticket->delete();
        return redirect()->back()->with('del','Ticket Deleted');
    }


    public function sendMail($id){


        $document=Ticket_Document::find($id);
        $order=Order::where('id',$document->order_id)->first();
        $contact=Contact::where('id',$order->contact_id)->first();
        //dd($document);

        return view('settings::ticket.ticket_document.mailForm',compact('contact','document'));

    }

    public function sendMailStore(Request $request,$id){

        //dd($request->all());

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

        //dd($result);
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

            $messege->attach(public_path('path/').$result);

        });

        return redirect()->back()->with('msg','Email sent successfully.Pleas Check your Email');

    }




}
