<?php

namespace App\Modules\Recruitment\Http\Controllers;

use App\Models\Company\Company;
use App\Models\Contact\Contact;
use App\Models\Flight\Flight;
use App\Models\Formbasis\Formbasis;
use App\Models\Manpower\Manpower;
use App\Models\MedicalSlip\Medicalslip;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Moneyin\PaymentReceives;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Recruit\Gamca;
use App\Models\Recruit\Recruitorder;
use App\Models\Recruit\VisaProcessReport;
use App\Models\Recruit_Customer\Recruit_customer;
use App\Models\Visa\Visa;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class VisaProcessController extends Controller
{
    public function index()
    {
        $visa=VisaProcessReport::all();
        return view('recruitment::visaprocess.index', compact('visa'));
    }

    public function create()
    {
        $order=Recruitorder::all();

        return view('recruitment::visaprocess.create', compact('order'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'recruit_id' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }


            $visa=new VisaProcessReport();
            $visa->date=$request->date;
            $visa->vls_number=$request->vls_number;
            $visa->remarks=$request->remarks;
            $visa->recruit_id=$request->recruit_id;
            $visa->created_by=Auth::user()->id;
            $visa->updated_by=Auth::user()->id;
            $visa->save();
            return Redirect::route('visa_process_index')->with('create','VLS Process Created');


    }

    public function edit($id)
    {
        $order=Recruitorder::all();
        $visa=VisaProcessReport::find($id);
        return view('recruitment::visaprocess.edit',compact('visa','order'));
    }


    public function update(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'recruit_id' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }


        $visa=VisaProcessReport::find($id);
        $visa->date=$request->date;
        $visa->vls_number=$request->vls_number;
        $visa->remarks=$request->remarks;
        $visa->recruit_id=$request->recruit_id;
        $visa->created_by=Auth::user()->id;
        $visa->updated_by=Auth::user()->id;
        $visa->save();
        return Redirect::route('visa_process_index')->with('create','VLS Process Updated');


    }

    public function delete($id)
    {
        $visa=VisaProcessReport::find($id);
        $visa->delete();
        return redirect()->back()->with('delete','VLS Process Deleted');

    }

    public function download($id){

        $logo=OrganizationProfile::first();
        $frombasis=Formbasis::first();
        $visa=VisaProcessReport::find($id);
        $value=$visa->recruit->paxid;

        $recruit=Recruitorder::where('paxid',$value)->first();
        if ($recruit==null){

            return redirect()->back()->with('msg','No Pax match');
        }

        //dd($recruit);
        $customer=Recruit_customer::where('recruit_id',$recruit->id)->first();
        //dd($customer);
        $contact=Contact::where('id',$recruit->customer_id)->first();
        //dd($contact);



        $visaentry=Visa::where('id',$recruit->registerSerial_id)->first();
       // dd($Registarserial);

        $local=Contact::where('id',$visaentry->local_Reference)->first();
         //dd($local);

        $company=Company::where('id',$visaentry->company_id)->first();
        //dd($recruit,$company);

        $medicalslip=Medicalslip::where('pax_id',$recruit->id)->first();

        $manpower=Manpower::where('paxid',$recruit->id)->first();

        $flight=Flight::where('paxid',$recruit->id)->first();


        $invoice=Invoice::where('id',$recruit->invoice_id)->first();


        $payrecentry=PaymentReceiveEntryModel::where('invoice_id',$recruit->invoice_id)->get();


        $pdf = PDF::loadView('recruitment::visaprocess.visaprocess',compact('logo','frombasis','visaentry','visa','recruit','customer','contact','company','gamca','medicalslip','manpower','flight','paymentreceived','result','invoice','local','payrecentry'));
        return $pdf->stream('medical_slip-'.Carbon::now().'.pdf','I');



    }







}
