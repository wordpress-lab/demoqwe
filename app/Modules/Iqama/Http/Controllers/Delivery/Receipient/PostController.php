<?php

namespace App\Modules\Iqama\Http\Controllers\Delivery\Receipient;


use App\Models\Branch\Branch;
use App\Models\Iqama\Delivery\Clearance;
use App\Models\Iqama\Delivery\Receipient;
use App\Models\Iqama\Receive;
use App\Models\Recruit\Recruitorder;
use App\Modules\Iqama\Http\Response\ReceipientResponse;
use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $completed = Receipient::whereNotNull('recipient_name')
                                    ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'iqamarecipient.recruitingorder_id')
                                    ->where('recruitingorder.status' , 1)
                                    ->count();
        $left_temp = Recruitorder::where('status' , 1)->count();
        $left = $left_temp - $completed;
        if(isset($request->all))
        {
            $count = $request->id;
            if($branch_id==1)
            {
                $Receive = Recruitorder::leftjoin("iqamaclearance","iqamaclearance.recruitingorder_id","recruitingorder.id")
                    ->leftjoin("iqamarecipient","iqamarecipient.recruitingorder_id","recruitingorder.id")
                    ->where("recruitingorder.status",1)
                    ->where("iqamaclearance.status",1)
                    ->select("recruitingorder.*","iqamarecipient.recipient_name as recipient_name","iqamarecipient.id as iqamarecipient")
                    ->get();
            }
            else
            {
                $Receive = Recruitorder::leftjoin("iqamaclearance","iqamaclearance.recruitingorder_id","recruitingorder.id")
                    ->leftjoin("iqamarecipient","iqamarecipient.recruitingorder_id","recruitingorder.id")
                    ->where("recruitingorder.status",1)
                    ->where("iqamaclearance.status",1)
                    ->join('users','users.id','=','iqamarecipient.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.*","iqamarecipient.recipient_name as recipient_name","iqamarecipient.id as iqamarecipient")
                    ->get();
            }

        }
        elseif(isset($request->today))
        {
            $count = $request->id;
            if($branch_id==1)
            {
                $Receive = Recruitorder::leftjoin("iqamaclearance","iqamaclearance.recruitingorder_id","recruitingorder.id")
                    ->leftjoin("iqamarecipient","iqamarecipient.recruitingorder_id","recruitingorder.id")
                    ->where("recruitingorder.status",1)
                    ->where("iqamaclearance.status",1)
                    ->whereDate("iqamarecipient.created_at",date("Y-m-d"))
                    ->select("recruitingorder.*","iqamarecipient.recipient_name as recipient_name","iqamarecipient.id as iqamarecipient")
                    ->get();
            }
            else
            {
                $Receive = Recruitorder::leftjoin("iqamaclearance","iqamaclearance.recruitingorder_id","recruitingorder.id")
                    ->leftjoin("iqamarecipient","iqamarecipient.recruitingorder_id","recruitingorder.id")
                    ->where("recruitingorder.status",1)
                    ->where("iqamaclearance.status",1)
                    ->whereDate("iqamarecipient.created_at",date("Y-m-d"))
                    ->join('users','users.id','=','iqamarecipient.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.*","iqamarecipient.recipient_name as recipient_name","iqamarecipient.id as iqamarecipient")
                    ->get();
            }

        }
        else{
            if($branch_id==1)
            {
                $Receive = Recruitorder::leftjoin("iqamaclearance","iqamaclearance.recruitingorder_id","recruitingorder.id")
                    ->leftjoin("iqamarecipient","iqamarecipient.recruitingorder_id","recruitingorder.id")
                    ->leftjoin('iqamaacknowledgements','iqamaacknowledgements.recruitingorder_id','recruitingorder.id')
                    ->whereNull('iqamaacknowledgements.receive_date')
                    ->where("recruitingorder.status",1)
                    ->where("iqamaclearance.status",1)
                    ->select("recruitingorder.*","iqamarecipient.recipient_name as recipient_name","iqamarecipient.id as iqamarecipient")
                    ->get();
            }
            else
            {
                $Receive = Recruitorder::leftjoin("iqamaclearance","iqamaclearance.recruitingorder_id","recruitingorder.id")
                    ->leftjoin("iqamarecipient","iqamarecipient.recruitingorder_id","recruitingorder.id")
                    ->leftjoin('iqamaacknowledgements','iqamaacknowledgements.recruitingorder_id','recruitingorder.id')
                    ->whereNull('iqamaacknowledgements.receive_date')
                    ->where("recruitingorder.status",1)
                    ->where("iqamaclearance.status",1)
                    ->join('users','users.id','=','iqamarecipient.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.*","iqamarecipient.recipient_name as recipient_name","iqamarecipient.id as iqamarecipient")
                    ->get();
            }

            $count = count($Receive);

        }
        
        $userType = Auth::user()["type"];
        return view('iqama::Delivery.Receipient.index',compact('userType','Receive','completed','left','count'));
    }

    public function recipientName($id)
    {

     $userType = Auth::user()["type"];
     if(!$userType==0)
     {
      abort(404);
     }

     $recruit = Receipient::rightjoin("recruitingorder","recruitingorder.id","iqamarecipient.recruitingorder_id")
                                 ->where("recruitingorder.id",$id)
                                 ->select("recruitingorder.*","iqamarecipient.recipient_name as recipient_name","iqamarecipient.relational_passenger as relational_passenger")
                                 ->first();

     return view('iqama::Delivery.Receipient.name',compact('userType','recruit'));

    }



    public function create()
    {
        $recruit = Recruitorder::leftjoin("iqamaclearance","iqamaclearance.recruitingorder_id","recruitingorder.id")
                                ->leftjoin("iqamarecipient","iqamarecipient.recruitingorder_id","recruitingorder.id")
                                ->where("recruitingorder.status",1)
                                ->where("iqamaclearance.status",1)
                                ->select("recruitingorder.*","iqamarecipient.recipient_name as recipient_name")
                                ->get();

        return view('iqama::Delivery.Receipient.create',compact('recruit'));
    }


    public function recipientNameUpdate(Request $request)
    {
        $this->validate($request, [
           "recipient_name"=> 'required',
           "relational_passenger"=> 'required',
           "paxid"=> 'required',
        ]);

        try{
          $receipient = Receipient::updateOrCreate(
                    ['recruitingorder_id' =>$request->paxid],
                    ['recruitingorder_id' => $request->paxid,'recipient_name'=>$request->recipient_name,'relational_passenger'=> $request->relational_passenger,'created_by'=>Auth::id(),'updated_by'=>Auth::id()]
                );
            $receipient->saveOrFail();

            return redirect()->route("iqama_Delivery_receipient_index")
                                  ->with('alert.status', 'success')
                                  ->with('alert.message', 'iqama delivery receipient has been save');

        }catch(\Exception $exception){

            $msg =  $exception->getMessage();
            return redirect()->route("iqama_Delivery_receipient_index")
                                ->with('alert.status', 'danger')
                                ->with('alert.message', "fail: $msg");
        }

    }
    public function store(Request $request)
    {
        $this->validate($request, [
            "recruitingorder_id.*"=> 'required',
            "recipient_name.*"=> 'required',
        ]);
        try{

            $response = new ReceipientResponse();
            if($response->save($request))
            {
              return redirect()->route("iqama_Delivery_receipient_index")
                               ->with('alert.status', 'success')
                               ->with('alert.message', "success");
            }

            throw new \Exception("not saved");

        }catch(\Exception $exception){

            $msg = $exception->getMessage();

            return redirect()->route("iqama_Delivery_receipient_index")
                ->with('alert.status', 'danger')
                ->with('alert.message', "fail: $msg");
        }


    }



}
