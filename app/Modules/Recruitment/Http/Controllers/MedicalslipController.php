<?php

namespace App\Modules\Recruitment\Http\Controllers;

use App\Models\Formbasis\Formbasis;
use App\Models\MedicalSlipForm\Gamca_file;
use App\Models\MedicalSlipForm\Gamca_Received_submit;
use App\Models\MedicalSlipForm\MedicalSlipForm;
use App\Models\MedicalSlipFormPax\MedicalSlipFormPax;
use App\Models\Recruit\Recruitorder;
use App\Models\Okala\Okala;
use App\Modules\Recruitment\Http\Response\MedicalSlipResponse;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use mPDF;

class MedicalslipController extends Controller
{

    public function index(Request $request){

        $completed = MedicalSlipFormPax::whereNotNull('recruit_id')
                            ->count();

        $left_temp = Recruitorder::where('status' , 1)->count();

        $left = $left_temp - $completed;

        $basis=MedicalSlipForm::all();
        if($request->today)
        {
            $basis=MedicalSlipForm::whereDate('created_at' , date("Y-m-d"))->get();
        }
        return view('recruitment::medicalslipform.index',compact('basis','completed','left'));
    }
    public function gamca_download($id)
    {
        try{
            if(is_null($id))
            {
                throw new \Exception("This file is not available");
            }
            $file=Gamca_file::find($id);
            if(!$file)
            {
                throw new \Exception("This file is not available");
            }
            $path = public_path("all_image/".$file->img_url);
            $mime = mime_content_type($path);
            if($mime=="application/msword")
            {
                return Response::download($path);
            }

            return Response::make(file_get_contents($path), 200, [
                'Content-Type' => $mime,
                'Content-Disposition' => 'inline; filename="'.$file->img_url.'"'
            ]);
        }catch (\Exception $exception){

            $msg=  $exception->getMessage();
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "Sorry, $msg.");
        }
    }
    public function create(){
        $order=Recruitorder::all();
        return view('recruitment::medicalslipform.create',compact('order'));
    }

     public function check($recruit,$received)
     {
        if (!$received==''){
            $flug=true;
            foreach ($received as $value)
            {
                if (!in_array($value, $recruit))
                {
                    $flug = false;
                }
            }
            if (!$flug){

                Session::flash('message', 'Passport Received Data and Pax Id not match');
            }
            return $flug;
        }else{
            return false;
        }
     }

    public function check2($received,$submitted)
    {
        if (!$submitted=='' && !$received==''){
            $flug=true;
            foreach($submitted as $value) {
                if (!in_array($value, $received)) {
                    $flug = false;
                }
            }
            if (!$flug){

                Session::flash('message', 'Passport Received Data and Passport Submitted Data not match');
            }
            return $flug;
        }else{
            return false;
        }

    }



    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'recruit_id' => 'required',
            'dateOfApplication' => 'required',
        ]);

        if ($validator->fails()){
            return redirect::back()->withErrors($validator);
        }
        DB::beginTransaction();
        $input = Input::all();
        $condition = $input['recruit_id'];
        $received_status = isset($input['received_status'])?$input['received_status']:null;
        $submitted_status = isset($input['submitted_status'])?$input['submitted_status']:null;
        $is_valid= $this->check($condition,$received_status,$submitted_status);
        $is_valid2= $this->check2($received_status,$submitted_status);

     try{
         $RecruitArr = new MedicalSlipResponse();
         $medical = new MedicalSlipForm();
         $medical->dateOfApplication = $request->dateOfApplication;
         $medical->country_name = $request->country_name;
         $medical->created_by = Auth::user()->id;
         $medical->updated_by = Auth::user()->id;
         $medical->save();

         $gamcadata=$RecruitArr->recruitConvertToArray($request,$medical->id);



         if($is_valid && $is_valid2)
         {
             if($medical)
             {
                 if($received_status!=null && $submitted_status==null)
                 {
                     Gamca_Received_submit::insert($gamcadata);
                 }
                 if($received_status!=null && $submitted_status!=null)
                 {
                     Gamca_Received_submit::insert($gamcadata);
                 }

                 foreach ($condition as $cond) {
                     $formpax = new MedicalSlipFormPax();
                     $formpax->medicalslip_id = $medical->id;
                     $formpax->recruit_id = $cond;
                     $formpax->save();

                 }
                 DB::commit();
                 return Redirect::route('medical_slip_form_index')->with('msg', 'data Inserted');
             }
         }
         elseif($submitted_status==null || ($is_valid && $is_valid2))
         {
             if($medical)
             {
                 if ($received_status!=null)
                 {
                     Gamca_Received_submit::insert($gamcadata);
                 }
                 else
                 {
                     $gamca_receive_submit=new Gamca_Received_submit();
                     $gamca_receive_submit->medical_slip_form_id=$medical->id;
                     $gamca_receive_submit->received_status=null;
                     $gamca_receive_submit->submitted_status=null;
                     $gamca_receive_submit->pax_id=null;
                     $gamca_receive_submit->save();
                 }

                 foreach ($condition as $cond)
                 {
                     $formpax = new MedicalSlipFormPax();
                     $formpax->medicalslip_id = $medical->id;
                     $formpax->recruit_id = $cond;
                     $formpax->save();

                 }
                 DB::commit();
                 return Redirect::route('medical_slip_form_index')->with('msg', 'data Inserted');
             }
         }
         else
         {
         throw new \Exception("Sorry Pax ID, Passport Received & Passport Submitted not matched");
         }
         throw new \Exception("data not save");
     }catch (\Exception $exception){
         $msg=  $exception->getMessage();
         DB::rollback();
         return Redirect::route('medical_slip_form_create')->with('message', "$msg");

     }
    }

    public function edit($id){

        $rec=Recruitorder::all();

        $immipax=MedicalSlipFormPax::where('medicalslip_id',$id)->get();
        $gamca_receive_submit=Gamca_Received_submit::where('medical_slip_form_id',$id)->get();
        $gamca_receive_submit2=Gamca_Received_submit::where('medical_slip_form_id',$id)
                                                    ->where('submitted_status',1)
                                                    ->get();

        $query=MedicalSlipForm::find($id);

        return view('recruitment::medicalslipform.edit',compact('formpax','rec','query','immipax','gamca_receive_submit','gamca_receive_submit2'));
    }


    public function update(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'recruit_id' => 'required',
            'dateOfApplication' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }
        DB::beginTransaction();

        $input = Input::all();
        $condition = $input['recruit_id'];
        $received_status = isset($input['received_status']) ? $input['received_status'] : null;
        $submitted_status = isset($input['submitted_status']) ? $input['submitted_status'] : null;

        $is_valid = $this->check($condition, $received_status, $submitted_status);
        $is_valid2 = $this->check2($received_status, $submitted_status);

       try{
           $RecruitArr = new MedicalSlipResponse();
           $medical = MedicalSlipForm::find($id);
           $medical->dateOfApplication = $request->dateOfApplication;
           $medical->country_name = $request->country_name;
           $medical->created_by = Auth::user()->id;
           $medical->updated_by = Auth::user()->id;
           $medical->save();
           $gamcadata=$RecruitArr->recruitConvertToArray($request,$medical->id);
           if ($is_valid && $is_valid2){
               if($medical)
               {
                   $delete = MedicalSlipFormPax::where('medicalslip_id', $id)->delete();
                   $delete = Gamca_Received_submit::where('medical_slip_form_id', $id)->delete();
                   if($received_status!=null && $submitted_status==null)
                   {
                       Gamca_Received_submit::insert($gamcadata);
                   }
                   if($received_status!=null && $submitted_status!=null)
                   {
                       Gamca_Received_submit::insert($gamcadata);
                   }
                   foreach($condition as $cond)
                   {
                       $formpax = new MedicalSlipFormPax();
                       $formpax->medicalslip_id = $medical->id;
                       $formpax->recruit_id = $cond;
                       $formpax->save();
                   }
                   DB::commit();
                   return redirect()->route('medical_slip_form_index')->with('msg', 'data Updated');
               }

           }
           elseif($submitted_status==null || ($is_valid && $is_valid2))
           {


               if($medical)
               {
                   $delete = MedicalSlipFormPax::where('medicalslip_id', $id)->delete();
                   $delete = Gamca_Received_submit::where('medical_slip_form_id', $id)->delete();
                   if($received_status!=null)
                   {
                       Gamca_Received_submit::insert($gamcadata);
                   }
                   else
                   {
                       $gamca_receive_submit=new Gamca_Received_submit();
                       $gamca_receive_submit->medical_slip_form_id=$medical->id;
                       $gamca_receive_submit->received_status=null;
                       $gamca_receive_submit->submitted_status=null;
                       $gamca_receive_submit->pax_id=null;
                       $gamca_receive_submit->save();
                   }
                   foreach($condition as $cond)
                   {
                       $formpax = new MedicalSlipFormPax();
                       $formpax->medicalslip_id = $medical->id;
                       $formpax->recruit_id = $cond;
                       $formpax->save();

                   }
                    DB::commit();
                   return redirect()->route('medical_slip_form_index')->with('msg', 'data Updated');
               }
           }
          throw new \Exception(" Data update fail");
       }catch(\Exception $exception){

           DB::rollback();
           return redirect()->back()->with('delete', 'data not Updated');
       }

    }

    public function delete($id){

        $formpax=MedicalSlipForm::find($id);

        if ($formpax->delete()){

            $delete = MedicalSlipFormPax::where('medicalslip_id',$id)->delete();
        }

        return redirect()->back()->with('delete','data Deleted');
    }


    public function download($id){

        $basis= DB::select("SELECT medical_slip_form.dateOfApplication,medical_slip_form.country_name ,recruit_customer.passengerNameBN,recruit_customer.passportNumberBN,medical_slip_form_pax.medicalslip_id,contact.display_name,recruitingorder.passportNumber,recruitingorder.passenger_name FROM medical_slip_form JOIN medical_slip_form_pax on medical_slip_form.id= medical_slip_form_pax.medicalslip_id JOIN recruitingorder ON recruitingorder.id= medical_slip_form_pax.recruit_id JOIN contact ON contact.id= recruitingorder.customer_id LEFT JOIN recruit_customer ON recruit_customer.pax_id= recruitingorder.id WHERE medical_slip_form.id= :id",array('id'=>$id));
            //dd($basis);
        $formbasis=Formbasis::first();

        $css = public_path().'/css/bootstrap.min.css';
        $css_2 = public_path().'/css/style.css';

        $bootstrap = file_get_contents($css);
        $style = file_get_contents($css_2);

        $mpdf = new mPDF('utf-8', 'A4-P');
        $mpdf->SetTitle('My Title');
        $view =  view('recruitment::medicalslipform.medical_slip',compact('basis','formbasis','bootstrap','style'));
        $mpdf->WriteHTML($view);
        $mpdf->Output('medical_slip-'.Carbon::now().'.pdf','I');
    }
}
