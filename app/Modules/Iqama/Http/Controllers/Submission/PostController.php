<?php

namespace App\Modules\Iqama\Http\Controllers\Submission;

use App\Models\Branch\Branch;
use App\Models\Iqama\IqamaSubmission;
use App\Models\Recruit\Recruitorder;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $completed = IqamaSubmission::whereNotNull('submission_date')
                                    ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'iqamasubmissions.recruitingorder_id')
                                    ->where('recruitingorder.status' , 1)
                                    ->count();
        $left_temp = Recruitorder::where('status' , 1)->count();
        $left = $left_temp - $completed;
        if(isset($request->all))
        {
            $count = $request->id;
            if($branch_id==1)
            {
                $submission = IqamaSubmission::join("recruitingorder","recruitingorder.id","iqamasubmissions.recruitingorder_id")
                    ->where("recruitingorder.status",1)
                    ->select("recruitingorder.paxid as paxid","iqamasubmissions.*")
                    ->get();
            }
            else
            {
                $submission = IqamaSubmission::join("recruitingorder","recruitingorder.id","iqamasubmissions.recruitingorder_id")
                    ->where("recruitingorder.status",1)
                    ->join('users','users.id','=','iqamasubmissions.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.paxid as paxid","iqamasubmissions.*")
                    ->get();
            }

        }
        elseif(isset($request->today))
        {
            $count = $request->id;
            if($branch_id==1)
            {
                $submission = IqamaSubmission::join("recruitingorder","recruitingorder.id","iqamasubmissions.recruitingorder_id")
                    ->where("recruitingorder.status",1)
                    ->whereDate("iqamasubmissions.created_at",date("Y-m-d"))
                    ->select("recruitingorder.paxid as paxid","iqamasubmissions.*")
                    ->get();
            }
            else
            {
                $submission = IqamaSubmission::join("recruitingorder","recruitingorder.id","iqamasubmissions.recruitingorder_id")
                    ->where("recruitingorder.status",1)
                    ->whereDate("iqamasubmissions.created_at",date("Y-m-d"))
                    ->join('users','users.id','=','iqamasubmissions.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.paxid as paxid","iqamasubmissions.*")
                    ->get();
            }

        }
        else{
            if($branch_id==1)
            {
                $submission = IqamaSubmission::join("recruitingorder","recruitingorder.id","iqamasubmissions.recruitingorder_id")
                    ->leftjoin('iqamareceives','iqamareceives.recruitingorder_id','recruitingorder.id')
                    ->leftjoin('insurances','insurances.recruitingorder_id','recruitingorder.id')
                    ->whereNotNull('insurances.date_of_payment')
                    ->whereNull('iqamareceives.receive_date')
                    ->where("recruitingorder.status",1)
                    ->select("recruitingorder.paxid as paxid","iqamasubmissions.*")
                    ->get();
            }
            else
            {
                $submission = IqamaSubmission::join("recruitingorder","recruitingorder.id","iqamasubmissions.recruitingorder_id")
                    ->leftjoin('iqamareceives','iqamareceives.recruitingorder_id','recruitingorder.id')
                    ->leftjoin('insurances','insurances.recruitingorder_id','recruitingorder.id')
                    ->whereNotNull('insurances.date_of_payment')
                    ->whereNull('iqamareceives.receive_date')
                    ->where("recruitingorder.status",1)
                    ->join('users','users.id','=','iqamasubmissions.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.paxid as paxid","iqamasubmissions.*")
                    ->get();
            }
            $count = count($submission);

        }



        return view('iqama::Submission.index',compact('submission','completed','left','completed','left','count'));
    }

    public function create()
    {
        $recruit = Recruitorder::leftjoin("insurances","insurances.recruitingorder_id","recruitingorder.id")
            ->where("recruitingorder.status",1)->whereNotNull("insurances.date_of_payment")->select("recruitingorder.id as id","recruitingorder.paxid as paxid")->get();

        return view('iqama::Submission.create',compact('recruit'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'submission_date'  => 'required',
        ]);
        $authid = Auth::Id();
        try{
            foreach($request->recruitingorder_id as $value)
            {
                IqamaSubmission::updateOrCreate(
                    ["recruitingorder_id"=>$value],
                    [
                        'recruitingorder_id'=>$value,
                        "submission_date"=> $request->submission_date,
                        "created_by"=> $authid,
                        "updated_by"=> $authid
                    ]
                );
            }
            return redirect()->route("iqama_submission_index")->with('alert.status', 'success')
                ->with('alert.message', 'Submission added successfully.');
        }catch (\Exception $exception){

            return redirect()->route("iqama_submission_index")->with('alert.status', 'danger')
                ->with('alert.message', 'Submission added fail.');
        }

    }

    public function edit($id)
    {
        $recruit = IqamaSubmission::join("recruitingorder","recruitingorder.id","iqamasubmissions.recruitingorder_id")
            ->select("recruitingorder.paxid as paxid","iqamasubmissions.*")
            ->where("iqamasubmissions.id",$id)
            ->first();

        return view('iqama::Submission.edit',compact('recruit'));
    }

    public function update(Request $request,$id)
    {
        try{
            $authid = Auth::Id();
            $insurance = IqamaSubmission::find($id);
            $insurance->updated_by = $authid;
            $insurance->submission_date =$request->submission_date;
            $insurance->save();
            return redirect()->route("iqama_submission_index")->with('alert.status', 'success')
                ->with('alert.message', 'Submission updated successfully.');
        }catch (\Exception $exception){

            return redirect()->route("iqama_submission_index")->with('alert.status', 'danger')
                ->with('alert.message', 'Submision updated fail !.');
        }

    }
}
