<?php

namespace App\Modules\Recruitment\Http\Controllers;

use App\Models\Formbasis\Formbasis;
use App\Models\Recruit\Immigration_clearance;
use App\Models\Recruit\Immigration_clearance_pax;
use App\Models\Recruit\Recruitorder;
use App\Models\Recruit_Customer\Recruit_customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use mPDF;

class ImmigrationController extends Controller
{
    public function index(){

        $basis= DB::select("SELECT GROUP_CONCAT(recruitingorder.paxid) as id,immigration_clearance.applicationDate,immigration_clearance_pax.immigration_clearance_id FROM immigration_clearance JOIN immigration_clearance_pax on immigration_clearance.id= immigration_clearance_pax.immigration_clearance_id JOIN recruitingorder ON recruitingorder.id= immigration_clearance_pax.pax_id GROUP BY immigration_clearance_pax.immigration_clearance_id");

        //dd($basis);

        return view('recruitment::immigration.index',compact('basis'));
    }

    public function create(){

        $order=Recruitorder::all();
        return view('recruitment::immigration.create',compact('order'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'total_person' => 'required',
            'person_count' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $input = Input::all();
        $condition = $input['pax_id'];



        $immigra=new Immigration_clearance();

        $immigra->applicationDate=$request->applicationDate;
        $immigra->country_name=$request->country_name;
        $immigra->total_person=$request->total_person;
        $immigra->person_count=$request->person_count;
        $immigra->gender=$request->gender;
        $immigra->stampFee=$request->stampFee;
        $immigra->licenseValidity=$request->licenseValidity;
        $immigra->authentication=$request->authentication;
        $immigra->unitWelfareFee=$request->unitWelfareFee;
        $immigra->incomeTaxType=$request->incomeTaxType?$request->incomeTaxType:0;
        $immigra->unitIncomeTaxNAFee=$request->unitIncomeTaxNAFee;
        $immigra->unitIncomeTaxSAFee=$request->unitIncomeTaxSAFee;
        $immigra->unitSmartCardFee=$request->unitSmartCardFee;
        $immigra->payOrderDetails=$request->payOrderDetails;
        $immigra->WelfareComment=$request->WelfareComment;
        $immigra->incomeTaxComment=$request->incomeTaxComment;
        $immigra->SmartCardComment=$request->SmartCardComment;
        $immigra->created_by=Auth::user()->id;
        $immigra->updated_by=Auth::user()->id;
        $immigra->save();



        if ($immigra) {
            foreach ($condition as $cond) {
                $immipax = new Immigration_clearance_pax();
                $immipax->immigration_clearance_id = $immigra->id;
                $immipax->pax_id = $cond;
                $immipax->save();

            }
            return Redirect::route('immigration_index')->with('msg', 'data Inserted');
        }


    }

    public function edit($id){
        $rec=Recruitorder::all();

        $immigration=Immigration_clearance::find($id);

        $immipax=Immigration_clearance_pax::where('immigration_clearance_id',$id)->get();
        //dd($immipax);

        return view('recruitment::immigration.edit',compact('rec','immigration','immipax'));
    }




    public function update(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'total_person' => 'required',
            'person_count' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $input = Input::all();
        $condition = $input['pax_id'];


        $immigra=Immigration_clearance::find($id);
        $immigra->applicationDate=$request->applicationDate;
        $immigra->country_name=$request->country_name;
        $immigra->total_person=$request->total_person;
        $immigra->person_count=$request->person_count;
        $immigra->gender=$request->gender;
        $immigra->stampFee=$request->stampFee;
        $immigra->licenseValidity=$request->licenseValidity;
        $immigra->authentication=$request->authentication;
        $immigra->unitWelfareFee=$request->unitWelfareFee;
        $immigra->incomeTaxType=$request->incomeTaxType;
        $immigra->unitIncomeTaxNAFee=$request->unitIncomeTaxNAFee;
        $immigra->unitIncomeTaxSAFee=$request->unitIncomeTaxSAFee;
        $immigra->unitSmartCardFee=$request->unitSmartCardFee;
        $immigra->payOrderDetails=$request->payOrderDetails;
        $immigra->WelfareComment=$request->WelfareComment;
        $immigra->incomeTaxComment=$request->incomeTaxComment;
        $immigra->SmartCardComment=$request->SmartCardComment;
        $immigra->created_by=Auth::user()->id;
        $immigra->updated_by=Auth::user()->id;
        $immigra->save();



        if ($immigra) {
            $delete = Immigration_clearance_pax::where('immigration_clearance_id',$id)->delete();
            foreach ($condition as $cond) {
                $immipax = new Immigration_clearance_pax();
                $immipax->immigration_clearance_id = $immigra->id;
                $immipax->pax_id = $cond;
                $immipax->save();

            }
            return Redirect::route('immigration_index')->with('msg', 'data Updated');
        }


    }


    public function delete($id){

        $immimpax=Immigration_clearance::find($id);

        if ($immimpax->delete()){

            $delete = Immigration_clearance_pax::where('immigration_clearance_id',$id)->delete();
        }

        return redirect()->back()->with('msg','data Deleted');
    }



    public function download($id){


//        $basis= DB::select("SELECT medical_slip_form.dateOfApplication,medical_slip_form.country_name ,medical_slip_form_pax.medicalslip_id,contact.display_name,recruitingorder.passportNumber FROM medical_slip_form JOIN medical_slip_form_pax on medical_slip_form.id= medical_slip_form_pax.medicalslip_id JOIN recruitingorder ON recruitingorder.id= medical_slip_form_pax.recruit_id JOIN contact ON contact.id= recruitingorder.customer_id WHERE medical_slip_form.id= :id",array('id'=>$id));
//        // dd($basis);



        $formbasis=Formbasis::first();

        $immigrationpax=Immigration_clearance_pax::where('immigration_clearance_id',$id)->first();
        $immigration=Immigration_clearance::where('id',$immigrationpax->immigration_clearance_id)->first();

        //dd($immigration);



        $immigrationpax=Immigration_clearance_pax::where('immigration_clearance_id',$id)->get();
        //dd($immigrationpax);

        $css = public_path().'/css/bootstrap.min.css';
        $css_2 = public_path().'/css/style.css';

        $bootstrap = file_get_contents($css);
        $style = file_get_contents($css_2);

        $mpdf = new mPDF('utf-8', 'A4-P');
        $view =  view('recruitment::immigration.immigration',compact('immigration','formbasis','immigrationpax','bootstrap','style'));
        $mpdf->WriteHTML($view);
        $mpdf->Output('Immigration-'.Carbon::now().'.pdf','I');

    }


}
