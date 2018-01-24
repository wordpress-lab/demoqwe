<?php

namespace App\Modules\Iqama\Http\Controllers\Receive;

use App\Models\Branch\Branch;
use App\Models\Iqama\Receive;
use App\Models\Recruit\Recruitorder;
use App\Modules\Iqama\Http\Response\ReceiveResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $completed = Receive::whereNotNull('receive_date')
                                    ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'iqamareceives.recruitingorder_id')
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
                    ->where("recruitingorder.status",1)
                    ->select("recruitingorder.paxid as paxid","iqamareceives.*")
                    ->get();
            }
            else
            {
                $Receive = Receive::join("recruitingorder","recruitingorder.id","iqamareceives.recruitingorder_id")
                    ->where("recruitingorder.status",1)
                    ->join('users','users.id','=','iqamareceives.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.paxid as paxid","iqamareceives.*")
                    ->get();
            }

        }
        elseif(isset($request->today))
        {
            $count = $request->id;
            if($branch_id==1)
            {
                $Receive = Receive::join("recruitingorder","recruitingorder.id","iqamareceives.recruitingorder_id")
                    ->where("recruitingorder.status",1)
                    ->whereDate("iqamareceives.created_at",date("Y-m-d"))
                    ->select("recruitingorder.paxid as paxid","iqamareceives.*")
                    ->get();
            }
            else
            {
                $Receive = Receive::join("recruitingorder","recruitingorder.id","iqamareceives.recruitingorder_id")
                    ->where("recruitingorder.status",1)
                    ->whereDate("iqamareceives.created_at",date("Y-m-d"))
                    ->join('users','users.id','=','iqamareceives.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.paxid as paxid","iqamareceives.*")
                    ->get();
            }

        }
        else{
            if($branch_id==1)
            {
                $Receive = Receive::join("recruitingorder","recruitingorder.id","iqamareceives.recruitingorder_id")
                    ->leftjoin('iqamaclearance','iqamaclearance.recruitingorder_id','recruitingorder.id')
                    ->leftjoin('iqamasubmissions','iqamasubmissions.recruitingorder_id','recruitingorder.id')
                    ->whereNotNull('iqamasubmissions.submission_date')
                    ->where('iqamaclearance.status','!=',1)
                    ->orWhereNull('iqamaclearance.status')
                    ->where("recruitingorder.status",1)
                    ->select("recruitingorder.paxid as paxid","iqamareceives.*")
                    ->get();
            }
            else
            {
                $Receive = Receive::join("recruitingorder","recruitingorder.id","iqamareceives.recruitingorder_id")
                    ->leftjoin('iqamaclearance','iqamaclearance.recruitingorder_id','recruitingorder.id')
                    ->leftjoin('iqamasubmissions','iqamasubmissions.recruitingorder_id','recruitingorder.id')
                    ->whereNotNull('iqamasubmissions.submission_date')
                    ->where('iqamaclearance.status','!=',1)
                    ->orWhereNull('iqamaclearance.status')
                    ->where("recruitingorder.status",1)
                    ->join('users','users.id','=','iqamareceives.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.paxid as paxid","iqamareceives.*")
                    ->get();
            }

            $count = count($Receive);

        }
        

        return view('iqama::Receive.index',compact('Receive','completed','left','completed','left','count'));
    }

    public function create()
    {
        $Receive = Recruitorder::leftjoin("iqamasubmissions","iqamasubmissions.recruitingorder_id","recruitingorder.id")
            ->where("recruitingorder.status",1)->whereNotNull("iqamasubmissions.submission_date")->select("recruitingorder.*")->get();

        return view('iqama::Receive.create',compact('Receive'));
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'recruitingorder_id.*'=>'required',
            'receive_date.*'=> 'required',
            'file_url.*'=> 'required',
           ]);

         try{
         $response = new ReceiveResponse();
         $response->save($request);

         return redirect()->route("iqama_receive_index")->with('alert.status', 'success')
                                                        ->with('alert.message', 'iqama recieve has been save');
            }catch(\Exception $exception){
         $msg =  $exception->getMessage();
         return redirect()->route("iqama_receive_index")->with('alert.status', 'danger')
                                                         ->with('alert.message', "fail: $msg");
           }

    }

    public function edit($id)
    {
        try{
            $Receive = Receive::find($id);
            if(!$Receive){
                throw new \Exception();
            }
            return view('iqama::Receive.edit',compact('Receive'));
        }catch (\Exception $exception){
            abort(404);
        }

    }

    public function update(Request $request,$id)
    {

        $response = new ReceiveResponse();

       try{
           if($response->update($request,$id)){
               return redirect()->route("iqama_receive_index")->with('alert.status', 'success')
                   ->with('alert.message', 'iqama recieve has been updated');
           }

           throw new \Exception("to update");
       }catch(\Exception $exception){
           $msg = $exception->getMessage();
           return redirect()->route("iqama_receive_index")->with('alert.status', 'danger')
               ->with('alert.message', "fail: $msg ");
       }



    }

    public function download($id)
    {
        $ext = array("pdf","jpeg","png","gif");
     $file= Receive::find($id);
     try{
         if(!$file)
         {
             throw  new \Exception("file not found");
         }
         $file_path= ($file["file_url"]);
         
        
         $type = explode("/",mime_content_type($file["file_url"]))[1];

         if(in_array($type,$ext))
         {
       
           return response()->file($file["file_url"]);
         }

         $headers = array(
             "Content-Type: mime_content_type($type)",
         );
         return Response::download($file["file_url"],'',$headers);
        }
        catch(\Exception $exception)
        {
           abort(404);
        }
    }
    public function destroy($id)
    {
        try{
            $Receive = Receive::find($id);
            if(!$Receive){
                throw new \Exception();
            }
            $oldfile = public_path($Receive["file_url"]);

            $Receive->delete();
            if(file_exists($oldfile)){
                unlink($oldfile);
            }

           return redirect()->route("iqama_receive_index")->with('alert.status', 'danger')
               ->with('alert.message', "deleted");
        }catch (\Exception $exception){
            abort(404);
        }
    }
}
