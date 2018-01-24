<?php

namespace App\Modules\Manpower\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\Manpower\ChallanForm;
use App\Models\Manpower\Manpower;
use App\Models\Recruit\Recruitorder;
use App\Models\Training\Training;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use mPDF;

class ManpowerController extends Controller
{
    public function index(Request $request,$id=null)
    {
        $completed = Manpower::whereNotNull('issuingDate')
                                            ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'manpower.paxid')
                                            ->where('recruitingorder.status' , 1)
                                            ->count();

        $left_temp = Recruitorder::where('status' , 1)->count();

        $left = $left_temp - $completed;

        if(isset($request->all)){
            $count = $request->id;
            if(is_null($id))
            {
                if(session('branch_id')==1)
                {
                    $branch=Branch::all();
                    if($request->today)
                    {

                        $recruit = Recruitorder::join("manpower","recruitingorder.id","manpower.paxid")
                                                ->whereDate('.manpower.created_at' , date("Y-m-d"))
                                                ->get();
                    }
                    else
                    {
                        
                        $recruit = Recruitorder::where('status' , 1)
                                                ->where('registerSerial_id' , '!=' , Null)
                                                ->get();
                    }

                    return view('manpower::manpower.index',compact('id','branch','recruit','completed','left','count'));
                }
                else
                {
                        $branch=Branch::where('id',session('branch_id'))->get();
                        $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                                                ->where('users.branch_id',session('branch_id'))
                                                ->where('recruitingorder.status',1)
                                                ->where('recruitingorder.registerSerial_id' , '!=' , Null)
                                                ->select('recruitingorder.*')
                                                ->get();
                        return view('manpower::manpower.index',compact('id','branch','recruit','completed','left','count'));
                 }
            }
            else
            {
                
                $branch=Branch::all();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->where('users.branch_id',$id)
                    ->where('recruitingorder.status',1)
                    ->where('recruitingorder.registerSerial_id' , '!=' , Null)
                    ->select('recruitingorder.*')
                    ->get();
                return view('manpower::manpower.index',compact('id','branch','recruit','completed','left','count'));

            }
        }
        else{
            if(is_null($id))
            {
                if(session('branch_id')==1)
                {
                    $branch=Branch::all();
                    if($request->today)
                    {

                        $recruit = Recruitorder::join("manpower","recruitingorder.id","manpower.paxid")
                                                ->leftjoin('completions','completions.paxid','recruitingorder.id')
                                                ->leftjoin('trainings','trainings.paxid','recruitingorder.id')
                                                ->whereNotNull('trainings.number')
                                                ->whereNull('completions.smart_card_number')
                                                ->whereDate('.manpower.created_at' , date("Y-m-d"))
                                                ->select('recruitingorder.*')
                                                ->get();
                    }
                    else
                    {
                        
                        $recruit = Recruitorder::where('status' , 1)
                                                ->leftjoin('completions','completions.paxid','recruitingorder.id')
                                                ->leftjoin('trainings','trainings.paxid','recruitingorder.id')
                                                ->whereNotNull('trainings.number')
                                                ->whereNull('completions.smart_card_number')
                                                ->where('registerSerial_id' , '!=' , Null)
                                                ->select('recruitingorder.*')
                                                ->get();
                    }
                    $count = count($recruit);
                    return view('manpower::manpower.index',compact('id','branch','recruit','completed','left','count'));
                }
                else
                {
                        $branch=Branch::where('id',session('branch_id'))->get();
                        $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                                                ->leftjoin('completions','completions.paxid','recruitingorder.id')
                                                ->leftjoin('trainings','trainings.paxid','recruitingorder.id')
                                                ->whereNotNull('trainings.number')
                                                ->whereNull('completions.smart_card_number')
                                                ->where('users.branch_id',session('branch_id'))
                                                ->where('recruitingorder.status',1)
                                                ->where('recruitingorder.registerSerial_id' , '!=' , Null)
                                                ->select('recruitingorder.*')
                                                ->get();
                        $count = count($recruit);
                        return view('manpower::manpower.index',compact('id','branch','recruit','completed','left','count'));
                 }
            }
            else
            {
                
                $branch=Branch::all();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->leftjoin('completions','completions.paxid','recruitingorder.id')
                    ->leftjoin('trainings','trainings.paxid','recruitingorder.id')
                    ->whereNotNull('trainings.number')
                    ->whereNull('completions.smart_card_number')
                    ->where('users.branch_id',$id)
                    ->where('recruitingorder.status',1)
                    ->where('recruitingorder.registerSerial_id' , '!=' , Null)
                    ->select('recruitingorder.*')
                    ->get();
                $count = count($recruit);
                return view('manpower::manpower.index',compact('id','branch','recruit','completed','left','count'));

            }
        }
        
    }

    public function create()
    {
        $order = Recruitorder::leftjoin("trainings","trainings.paxid","recruitingorder.id")
                            ->select("recruitingorder.*")
                            ->where("recruitingorder.status",1)
                            ->whereNotNull("trainings.number")
                            ->get();
//                            ->whereNOTIn('recruitingorder.id',function($query){
//                                 $query->select('manpower.paxid')->from('manpower');
//                              })

        return view('manpower::manpower.create',compact('order','manpower'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'paxid' => 'required',
            'issuingDate' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

            $manpower = new Manpower();
            $manpower->issuingDate = $request->issuingDate;
            $manpower->comment = $request->comment;
            $manpower->paxid = $request->paxid;
            $manpower->created_by =Auth::user()->id ;
            $manpower->updated_by =Auth::user()->id ;
            $manpower->save();

        return Redirect::route('manpower_index')->with('create','Manpower Created');
    }

    public function edit($id)
    {
        $manpower=Manpower::all();
        $recruit=Recruitorder::find($id);
        $order=Recruitorder::all();
        return view('manpower::manpower.edit',compact('manpower','order','recruit'));
    }

    public function update(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'paxid' => 'required',
            'issuingDate' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $manpower=Manpower::find($id);
        $manpower->issuingDate=$request->issuingDate;
        $manpower->comment=$request->comment;
        $manpower->paxid = $request->paxid;
        $manpower->updated_by=Auth::user()->id;
        $manpower->save();

        return Redirect::route('manpower_index')->with('create','Manpower Updated');
    }

    public function delete($id)
    {
        $company=Manpower::find($id);
        $company->delete();
        return Redirect::route('manpower_index')->with('delete','Manpower Deleted');
    }

    public function challanCreate($id){

        return view('manpower::manpower.challan_create',compact('id'));

    }

    public function challanStore(Request $request){

        $mapower=Manpower::find($request->id);

        $challan=new ChallanForm();
        $challan->challanNo=$request->challanNo;
        $challan->challanDate=$request->challanDate;
        $challan->district=$request->district;
        $challan->branch=$request->branch;
        $challan->fromAddress=$request->fromAddress;
        $challan->organizationAddress=$request->organizationAddress;
        $challan->rate_1=$request->rate_1;
        $challan->rate_2=$request->rate_2;
        $challan->rate_3=$request->rate_3;
        $challan->quantity_1=$request->quantity_1;
        $challan->quantity_2=$request->quantity_2;
        $challan->quantity_3=$request->quantity_3;
        $challan->amount_bangla=$request->amount_bangla;
        $challan->comment=$request->comment;
        $challan->manpower_id=$mapower->id;
        $challan->created_by=Auth::user()->id;
        $challan->updated_by=Auth::user()->id;
        $challan->save();

        return Redirect::route('manpower_index')->with('msg','Challan Created Successfully');

    }

    public function challanEdit($id){

       $challan=ChallanForm::find($id);

        return view('manpower::manpower.challan_edit',compact('challan'));
    }

    public function challanUpdate(Request $request,$id){

        $challan=ChallanForm::find($id);
        $challan->challanNo=$request->challanNo;
        $challan->challanDate=$request->challanDate;
        $challan->district=$request->district;
        $challan->branch=$request->branch;
        $challan->fromAddress=$request->fromAddress;
        $challan->organizationAddress=$request->organizationAddress;
        $challan->rate_1=$request->rate_1;
        $challan->rate_2=$request->rate_2;
        $challan->rate_3=$request->rate_3;
        $challan->quantity_1=$request->quantity_1;
        $challan->quantity_2=$request->quantity_2;
        $challan->quantity_3=$request->quantity_3;
        $challan->amount_bangla=$request->amount_bangla;
        $challan->comment=$request->comment;
        $challan->updated_by=Auth::user()->id;
        $challan->save();

        return Redirect::route('manpower_index')->with('msg','Challan Updated Successfully');
    }

    public function challanPdf($id){

        $challan=ChallanForm::find($id);
        $mpdf = new mPDF('utf-8', 'A4-L');
        $css = public_path().'/css/bootstrap.min.css';
        $bootstrap = file_get_contents($css);
        $view =  view('manpower::manpower.challan_pdf',compact('challan','bootstrap'));
        $mpdf->WriteHTML($view);
        $mpdf->Output();

    }

}
