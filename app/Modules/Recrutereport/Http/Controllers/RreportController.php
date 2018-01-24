<?php

namespace App\Modules\Recrutereport\Http\Controllers;

use App\Models\Company\Company;
use App\Models\Flight\Flight;
use App\Models\Okala\Okala;
use App\Models\Branch\Branch;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\MedicalSlip\Medicalslip;
use App\Models\Mofa\Mofa;
use App\Models\Fitcard\Fit_Card;
use App\Models\PoliceClearance\PoliceClearance;
use App\Models\MedicalSlipForm\MedicalSlipForm;
use App\Models\Fingerprint\Fingerprint;
use App\Models\Training\Training;
use App\Models\Manpower\Manpower;
use App\Models\Completion\Completion;
use App\Models\Flightnew\Submission;
use App\Models\Flightnew\Confirmation;
use App\Models\VisaStamp\VisaStamp;
use App\Models\Recruit\Recruitorder;
use App\Models\Visa\Visa;
use App\Models\Contact\Contact;
use App\Models\Iqama\Iqamaapprival;
use App\Models\Iqama\Insurance;
use App\Models\Iqama\Receive;
use App\Models\Iqama\IqamaSubmission;
use App\Models\Iqama\Delivery\Clearance;
use App\Models\Iqama\Delivery\Iqamaacknowledgement;
use App\Models\Iqama\Delivery\Receipient;
use App\Models\kafala\Aftersixyday;
use App\Models\kafala\kafala;
use Auth;

use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RreportController extends Controller
{

    public function index()
    {
        return view('recrutereport::index');
    }


    public function vendor()
    {
          /*$rvendor= Flight::all()->groupby('vendor_id')->count('paxid');*/
//         $rvendor=Flight::all();
//         $rvendorUnique=$rvendor->unique('vendor_id')->count('id');
        /*$rvendor=DB::table('flight')->select(count('paxid'),'vendor_id')->groupby('vendor_id')->get();*/
        $rvendor=DB::select('SELECT COUNT(\'paxid\') as paxid,vendor_id FROM flight GROUP BY vendor_id');
        $current_time = Carbon::now()->toDayDateTimeString();
        $start =(new DateTime($current_time))->modify('-14 day')->format('Y-m-d');
        $end =(new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        $company=Company::find(1);
        return view('recrutereport::vendor',compact('rvendor','start','end','company'));
    }

    public function vendorList($id)
    {

        $rvendor=Flight::where('vendor_id',$id)->get();
        $current_time = Carbon::now()->toDayDateTimeString();
        $start =(new DateTime($current_time))->modify('-14 day')->format('Y-m-d');
        $end =(new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        $flight=Flight::whereBetween('created_at',[$start,$end])->get();
        $company=Company::find(1);
        //return $flight;
        //return $id;
        return view('recrutereport::vendorlist',compact('rvendor','company','start','end','flight'));
    }

     public function vendorSearch(Request $request){
         $rvendor=Flight::all();
         $company=Company::find(1);
         $start = date("Y-m-d",strtotime($request->input('from_date'))).' '.'00:00:00';
         $end = date("Y-m-d",strtotime($request->input('to_date')."+1 day")).' '.'00:00:00';
         $flight=Flight::whereBetween('created_at',[$start,$end])->get();
         //return $flight;
         return view('recrutereport::vendor',compact('rvendor','start','end','flight','company'));

     }
    /*public function ticketvendorSearch($id){
        $rvendor=Flight::all();
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        $flight=Flight::whereBetween('created_at',[$start,$end])->where('vendor_id',$id)->get();
        return view('recrutereport::vendorlist',compact('rvendor','start','end','flight','company'));
    }**/

    public function company()
    {
        $company_id = [];
        $pax_ids = [];
        $i = 0;
        $paxIds=Recruitorder::all();
        foreach ($paxIds as $paxId)
        {
            $pax_ids[$i] = $paxId->paxid;
            $company_id[$i] = Visa::find($paxId->registerSerial_id)->company_id;

            $i++;
        }
        $max_value=max($company_id);

        $uniqe=array_fill(0, $max_value+1, 0);

        for($i = 0; $i <= $max_value; $i++)
        {
            $uniqe[$company_id[$i]] = $uniqe[$company_id[$i]] + 1;
        }

        /*$data = [];

        for($i = 0; $i < count($uniqe); $i++)
        {
            if($uniqe[$i] != 0)
            {
                $object = array(
                    'company_name'  => Company::find($i)->name,
                    'okala'         => $uniqe[$i],
                );
                return json_encode($object);
            }

        }
        return json_encode($object);*/


        return view('recrutereport::company',compact ('uniqe'));
    }

    public function companyList()
    {

        $visa_list=Visa::all();

         foreach($visa_list as $all)
        {
             $new = $all->Contact->id;
             $order = Recruitorder::where('id' , $new)->first();
             return $order->paxid;
        }
       /* dd($visa_list);*/


        return view('recrutereport::companyList',compact('visa_list'));
    }

    public function visa()
    {
         $visa=Visa::all();
        return view('recrutereport::visa',compact('visa'));
    }
    public function visalist()
    {

        return view('recrutereport::visalist');
    }

    public function customerReport()
    {
        $recruit_order=Recruitorder::where('status' , 1)->orderBy('created_at','desc')->get();

        return view('recrutereport::report.customer_report' , compact('recruit_order'));
    }

    public function medicalSlipReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $medical = Medicalslip::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $medical = Medicalslip::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.medical_slip_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function medicalSlipReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $medical = Medicalslip::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $medical = Medicalslip::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $medical = Medicalslip::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.medical_slip_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function mofaReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $medical = Mofa::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $medical = Mofa::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.mofa_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function mofaReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $medical = Mofa::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $medical = Mofa::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $medical = Mofa::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.mofa_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function okalaReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $medical = Okala::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $medical = Okala::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.mofa_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function okalaReportSearch(Request $request)
    {

    }

    public function fitCardReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $medical = Fit_Card::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $medical = Fit_Card::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.fit_card_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function fitCardReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $medical = Fit_Card::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $medical = Fit_Card::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $medical = Fit_Card::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.fit_card_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function policeClearanceReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $medical = PoliceClearance::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $medical = PoliceClearance::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.police_clearance_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function policeClearanceReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $medical = PoliceClearance::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $medical = PoliceClearance::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $medical = PoliceClearance::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.police_clearance_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function medicalSlipFormReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $medical = MedicalSlipForm::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $medical = MedicalSlipForm::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.medical_slip_form_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function medicalSlipFormReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $medical = MedicalSlipForm::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $medical = MedicalSlipForm::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $medical = MedicalSlipForm::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.medical_slip_form_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function fingerReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $medical = Fingerprint::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $medical = Fingerprint::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.finger_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function fingerReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $medical = Fingerprint::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $medical = Fingerprint::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $medical = Fingerprint::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.finger_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function trainingReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $medical = Training::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $medical = Training::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.training_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function trainingReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $medical = Training::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $medical = Training::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $medical = Training::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.training_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function manpowerReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $medical = Manpower::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $medical = Manpower::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.manpower_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function manpowerReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $medical = Manpower::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $medical = Manpower::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $medical = Manpower::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.manpower_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function completionReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $medical = Completion::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $medical = Completion::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.completion_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function completionReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $medical = Completion::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $medical = Completion::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $medical = Completion::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.completion_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function submissionReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $medical = Submission::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $medical = Submission::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.submission_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function submissionReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $medical = Submission::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $medical = Submission::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $medical = Submission::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.submission_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function confirmationReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $medical = Confirmation::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $medical = Confirmation::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.confirmation_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function confirmationReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $medical = Confirmation::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $medical = Confirmation::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $medical = Confirmation::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.confirmation_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function visaReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $medical = Visa::whereBetween('created_at',[$start,$end])->get();

            foreach($medical as $all){
                $recruit = Recruitorder::where('registerSerial_id' , $all->id)->count('id');
                $all->left_visa = ($all->numberofVisa - $recruit);
           }
        }
        else{

            $medical = Visa::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

            foreach($medical as $all){
                $recruit = Recruitorder::where('registerSerial_id' , $all->id)->count('id');
                $all->left_visa = ($all->numberofVisa - $recruit);
           }

        }
        
        return view('recrutereport::report.visa_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function visaReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $medical = Visa::whereBetween('created_at',[$start,$end])->get();

                foreach($medical as $all){
                    $recruit = Recruitorder::where('registerSerial_id' , $all->id)->count('id');
                    $all->left_visa = ($all->numberofVisa - $recruit);
                }
            }
            else{
            $medical = Visa::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

                foreach($medical as $all){
                    $recruit = Recruitorder::where('registerSerial_id' , $all->id)->count('id');
                    $all->left_visa = ($all->numberofVisa - $recruit);
                }

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $medical = Visa::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();

            foreach($medical as $all){
                    $recruit = Recruitorder::where('registerSerial_id' , $all->id)->count('id');
                    $all->left_visa = ($all->numberofVisa - $recruit);
                }
        }

        return view('recrutereport::report.visa_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'medical' , 'user' , 'branch_find'));
    }

    public function visaDetail($id)
    {
        $OrganizationProfile = OrganizationProfile::first();

        $visa = Visa::find($id);

        $visa_stamp = VisaStamp::whereHas('paxId', function($q) use($id){
            $q->where('registerSerial_id' , $id);
        })->get();
        //dd($visa_stamp);

        return view('recrutereport::report.visa_details_report',compact('OrganizationProfile', 'visa_stamp' , 'visa'));
    }

    public function referenceReport()
    {

        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);

        if($branch_id == 1){
            $recruit = Recruitorder::leftjoin('invoices' , 'recruitingorder.invoice_id' ,'=', 'invoices.id')
                ->selectRaw('sum(invoices.total_amount) as total_amount')
                ->selectRaw('sum(invoices.due_amount) as due_amount')
                ->selectRaw('recruitingorder.*, count(*) as total')
                ->groupBy('recruitingorder.customer_id')
                ->whereBetween('recruitingorder.created_at',[$start,$end])
                ->get();
        }
        else{
            $recruit = Recruitorder::leftjoin('invoices' , 'recruitingorder.invoice_id' ,'=', 'invoices.id')
                ->selectRaw('sum(invoices.total_amount) as total_amount')
                ->selectRaw('sum(invoices.due_amount) as due_amount')
                ->selectRaw('recruitingorder.*, count(*) as total')
                ->groupBy('recruitingorder.customer_id')
                ->whereBetween('recruitingorder.created_at',[$start,$end])
                ->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })
                ->get();

        }

        return view('recrutereport::report.reference_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'recruit' , 'user' , 'branch_find'));

    }

    public function referenceReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $recruit = Recruitorder::leftjoin('invoices' , 'recruitingorder.invoice_id' ,'=', 'invoices.id')
                ->selectRaw('sum(invoices.total_amount) as total_amount')
                ->selectRaw('sum(invoices.due_amount) as due_amount')
                ->selectRaw('recruitingorder.*, count(*) as total')
                ->groupBy('recruitingorder.customer_id')
                ->whereBetween('recruitingorder.created_at',[$start,$end])
                ->get();
            }
            else{

                $recruit = Recruitorder::leftjoin('invoices' , 'recruitingorder.invoice_id' ,'=', 'invoices.id')
                ->selectRaw('sum(invoices.total_amount) as total_amount')
                ->selectRaw('sum(invoices.due_amount) as due_amount')
                ->selectRaw('recruitingorder.*, count(*) as total')
                ->groupBy('recruitingorder.customer_id')
                ->whereBetween('recruitingorder.created_at',[$start,$end])
                ->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })
                ->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;

            $recruit = Recruitorder::leftjoin('invoices' , 'recruitingorder.invoice_id' ,'=', 'invoices.id')
                ->selectRaw('sum(invoices.total_amount) as total_amount')
                ->selectRaw('sum(invoices.due_amount) as due_amount')
                ->selectRaw('recruitingorder.*, count(*) as total')
                ->groupBy('recruitingorder.customer_id')
                ->whereBetween('recruitingorder.created_at',[$start,$end])
                ->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })
                ->get();

        }

        return view('recrutereport::report.reference_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'recruit' , 'user' , 'branch_find'));
    }

    public function passengerReport(Request $request,$id)
    {
        if($request->recruit_customer_id_list)
        {

            $recruit_id =explode(",",$request->recruit_customer_id_list);

            $recruit = Recruitorder::join("recruit_customer","recruit_customer.recruit_id","recruitingorder.id")
                                 ->whereIn('recruitingorder.id' ,$recruit_id)
                                 ->select("recruitingorder.*")->get();

        }
        else
        {
            $recruit = Recruitorder::where('customer_id' , $id)->get();
        }

        $OrganizationProfile = OrganizationProfile::first();
        $ref_name = Contact::find($id);


       return view('recrutereport::report.passenger_report',compact('OrganizationProfile', 'recruit' , 'ref_name'));
    }

    public function subreferenceReport(Request $request,$id)
    {
        $OrganizationProfile = OrganizationProfile::first();
        $ref_name = Contact::find($id);
        $recruit = Recruitorder::where('recruitingorder.customer_id' ,'=', $id)
                                        ->join('recruit_customer' , 'recruit_customer.pax_id' , '=' , 'recruitingorder.id')
                                        ->join('customer_sub_reference' , 'customer_sub_reference.recruit_customer_id' , '=' ,'recruit_customer.id')
                                        ->join('invoices' , 'recruitingorder.invoice_id' ,'=', 'invoices.id')
                                        ->selectRaw('sum(invoices.total_amount) as total_amount')
                                        ->selectRaw('sum(invoices.due_amount) as due_amount')
                                        ->selectRaw('group_concat(customer_sub_reference.recruit_customer_id) as recruit_customer_id_list')
                                        ->selectRaw('recruitingorder.*,customer_sub_reference.*, count(*) as total')
                                        ->where("customer_sub_reference.order",$request->order)
                                        ->groupBy('customer_sub_reference.name')
                                        ->get();

         $order = $request->order+1;


        return view('recrutereport::report.subreference_report',compact('OrganizationProfile', 'recruit' , 'ref_name','order'));
    }

    public function totalTicketReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);

        if($branch_id == 1){
            $confirm = Confirmation::join('recruitingorder' , 'confirmations.pax_id' ,'=', 'recruitingorder.id')
                    ->leftjoin('invoices' , 'recruitingorder.invoice_id' ,'=', 'invoices.id')
                    ->selectRaw('sum(invoices.total_amount) as total_amount')
                    ->selectRaw('sum(invoices.due_amount) as due_amount')
                    ->selectRaw('confirmations.*, count(*) as total')
                    ->groupBy('confirmations.vendor_name')
                    ->whereBetween('confirmations.created_at',[$start,$end])
                    ->get();

        }
        else{
            $confirm = Confirmation::join('recruitingorder' , 'confirmations.pax_id' ,'=', 'recruitingorder.id')
                    ->leftjoin('invoices' , 'recruitingorder.invoice_id' ,'=', 'invoices.id')
                    ->selectRaw('sum(invoices.total_amount) as total_amount')
                    ->selectRaw('sum(invoices.due_amount) as due_amount')
                    ->selectRaw('confirmations.*, count(*) as total')
                    ->groupBy('confirmations.vendor_name')
                    ->whereBetween('confirmations.created_at',[$start,$end])
                    ->whereHas('createdBy',function($p) use($branch_id){
                            $p->where('branch_id' , $branch_id);
                        })
                    ->get();
        }

        return view('recrutereport::report.total_ticket_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'confirm' , 'user' , 'branch_find'));
    }

    public function totalTicketReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $confirm = Confirmation::join('recruitingorder' , 'confirmations.pax_id' ,'=', 'recruitingorder.id')
                    ->leftjoin('invoices' , 'recruitingorder.invoice_id' ,'=', 'invoices.id')
                    ->selectRaw('sum(invoices.total_amount) as total_amount')
                    ->selectRaw('sum(invoices.due_amount) as due_amount')
                    ->selectRaw('confirmations.*, count(*) as total')
                    ->groupBy('confirmations.vendor_name')
                    ->whereBetween('confirmations.created_at',[$start,$end])
                    ->get();
            }
            else{

                $confirm = Confirmation::join('recruitingorder' , 'confirmations.pax_id' ,'=', 'recruitingorder.id')
                    ->leftjoin('invoices' , 'recruitingorder.invoice_id' ,'=', 'invoices.id')
                    ->selectRaw('sum(invoices.total_amount) as total_amount')
                    ->selectRaw('sum(invoices.due_amount) as due_amount')
                    ->selectRaw('confirmations.*, count(*) as total')
                    ->groupBy('confirmations.vendor_name')
                    ->whereBetween('confirmations.created_at',[$start,$end])
                    ->whereHas('createdBy',function($p) use($branch_id){
                            $p->where('branch_id' , $branch_id);
                        })
                    ->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;

            $confirm = Confirmation::join('recruitingorder' , 'confirmations.pax_id' ,'=', 'recruitingorder.id')
                    ->leftjoin('invoices' , 'recruitingorder.invoice_id' ,'=', 'invoices.id')
                    ->selectRaw('sum(invoices.total_amount) as total_amount')
                    ->selectRaw('sum(invoices.due_amount) as due_amount')
                    ->selectRaw('confirmations.*, count(*) as total')
                    ->groupBy('confirmations.vendor_name')
                    ->whereBetween('confirmations.created_at',[$start,$end])
                    ->whereHas('createdBy',function($p) use($branch_id_2){
                            $p->where('branch_id' , $branch_id_2);
                        })
                    ->get();

        }

        return view('recrutereport::report.total_ticket_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'confirm' , 'user' , 'branch_find'));
    }

    public function totalTicketReportFind($id , $start , $end)
    {
        $user = Auth::user();
        $OrganizationProfile = OrganizationProfile::first();

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);

        $confirm = Confirmation::where('vendor_name' , $id)
                ->whereBetween('created_at',[$start,$end])
                ->get();

        return view('recrutereport::report.total_ticket_vendor_report',compact('OrganizationProfile', 'confirm' , 'user' , 'branch_find' , 'start' , 'end'));
        
    }

    public function totalVisaReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);

        if($branch_id == 1){
            
            $visa = Visa::join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id, visaentrys.visaNumber')
            ->groupBy('visaentrys.company_id')
            ->whereBetween('visaentrys.created_at',[$start,$end])
            ->get();

        }
        else{
            $visa = Visa::join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id, visaentrys.visaNumber')
            ->groupBy('visaentrys.company_id')
            ->whereBetween('visaentrys.created_at',[$start,$end])
            ->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })
            ->get();
        }

        return view('recrutereport::report.total_company_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'visa' , 'user' , 'branch_find'));
    }

    public function totalVisaReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $visa = Visa::join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id, visaentrys.visaNumber')
                ->groupBy('visaentrys.company_id')
                ->whereBetween('visaentrys.created_at',[$start,$end])
                ->get();
            }
            else{

                $visa = Visa::join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id, visaentrys.visaNumber')
                ->groupBy('visaentrys.company_id')
                ->whereBetween('visaentrys.created_at',[$start,$end])
                ->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })
                ->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;

            $visa = Visa::join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id, visaentrys.visaNumber')
                ->groupBy('visaentrys.company_id')
                ->whereBetween('visaentrys.created_at',[$start,$end])
                ->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })
                ->get();

        }

        return view('recrutereport::report.total_company_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'visa' , 'user' , 'branch_find'));
    }

    public function totalVisaReportFind($id , $start , $end)
    {
        $user = Auth::user();
        $OrganizationProfile = OrganizationProfile::first();

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);

        $visa = Visa::where('visaentrys.company_id' , $id)
        ->join('recruitingorder','recruitingorder.registerSerial_id','=' ,'visaentrys.id')
        ->join('contact' , 'recruitingorder.customer_id' , '=' , 'contact.id')
        ->join('visastamping' , 'recruitingorder.id' , '=' , 'visastamping.pax_id')
        ->selectRaw('recruitingorder.*,contact.*,visaentrys.visaType,visaentrys.registerSerial,visastamping.eapplication_no')
        ->whereBetween('visaentrys.created_at',[$start,$end])
        ->get();

        return view('recrutereport::report.total_company_find_report',compact('OrganizationProfile', 'visa' , 'user' , 'branch_find' , 'start' , 'end'));

    }

    public function totalVisaReportGroupWise($id)
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);

        $company_name = Company::find($id);

        if($branch_id == 1){
            
            $visa = Visa::where('company_id' , $id)->join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id, visaentrys.idNum')
            ->groupBy('visaentrys.idNum')
            ->whereBetween('visaentrys.created_at',[$start,$end])
            ->get();

        }
        else{
            $visa = Visa::where('company_id' , $id)->join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id, visaentrys.idNum')
            ->groupBy('visaentrys.idNum')
            ->whereBetween('visaentrys.created_at',[$start,$end])
            ->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })
            ->get();
        }

        return view('recrutereport::report.total_company_report_group_wise',compact('OrganizationProfile','branch', 'start' , 'end' , 'visa' , 'user' , 'branch_find' , 'company_name'));
    }

    public function totalVisaReportGroupWiseSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        $company_id = $request->company_id;

        $company_name = Company::find($company_id);

        if($user->branch_id == 1){
            if($branch_id == 1){
                $visa = Visa::where('company_id' , $company_id)->join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id , visaentrys.idNum')
                ->groupBy('visaentrys.idNum')
                ->whereBetween('visaentrys.created_at',[$start,$end])
                ->get();
            }
            else{

                $visa = Visa::where('company_id' , $company_id)->join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id , visaentrys.idNum')
                ->groupBy('visaentrys.idNum')
                ->whereBetween('visaentrys.created_at',[$start,$end])
                ->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })
                ->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;

            $visa = Visa::where('company_id' , $company_id)->join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id , visaentrys.idNum')
                ->groupBy('visaentrys.idNum')
                ->whereBetween('visaentrys.created_at',[$start,$end])
                ->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })
                ->get();

        }

        return view('recrutereport::report.total_company_report_group_wise',compact('OrganizationProfile','branch', 'start' , 'end' , 'visa' , 'user' , 'branch_find' , 'company_name'));
    }

    public function totalVisaReportGroupWiseFind($id , $company_id, $start , $end)
    {
        $user = Auth::user();
        $OrganizationProfile = OrganizationProfile::first();

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);

        $visa_group_id = Visa::where('idNum',$id)->first()->idNum;

        $company_name = Company::find($company_id)->name;

        $visa = Visa::where(['visaentrys.idNum' => $id , 'visaentrys.company_id' => $company_id])
        ->rightjoin('recruitingorder','recruitingorder.registerSerial_id','=' ,'visaentrys.id')
        ->leftjoin('contact' , 'recruitingorder.customer_id' , '=' , 'contact.id')
        ->leftjoin('visastamping' , 'recruitingorder.id' , '=' , 'visastamping.pax_id')
        ->selectRaw('recruitingorder.*,contact.*,visaentrys.visaType,visaentrys.registerSerial,visastamping.eapplication_no')
        ->whereBetween('visaentrys.created_at',[$start,$end])
        ->get();

        return view('recrutereport::report.total_company_find_report_group_wise',compact('OrganizationProfile', 'visa' , 'user' , 'branch_find' , 'start' , 'end' , 'visa_group_id' , 'company_name'));

    }

    //Total Visa type Visa wise

    public function totalVisaReportVisaWise($id)
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);

        $company_name = Company::find($id);

        if($branch_id == 1){
            
            $visa = Visa::where('company_id' , $id)->join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id, visaentrys.visaNumber')
            ->groupBy('visaentrys.visaNumber')
            ->whereBetween('visaentrys.created_at',[$start,$end])
            ->get();

        }
        else{
            $visa = Visa::where('company_id' , $id)->join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id, visaentrys.visaNumber')
            ->groupBy('visaentrys.visaNumber')
            ->whereBetween('visaentrys.created_at',[$start,$end])
            ->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })
            ->get();
        }

        return view('recrutereport::report.total_company_report_visa_wise',compact('OrganizationProfile','branch', 'start' , 'end' , 'visa' , 'user' , 'branch_find' , 'company_name'));
    }

    public function totalVisaReportVisaWiseSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        $company_id = $request->company_id;

        $company_name = Company::find($company_id);

        if($user->branch_id == 1){
            if($branch_id == 1){
                $visa = Visa::where('company_id' , $company_id)->join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id , visaentrys.visaNumber')
                ->groupBy('visaentrys.visaNumber')
                ->whereBetween('visaentrys.created_at',[$start,$end])
                ->get();
            }
            else{

                $visa = Visa::where('company_id' , $company_id)->join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id , visaentrys.visaNumber')
                ->groupBy('visaentrys.visaNumber')
                ->whereBetween('visaentrys.created_at',[$start,$end])
                ->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })
                ->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;

            $visa = Visa::where('company_id' , $company_id)->join('recruitingorder','recruitingorder.registerSerial_id','=','visaentrys.id')->selectRaw('COUNT(CASE WHEN recruitingorder.visa_category_id = 1 THEN 1 ELSE NULL END) AS free_visa,COUNT(CASE WHEN recruitingorder.visa_category_id = 2 THEN 1 ELSE NULL END) AS contact_visa , COUNT(CASE WHEN recruitingorder.visa_category_id = 3 THEN 1 ELSE NULL END) AS processing_visa, visaentrys.company_id , visaentrys.visaNumber')
                ->groupBy('visaentrys.visaNumber')
                ->whereBetween('visaentrys.created_at',[$start,$end])
                ->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })
                ->get();

        }

        return view('recrutereport::report.total_company_report_visa_wise',compact('OrganizationProfile','branch', 'start' , 'end' , 'visa' , 'user' , 'branch_find' , 'company_name'));
    }

    public function totalVisaReportVisaWiseFind($id , $company_id, $start , $end)
    {
        $user = Auth::user();
        $OrganizationProfile = OrganizationProfile::first();

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);

        $visa_group_id = Visa::where('visaNumber',$id)->first()->visaNumber;

        $company_name = Company::find($company_id)->name;

        $visa = Visa::where(['visaentrys.visaNumber' => $id , 'visaentrys.company_id' => $company_id])
        ->rightjoin('recruitingorder','recruitingorder.registerSerial_id','=' ,'visaentrys.id')
        ->leftjoin('contact' , 'recruitingorder.customer_id' , '=' , 'contact.id')
        ->leftjoin('visastamping' , 'recruitingorder.id' , '=' , 'visastamping.pax_id')
        ->selectRaw('recruitingorder.*,contact.*,visaentrys.visaType,visaentrys.registerSerial,visastamping.eapplication_no')
        ->whereBetween('visaentrys.created_at',[$start,$end])
        ->get();

        return view('recrutereport::report.total_company_find_report_visa_wise',compact('OrganizationProfile', 'visa' , 'user' , 'branch_find' , 'start' , 'end' , 'visa_group_id' , 'company_name'));

    }

    public function iqamaApprovalReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $approval = Iqamaapprival::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $approval = Iqamaapprival::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.iqama_approval_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'approval' , 'user' , 'branch_find'));
    }

    public function iqamaApprovalReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $approval = Iqamaapprival::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $approval = Iqamaapprival::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $approval = Iqamaapprival::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.iqama_approval_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'approval' , 'user' , 'branch_find'));
    }

    public function iqamaInsuranceReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $insurance = Insurance::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $insurance = Insurance::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.iqama_insurance_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'insurance' , 'user' , 'branch_find'));
    }

    public function iqamaInsuranceReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $insurance = Insurance::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $insurance = Insurance::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $insurance = Insurance::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.iqama_insurance_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'insurance' , 'user' , 'branch_find'));
    }

    public function iqamaSubmissionReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $submission = IqamaSubmission::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $submission = IqamaSubmission::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.iqama_submission_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'submission' , 'user' , 'branch_find'));
    }

    public function iqamaSubmissionReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $submission = IqamaSubmission::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $submission = IqamaSubmission::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $submission = IqamaSubmission::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.iqama_submission_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'submission' , 'user' , 'branch_find'));
    }

    public function iqamaReceiveReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $receive = Receive::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $receive = Receive::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.iqama_receive_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'receive' , 'user' , 'branch_find'));
    }

    public function iqamaReceiveReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $receive = Receive::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $receive = Receive::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $receive = Receive::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.iqama_receive_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'receive' , 'user' , 'branch_find'));
    }

    public function iqamaClearanceReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $clearance = Clearance::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $clearance = Clearance::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.iqama_clearance_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'clearance' , 'user' , 'branch_find'));
    }

    public function iqamaClearanceReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $clearance = Clearance::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $clearance = Clearance::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $clearance = Clearance::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.iqama_clearance_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'clearance' , 'user' , 'branch_find'));
    }

    public function iqamaRecipientReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $recepient = Receipient::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $recepient = Receipient::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.iqama_recepient_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'recepient' , 'user' , 'branch_find'));
    }

    public function iqamaRecipientReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $recepient = Receipient::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $recepient = Receipient::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $recepient = Receipient::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.iqama_recepient_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'recepient' , 'user' , 'branch_find'));
    }

    public function iqamaAcknowledgementReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $acknowledgement = Iqamaacknowledgement::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $acknowledgement = Iqamaacknowledgement::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.iqama_acknowledgement_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'acknowledgement' , 'user' , 'branch_find'));
    }

    public function iqamaAcknowledgementReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $acknowledgement = Iqamaacknowledgement::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $acknowledgement = Iqamaacknowledgement::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $acknowledgement = Iqamaacknowledgement::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.iqama_acknowledgement_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'acknowledgement' , 'user' , 'branch_find'));
    }

    public function iqamaBeforeReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $before = kafala::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $before = kafala::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.iqama_before_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'before' , 'user' , 'branch_find'));
    }

    public function iqamaBeforeReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $before = kafala::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $before = kafala::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $before = kafala::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.iqama_before_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'before' , 'user' , 'branch_find'));
    }

    public function iqamaAfterReport()
    {
        $user = Auth::user();
        $branch=Branch::all();
        $OrganizationProfile = OrganizationProfile::first();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-7 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');

        $branch_id = session('branch_id');

        $branch_find = Branch::find($branch_id);
        
        if($branch_id == 1){
            $after = Aftersixyday::whereBetween('created_at',[$start,$end])->get();
        }
        else{

            $after = Aftersixyday::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                    $p->where('branch_id' , $branch_id);
                })->get();

        }
        
        return view('recrutereport::report.iqama_after_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'after' , 'user' , 'branch_find'));
    }

    public function iqamaAfterReportSearch(Request $request)
    {
        $user = Auth::user();
        $branch_id =  $request->branch_id;
        $start =  date('Y-m-d',strtotime($request->from_date));
        $end =  date('Y-m-d',strtotime($request->to_date));

        $branch=Branch::all();
        $branch_find = Branch::find($branch_id);
        $OrganizationProfile = OrganizationProfile::first();

        if($user->branch_id == 1){
            if($branch_id == 1){
                $after = Aftersixyday::whereBetween('created_at',[$start,$end])->get();
            }
            else{
            $after = Aftersixyday::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id){
                        $p->where('branch_id' , $branch_id);
                    })->get();

            }
        }
        else{
            $branch_id_2 = $user->branch_id;
            $after = Aftersixyday::whereBetween('created_at',[$start,$end])->whereHas('createdBy',function($p) use($branch_id_2){
                        $p->where('branch_id' , $branch_id_2);
                    })->get();
        }

        return view('recrutereport::report.iqama_after_report',compact('OrganizationProfile','branch', 'start' , 'end' , 'after' , 'user' , 'branch_find'));
    }

}
