<?php

namespace App\Modules\Recruitment\Http\Controllers;

use App\Models\Contact\Contact;
use App\Models\Recruit\Recruitorder;
use App\Models\Recruit_Customer\Recruit_customer;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use mPDF;

class NoObjectionController extends Controller
{
    public function index(Request $request){

        $order=Recruitorder::all();

        return view('recruitment::objection.index')->with('order',$order);
    }



    public function match(Request $request){

        $validator = Validator::make($request->all(), [
            'paxid' => 'required',
        ]);


        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $match=$request->paxid;

        $recruit=Recruitorder::where('paxid',$match)->first();

        if(!$recruit){
            return redirect()->back()->with('msg','Pax id not match');
        }


        $customer=Recruit_customer::where('recruit_id',$recruit->id)->first();


        if (!$customer){
            return redirect()->back()->with('msg','Pax id not match');
        }
        $contact=Contact::where('id',$recruit->customer_id)->first();
        if (!$contact){

            return redirect()->back()->with('msg','Pax id not match');
        }

        $css = public_path().'/css/bootstrap.min.css';
        $css_2 = public_path().'/css/style.css';

        $bootstrap = file_get_contents($css);
        $style = file_get_contents($css_2);

        $mpdf = new mPDF('utf-8', 'A4-P');
        $view =  view('recruitment::objection.show',compact('recruit','customer','contact','bootstrap','style'));
        $mpdf->WriteHTML($view);
        $mpdf->Output('No-Objection-'.Carbon::now().'.pdf','I');




    }
}
