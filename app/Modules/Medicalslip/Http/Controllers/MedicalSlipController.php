<?php

namespace App\Modules\Medicalslip\Http\Controllers;
use App\Models\Branch\Branch;
use App\Models\MedicalSlip\Report_File;
use App\Models\Order\Order_file;
use App\Models\Recruit\Recruitorder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\MedicalSlip\Medicalslip;
use App\Models\MedicalSlipFormPax\MedicalSlipFormPax;
use App\Models\MedicalSlipForm\Gamca_Received_submit;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
class MedicalSlipController extends Controller
{

    public function file_download($id)
    {
        try{
            if(is_null($id))
            {
                throw new \Exception("This file is not available");
            }
            $file=Report_File::find($id);
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
    public function index(Request $request, $id=null)
    {
        $fit = Medicalslip::where('medicalslip.status',1)
                    ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'medicalslip.pax_id')
                    ->where('recruitingorder.status' , 1)
                    ->count();

        $unfit = Medicalslip::where('medicalslip.status',0)
                    ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'medicalslip.pax_id')
                    ->where('recruitingorder.status' , 1)
                    ->count();

        $visit_date = Medicalslip::whereNotNull('medicalslip.medical_visit_date')
                                    ->whereNull('medicalslip.status')
                                    ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'medicalslip.pax_id')
                                    ->where('recruitingorder.status' , 1)
                                    ->count();

        $left_temp = Recruitorder::where('status' , 1)->count();

        $left = $left_temp - $fit - $unfit - $visit_date;


    if(isset($request->all)){

        $count = $request->id;

        if(is_null($id))
        {
            if (session('branch_id')==1){
                $branch=Branch::all();
                if($request->fit)
                {
                    $recruit = Recruitorder::join('medicalslip',"medicalslip.pax_id","recruitingorder.id")
                                           ->where('medicalslip.status' , 1)
                                           ->whereDate('medicalslip.created_at' , date("Y-m-d"))
                                           ->select("recruitingorder.*")
                                           ->get();
                    
                }
                elseif($request->unfit)
                {
                    $recruit = Recruitorder::join('medicalslip',"medicalslip.pax_id","recruitingorder.id")
                        ->where('medicalslip.status' , 0)
                        ->whereDate('medicalslip.created_at' , date("Y-m-d"))
                        ->select("recruitingorder.*")
                        ->get();
                }
                elseif($request->nextvisitdate)
                {
                    $recruit = Recruitorder::join('medicalslip',"medicalslip.pax_id","recruitingorder.id")
                        ->whereNotNull('medicalslip.medical_visit_date')
                        ->whereDate('medicalslip.created_at' , date("Y-m-d"))
                        ->whereNull("medicalslip.status")
                        ->select("recruitingorder.*")
                        ->get();
                }
                else
                {
                    $recruit = Recruitorder::leftjoin("gamca_receive_submit","gamca_receive_submit.pax_id","recruitingorder.id")
                                            ->where('recruitingorder.status' , 1)
                                            ->where('gamca_receive_submit.submitted_status' , 1)
                                            ->orWhereNOTNull('gamca_receive_submit.submitted_status')
                                            ->select("recruitingorder.*")
                                            ->get();
                }
                return view('medicalslip::index',compact('id','branch','recruit','fit','unfit','visit_date','left','count'));
            }
            else {

                $branch=Branch::where('id',session('branch_id'))->get();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->where('users.branch_id',session('branch_id'))
                    ->where('recruitingorder.status',1)
                    ->select('recruitingorder.*')
                    ->get();
                return view('medicalslip::index',compact('id','branch','recruit','fit','unfit','visit_date','left','count'));
            }
        }
        else { 

            $branch=Branch::all();
            $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                ->where('users.branch_id',$id)
                ->where('recruitingorder.status',1)
                ->select('recruitingorder.*')
                ->get();
            return view('medicalslip::index',compact('id','branch','recruit','fit','unfit','visit_date','left','count'));

        }
    }
    else{
        if(is_null($id))
        {
            if (session('branch_id')==1){
                $branch=Branch::all();
                if($request->fit)
                {
                    $recruit = Recruitorder::join('medicalslip',"medicalslip.pax_id","recruitingorder.id")
                                           ->leftjoin('mofas','mofas.pax_id','recruitingorder.id')
                                           ->where('mofas.status' , '!=' , 1)
                                           ->orWhereNull('mofas.status') 
                                           ->where('medicalslip.status' , 1)
                                           ->whereDate('medicalslip.created_at' , date("Y-m-d"))
                                           ->select("recruitingorder.*")
                                           ->get();
                }
                elseif($request->unfit)
                {
                    $recruit = Recruitorder::join('medicalslip',"medicalslip.pax_id","recruitingorder.id")
                        ->leftjoin('mofas','mofas.pax_id','recruitingorder.id')
                        ->where('mofas.status' , '!=' , 1)
                        ->orWhereNull('mofas.status') 
                        ->where('medicalslip.status' , 0)
                        ->whereDate('medicalslip.created_at' , date("Y-m-d"))
                        ->select("recruitingorder.*")
                        ->get();
                }
                elseif($request->nextvisitdate)
                {
                    $recruit = Recruitorder::join('medicalslip',"medicalslip.pax_id","recruitingorder.id")
                        ->leftjoin('mofas','mofas.pax_id','recruitingorder.id')
                        ->where('mofas.status' , '!=' , 1) 
                        ->orWhereNull('mofas.status')
                        ->whereNotNull('medicalslip.medical_visit_date')
                        ->whereDate('medicalslip.created_at' , date("Y-m-d"))
                        ->whereNull("medicalslip.status")
                        ->select("recruitingorder.*")
                        ->get();
                }
                else
                {
                
                    $recruit = Recruitorder::leftjoin('mofas','mofas.pax_id','recruitingorder.id')
                                            ->where('recruitingorder.status' , 1)
                                            ->where('mofas.status' ,'!=', 1)
                                            ->orWhereNull('mofas.status')
                                            ->leftjoin("gamca_receive_submit","gamca_receive_submit.pax_id","recruitingorder.id")
                                            ->where('recruitingorder.status' , 1)
                                            ->where('gamca_receive_submit.submitted_status' , 1)
                                            ->select('recruitingorder.*')
                                            ->get();
                }

                $count = count($recruit);

                return view('medicalslip::index',compact('id','branch','recruit','fit','unfit','visit_date','left','count'));
            }
            else {
                $branch=Branch::where('id',session('branch_id'))->get();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->leftjoin('mofas','mofas.pax_id','recruitingorder.id')
                    ->where('mofas.status' , '!=' , 1) 
                    ->orWhereNull('mofas.status')
                    ->where('users.branch_id',session('branch_id'))
                    ->where('recruitingorder.status',1)
                    ->select('recruitingorder.*')
                    ->get();
                $count = count($recruit);
                return view('medicalslip::index',compact('id','branch','recruit','fit','unfit','visit_date','left','count'));
            }
        }
        else { 

            $branch=Branch::all();
            $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                ->leftjoin('mofas','mofas.pax_id','recruitingorder.id')
                ->where('mofas.status' , '!=' , 1) 
                ->orWhereNull('mofas.status')
                ->where('users.branch_id',$id)
                ->where('recruitingorder.status',1)
                ->select('recruitingorder.*')
                ->get();
            $count = count($recruit);
            return view('medicalslip::index',compact('id','branch','recruit','fit','unfit','visit_date','left','count'));

        }
    }
       
    }

    public function create($id)
    {

        $pax_id = Gamca_Received_submit::where('pax_id' , $id)->first();

        if(!$pax_id)
        {
            return back()->with(['alert.message' => 'No entry in medical slip.' , 'alert.status' => 'danger']);
        }
        if($pax_id->submitted_status != 1){
            return back()->with(['alert.message' => 'Pax Id did not return his/her passport yet.' , 'alert.status' => 'danger']);
        }
        $medical=MedicalSlip::all();
        $recrut=Recruitorder::all();
        return view('medicalslip::create',compact('medical','recrut','id'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'paxid' => 'required',
            'medical_date' => 'required',
            'medical_centre_name' => 'required',

        ]);
        if ($validator->fails()) {

            return redirect()->back()->withErrors($validator);
        }

        $medical=new MedicalSlip();
        $medical->pax_id=$request->paxid;
        $medical->medical_date=$request->medical_date;
        $medical->medical_report_date=$request->medical_report_date;
        $medical->medical_centre_name=$request->medical_centre_name;
        $medical->created_by=Auth::user()->id;
        $medical->updated_by=Auth::user()->id;
        $medical->save();

        if( $medical->save())
        {
            return Redirect::route('medicalslip')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Silp created successfully!');
        }else{
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Slip cannot be created.');
        }

    }


    public function edit($id)
    {

        $medical=Medicalslip::find($id);
        $recruit=Recruitorder::all();
        $order=Recruitorder::all();

        foreach ($recruit as $value){
            if ($value->id==$medical->pax_id){
                return view('medicalslip::edit',compact('medical','recruit','order'));
            }
        }

        return Redirect::route('medicalslip_create');
    }

    public function update(Request $request, $id)
    {

        $validator = Validator::make($request->all(), [
            'paxid' => 'required',
            'medical_centre_name' => 'required',
            'medical_date' => 'required',
        ]);

        if ($validator->fails()) {
            return Redirect::route('medicalslip_edit',$id)->withErrors($validator);
        }
        $medical=Medicalslip::find($id);
        $medical->pax_id                =$request->paxid;
        $medical->status                =$request->status;
        $medical->medical_centre_name   =$request->medical_centre_name;
        $medical->medical_date          =$request->medical_date;
        $medical->medical_report_date   =$request->medical_report_date;
        $medical->comment               =$request->comment;
        $medical->reason                =$request->reason;
        $medical->medical_visit_date    =$request->medical_visit_date;
        $medical->updated_by            =Auth::user()->id;
        $medical->update();

        if( $medical->update())
        {
             return Redirect::route('medicalslip')->with('alert.status', 'success')
                    ->with('alert.message', 'Medical Silp Updated successfully!!');
        }else{
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Slip cannot be Updated.');
        }
    }

    public function delete($id)
    {
        $medical=Medicalslip::find($id);
        $medical->delete();
        return back()->withInput()->with('alert.status', 'danger')
            ->with('alert.message', 'Slip deleted.');
    }
}
