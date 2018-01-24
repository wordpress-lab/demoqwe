<?php

namespace App\Modules\Iqama\Http\Controllers\Delivery\Clearance;


use App\Models\Branch\Branch;
use App\Models\Iqama\Delivery\Clearance;
use App\Models\Recruit\Recruitorder;
use App\Models\Iqama\Receive;
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
        $completed = Clearance::where('iqamaclearance.status' , 1)
                                    ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'iqamaclearance.recruitingorder_id')
                                    ->where('recruitingorder.status' , 1)
                                    ->count();

        $left_temp = Recruitorder::where('status' , 1)->count();

        $left = $left_temp - $completed;

        if(isset($request->all))
        {
            $count = $request->id;
            if($branch_id==1)
            {
                $Receive = Receive::join("recruitingorder","recruitingorder.id","iqamareceives.recruitingorder_id")
                    ->leftjoin("iqamaclearance","iqamaclearance.recruitingorder_id","recruitingorder.id")
                    ->leftjoin('contact','contact.id','recruitingorder.customer_id')
                    ->where("recruitingorder.status",1)
                    ->whereNotNull("iqamareceives.receive_date")
                    ->where("iqamareceives.receive_date","!=","")
                    ->select("recruitingorder.*","iqamaclearance.status as clearance_status","contact.display_name as display_name","iqamaclearance.id as iqamaclearance")
                    ->get();
            }
            else
            {
                $Receive = Receive::join("recruitingorder","recruitingorder.id","iqamareceives.recruitingorder_id")
                    ->leftjoin("iqamaclearance","iqamaclearance.recruitingorder_id","recruitingorder.id")
                    ->leftjoin('contact','contact.id','recruitingorder.customer_id')
                    ->where("recruitingorder.status",1)
                    ->whereNotNull("iqamareceives.receive_date")
                    ->where("iqamareceives.receive_date","!=","")
                    ->join('users','users.id','=','iqamaclearance.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.*","iqamaclearance.status as clearance_status","contact.display_name as display_name","iqamaclearance.id as iqamaclearance")
                    ->get();
            }

        }
        elseif(isset($request->today))
        {
            $count = $request->id;
            if($branch_id==1)
            {
                $Receive = Receive::join("recruitingorder","recruitingorder.id","iqamareceives.recruitingorder_id")
                    ->leftjoin("iqamaclearance","iqamaclearance.recruitingorder_id","recruitingorder.id")
                    ->leftjoin('contact','contact.id','recruitingorder.customer_id')
                    ->where("recruitingorder.status",1)
                    ->whereNotNull("iqamareceives.receive_date")
                    ->where("iqamareceives.receive_date","!=","")
                    ->wheredate("iqamaclearance.created_at",date("Y-m-d"))
                    ->select("recruitingorder.*","iqamaclearance.status as clearance_status","contact.display_name as display_name","iqamaclearance.id as iqamaclearance")
                    ->get();
            }
            else
            {
                $Receive = Receive::join("recruitingorder","recruitingorder.id","iqamareceives.recruitingorder_id")
                    ->leftjoin("iqamaclearance","iqamaclearance.recruitingorder_id","recruitingorder.id")
                    ->leftjoin('contact','contact.id','recruitingorder.customer_id')
                    ->where("recruitingorder.status",1)
                    ->whereNotNull("iqamareceives.receive_date")
                    ->where("iqamareceives.receive_date","!=","")
                    ->wheredate("iqamaclearance.created_at",date("Y-m-d"))
                    ->join('users','users.id','=','iqamaclearance.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.*","iqamaclearance.status as clearance_status","contact.display_name as display_name","iqamaclearance.id as iqamaclearance")
                    ->get();
            }

        }
        else{
            if($branch_id==1)
            {
                $Receive = Receive::join("recruitingorder","recruitingorder.id","iqamareceives.recruitingorder_id")
                    ->leftjoin("iqamaclearance","iqamaclearance.recruitingorder_id","recruitingorder.id")
                    ->leftjoin('iqamarecipient','iqamarecipient.recruitingorder_id','recruitingorder.id')
                    ->leftjoin('contact','contact.id','recruitingorder.customer_id')
                    ->whereNull('iqamarecipient.recipient_name')
                    ->where("recruitingorder.status",1)
                    ->whereNotNull("iqamareceives.receive_date")
                    ->where("iqamareceives.receive_date","!=","")
                    ->select("recruitingorder.*","iqamaclearance.status as clearance_status","contact.display_name as display_name","iqamaclearance.id as iqamaclearance")
                    ->get();
            }
            else
            {
                $Receive = Receive::join("recruitingorder","recruitingorder.id","iqamareceives.recruitingorder_id")
                    ->leftjoin("iqamaclearance","iqamaclearance.recruitingorder_id","recruitingorder.id")
                    ->leftjoin('iqamarecipient','iqamarecipient.recruitingorder_id','recruitingorder.id')
                    ->leftjoin('contact','contact.id','recruitingorder.customer_id')
                    ->whereNull('iqamarecipient.recipient_name')
                    ->where("recruitingorder.status",1)
                    ->whereNotNull("iqamareceives.receive_date")
                    ->where("iqamareceives.receive_date","!=","")
                    ->join('users','users.id','=','iqamaclearance.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.*","iqamaclearance.status as clearance_status","contact.display_name as display_name","iqamaclearance.id as iqamaclearance")
                    ->get();
            }

            $count = count($Receive);

        }
        
        $userType = Auth::user()["type"];
        return view('iqama::Delivery.Clearance.index',compact('userType','Receive','completed','left','count'));
    }

    public function approval($id)
    {

     $userType = Auth::user()["type"];
     if(!$userType==0)
     {
      abort(403);
     }

     $recruit = Clearance::rightjoin("recruitingorder","recruitingorder.id","iqamaclearance.recruitingorder_id")
                                 ->where("recruitingorder.id",$id)
                                 ->select("recruitingorder.*","iqamaclearance.status as iqamaclearance_status", "iqamaclearance.comments as comments")
                                 ->first();

     return view('iqama::Delivery.Clearance.approval',compact('userType','recruit'));

    }

    public function approvalUpdate(Request $request,$id,$status=null)
    {
      
       if(is_null($id)){
           abort(404);
       }
        try{

            if(empty($request->comments)){
                $comments = Null;
            }
            else{
                $comments = $request->comments;
            }

            if ($request->hasFile('file_url')){
                $file = $request->file_url;
                $fileName=uniqid().$file->getClientOriginalName();
                $file->move(public_path('all_image'), $fileName);
            }

            if ($request->hasFile('file_url')){
              $Clearance = Clearance::updateOrCreate(
                  ['recruitingorder_id' =>$id],
                  ['recruitingorder_id' => $id,'status'=>$status,'comments'=>$comments,'file_url' => "all_image/" . $fileName,'created_by'=>Auth::id(),'updated_by'=>Auth::id()]
              );
            }
            else{
              $Clearance = Clearance::updateOrCreate(
                  ['recruitingorder_id' =>$id],
                  ['recruitingorder_id' => $id,'status'=>$status,'comments'=>$comments,'created_by'=>Auth::id(),'updated_by'=>Auth::id()]
              );
            }
            $Clearance->saveOrFail();


            return redirect()->route("iqama_Delivery_Clearance_index")
                ->with('alert.status', 'success')
                ->with('alert.message', "Success");
        }catch(\Exception $exception){

            $msg = $exception->getMessage();
            return redirect()->route("iqama_Delivery_Clearance_index")
                ->with('alert.status', 'danger')
                ->with('alert.message', "fail: $msg");
        }

    }

    public function create()
    {
        $userType = Auth::user()["type"];
        if(!$userType==0)
        {
            abort(403);
        }
        $recruit = Receive::join("recruitingorder","recruitingorder.id","iqamareceives.recruitingorder_id")
                            ->leftjoin('iqamarecipient','iqamarecipient.recruitingorder_id','recruitingorder.id')
                            ->whereNull('iqamarecipient.recipient_name')
                            ->where("recruitingorder.status",1)
                            ->whereNotNull("iqamareceives.receive_date")
                            ->where("iqamareceives.receive_date","!=","")
                            ->select("recruitingorder.*")
                            ->get();

        return view('iqama::Delivery.Clearance.create',compact('recruit'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'recruitingorder_id.*'=>'required',
            "status"=> 'required',

        ]);
        $userType = Auth::user()["type"];
        if(!$userType==0)
        {
            abort(403);
        }
        try{
            if(empty($request->comments)){
                $comments = Null;
            }
            else{
                $comments = $request->comments;
            }
            
            $fileName = Null;

            if ($request->hasFile('file_url')){
                $file = $request->file_url;
                $fileName=uniqid().$file->getClientOriginalName();
                $file->move(public_path('all_image'), $fileName);
            }

            foreach($request->recruitingorder_id as $value)
            {
                $Clearance = Clearance::updateOrCreate(
                    ['recruitingorder_id' =>$value],
                    ['recruitingorder_id' => $value,'file_url' => "all_image/" . $fileName,'comments' => $comments,'status'=>$request->status,'created_by'=>Auth::id(),'updated_by'=>Auth::id()]
                );
                $Clearance->saveOrFail();
            }
            return redirect()->route("iqama_Delivery_Clearance_index")
                                  ->with('alert.status', 'success')
                                  ->with('alert.message', 'iqama delivery Clearance has been save');
        }catch(\Exception $exception){
            $msg =  $exception->getMessage();
            return redirect()->route("iqama_Delivery_Clearance_index")
                                ->with('alert.status', 'danger')
                                ->with('alert.message', "fail: $msg");
        }

    }

    public function edit($id)
    {
        $userType = Auth::user()["type"];
        if(!$userType==0)
        {
            abort(403);
        }
        try{
            $Receive = Receive::find($id);
            if(!$Receive){
                throw new \Exception();
            }
            return view('iqama::Receive.edit',compact('Receive'));
        }catch(\Exception $exception){
            abort(404);
        }

    }

    public function download($id)
    {
        $ext = array("pdf","jpeg","png","gif");
     $file= Clearance::find($id);
     
     try{
         
         if(!$file)
         {  
             throw  new \Exception("file not found");
         }
         if($file->comments!=null && ($file->file_url==null || $file->file_url=="")){
            return redirect()->route("iqama_Delivery_Clearance_index")
                             ->with('alert.status', 'danger')
                             ->with('alert.message', 'No File is Attached'); 
         }
         
         $file_path= public_path($file["file_url"]);
         
        //dd($file_path);
         $type = explode("/",mime_content_type($file_path))[1];

         if(in_array($type,$ext))
         {
       
           return response()->file($file_path);
         }

         $headers = array(
             "Content-Type: mime_content_type($type)",
         );
         return Response::download($file_path,'',$headers);
        }
        catch(\Exception $exception)
        {
           abort(404);
        }
    }


}
