<?php

namespace App\Modules\Iqama\Http\Controllers\Delivery\Acknowledgement;

use App\Lib\TemplateHeader;
use App\Models\Branch\Branch;
use App\Models\OrganizationProfile\OrganizationProfile;
use Barryvdh\DomPDF\Facade as PDF;
use App\Models\Iqama\Delivery\Clearance;
use App\Models\Iqama\Delivery\Iqamaacknowledgement;
use App\Models\Iqama\Delivery\Receipient;
use App\Models\Iqama\Receive;
use App\Modules\Iqama\Http\Response\AcknowledgementResponse;
use App\Models\Recruit\Recruitorder;
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
        $completed = Iqamaacknowledgement::whereNotNull('receive_date')
                                    ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'iqamaacknowledgements.recruitingorder_id')
                                    ->where('recruitingorder.status' , 1)
                                    ->count();

        $left_temp = Recruitorder::where('status' , 1)->count();

        $left = $left_temp - $completed;

        if(isset($request->all))
        {
            $count = $request->id;
            if($branch_id==1)
            {
                $acknowledgement = Receipient::leftjoin("recruitingorder","recruitingorder.id","iqamarecipient.recruitingorder_id")
                    ->leftjoin('contact','contact.id','recruitingorder.customer_id')
                    ->leftjoin("iqamaacknowledgements","recruitingorder.id","iqamaacknowledgements.recruitingorder_id")
                    ->whereNotNull("iqamarecipient.recipient_name")
                    ->where("iqamarecipient.recipient_name","!=","")
                    ->where("recruitingorder.status",1)
                    ->select("recruitingorder.*","iqamarecipient.recipient_name as recipient_name","iqamaacknowledgements.file_url as ack_file_url","iqamaacknowledgements.receive_date as ack_receive_date","contact.display_name as display_name","iqamaacknowledgements.id as iqamaacknowledgementsID")
                    ->get();
            }
            else
            {
                $acknowledgement = Receipient::leftjoin("recruitingorder","recruitingorder.id","iqamarecipient.recruitingorder_id")
                    ->leftjoin('contact','contact.id','recruitingorder.customer_id')
                    ->leftjoin("iqamaacknowledgements","recruitingorder.id","iqamaacknowledgements.recruitingorder_id")
                    ->whereNotNull("iqamarecipient.recipient_name")
                    ->where("iqamarecipient.recipient_name","!=","")
                    ->where("recruitingorder.status",1)
                    ->join('users','users.id','=','iqamaacknowledgements.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.*","iqamarecipient.recipient_name as recipient_name","iqamaacknowledgements.file_url as ack_file_url","iqamaacknowledgements.receive_date as ack_receive_date","contact.display_name as display_name","iqamaacknowledgements.id as iqamaacknowledgementsID")
                    ->get();
            }


        }
        elseif(isset($request->today))
        {
            $count = $request->id;
            if($branch_id==1)
            {
                $acknowledgement = Receipient::leftjoin("recruitingorder","recruitingorder.id","iqamarecipient.recruitingorder_id")
                    ->leftjoin('contact','contact.id','recruitingorder.customer_id')
                    ->leftjoin("iqamaacknowledgements","recruitingorder.id","iqamaacknowledgements.recruitingorder_id")
                    ->whereNotNull("iqamarecipient.recipient_name")
                    ->where("iqamarecipient.recipient_name","!=","")
                    ->where("recruitingorder.status",1)
                    ->whereDate("iqamaacknowledgements.created_at",date("Y-m-d"))
                    ->select("recruitingorder.*","iqamarecipient.recipient_name as recipient_name","iqamaacknowledgements.file_url as ack_file_url","iqamaacknowledgements.receive_date as ack_receive_date","contact.display_name as display_name","iqamaacknowledgements.id as iqamaacknowledgementsID")
                    ->get();
            }
            else
            {
                $acknowledgement = Receipient::leftjoin("recruitingorder","recruitingorder.id","iqamarecipient.recruitingorder_id")
                    ->leftjoin('contact','contact.id','recruitingorder.customer_id')
                    ->leftjoin("iqamaacknowledgements","recruitingorder.id","iqamaacknowledgements.recruitingorder_id")
                    ->whereNotNull("iqamarecipient.recipient_name")
                    ->where("iqamarecipient.recipient_name","!=","")
                    ->where("recruitingorder.status",1)
                    ->join('users','users.id','=','iqamaacknowledgements.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->whereDate("iqamaacknowledgements.created_at",date("Y-m-d"))
                    ->select("recruitingorder.*","iqamarecipient.recipient_name as recipient_name","iqamaacknowledgements.file_url as ack_file_url","iqamaacknowledgements.receive_date as ack_receive_date","contact.display_name as display_name","iqamaacknowledgements.id as iqamaacknowledgementsID")
                    ->get();
            }


        }
        else{
            if($branch_id==1)
            {
                $acknowledgement = Receipient::leftjoin("recruitingorder","recruitingorder.id","iqamarecipient.recruitingorder_id")
                    ->leftjoin('contact','contact.id','recruitingorder.customer_id')
                    ->leftjoin("iqamaacknowledgements","recruitingorder.id","iqamaacknowledgements.recruitingorder_id")
                    ->leftjoin('kafalas','kafalas.recruitingorder_id','recruitingorder.id')
                    ->leftjoin('aftersixydays','aftersixydays.recruitingorder_id','recruitingorder.id')
                    ->orWhereNull('kafalas.date_of_kafala')
                    ->orWhereNull('aftersixydays.date_of_payment')
                    ->whereNotNull("iqamarecipient.recipient_name")
                    ->where("iqamarecipient.recipient_name","!=","")
                    ->where("recruitingorder.status",1)
                    ->select("recruitingorder.*","iqamarecipient.recipient_name as recipient_name","iqamaacknowledgements.file_url as ack_file_url","iqamaacknowledgements.receive_date as ack_receive_date","contact.display_name as display_name","iqamaacknowledgements.id as iqamaacknowledgementsID")
                    ->get();
            }
            else
            {
                $acknowledgement = Receipient::leftjoin("recruitingorder","recruitingorder.id","iqamarecipient.recruitingorder_id")
                    ->leftjoin('contact','contact.id','recruitingorder.customer_id')
                    ->leftjoin("iqamaacknowledgements","recruitingorder.id","iqamaacknowledgements.recruitingorder_id")
                    ->leftjoin('kafalas','kafalas.recruitingorder_id','recruitingorder.id')
                    ->leftjoin('aftersixydays','aftersixydays.recruitingorder_id','recruitingorder.id')
                    ->orWhereNull('kafalas.date_of_kafala')
                    ->orWhereNull('aftersixydays.date_of_payment')
                    ->whereNotNull("iqamarecipient.recipient_name")
                    ->where("iqamarecipient.recipient_name","!=","")
                    ->where("recruitingorder.status",1)
                    ->join('users','users.id','=','iqamaacknowledgements.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.*","iqamarecipient.recipient_name as recipient_name","iqamaacknowledgements.file_url as ack_file_url","iqamaacknowledgements.receive_date as ack_receive_date","contact.display_name as display_name","iqamaacknowledgements.id as iqamaacknowledgementsID")
                    ->get();
            }

            $count = count($acknowledgement);

        }

       $userType = Auth::user()["type"];
       return view('iqama::Delivery.Acknowledgement.index',compact('userType','acknowledgement','completed','left','count'));
    }

    public function add($id)
    {
        $userType = Auth::user()["type"];
        $recruit = Receipient::leftjoin("recruitingorder","recruitingorder.id","iqamarecipient.recruitingorder_id")
                                       ->leftjoin("iqamaacknowledgements","recruitingorder.id","iqamaacknowledgements.recruitingorder_id")
                                       ->where("recruitingorder.id",$id)
                                       ->select("recruitingorder.*","iqamarecipient.recipient_name as rec_recipient_name","iqamaacknowledgements.file_url as ack_file_url","iqamaacknowledgements.receive_date as ack_receive_date")
                                       ->first();

       if(!$recruit || !$userType==0)
       {
           abort(403);
       }

     return view('iqama::Delivery.Acknowledgement.create',compact('userType','recruit'));

    }

    public function addAndUpdate(Request $request,$id)
    {
       if(is_null($id)){
           abort(403);
       }
        try{


            $ack =  new AcknowledgementResponse();
            $ack->save($request,$id);

            return redirect()->route("iqama_Delivery_acknowledgement_index")
                ->with('alert.status', 'success')
                ->with('alert.message', "Success");
        }catch(\Exception $exception){

            $msg = $exception->getMessage();
            return redirect()->route("iqama_Delivery_acknowledgement_index")
                ->with('alert.status', 'danger')
                ->with('alert.message', "fail: $msg");
        }

    }


    public function pdf($id)
    {
        $userType = Auth::user()["type"];
        if(!$userType==0)
        {
            abort(403);
        }
        try{
            $recruit = Receipient::leftjoin("recruitingorder","recruitingorder.id","iqamarecipient.recruitingorder_id")
                ->leftjoin("iqamaacknowledgements","recruitingorder.id","iqamaacknowledgements.recruitingorder_id")
                ->where("recruitingorder.id",$id)
                ->select("recruitingorder.*","iqamarecipient.recipient_name as rec_recipient_name","iqamarecipient.relational_passenger as relational_passenger","iqamaacknowledgements.receive_date as ack_receive_date","iqamaacknowledgements.file_url as file_url")
                ->first();

            $img_type = 0;

            $mime_types = ['png','jpe','jpeg','jpg','gif','bmp','ico','tiff','tif','svg','svgz'];

            //dd($mime_types);
            $img = pathinfo($recruit['file_url']);

            foreach($mime_types as $all)
            {
                if($all == $img['extension'])
                    $img_type = 1;
            }

            $OrganizationProfile = OrganizationProfile::find(1);
            $header =  new TemplateHeader();
            $header = $header->getBanner();

            $image = public_path().'/'.$header->file_url;
            $image_2 = public_path().'/'.$recruit["file_url"];

            // $image_main = file_put_contents($image);
            // dd($image_main);
            $pdf = PDF::loadView('iqama::Delivery.Acknowledgement.pdf',compact('OrganizationProfile','recruit','img_type',"header",'image','image_2'));
            return $pdf->stream();


        }catch(\Exception $exception){

            abort(404);
        }

    }

    public function download($id)
    {

        $ext = array("pdf","jpeg","png","gif","txt");
        if(is_null($id)){
            abort(404);
        }
        $file = Receipient::leftjoin("recruitingorder","recruitingorder.id","iqamarecipient.recruitingorder_id")
            ->leftjoin("iqamaacknowledgements","recruitingorder.id","iqamaacknowledgements.recruitingorder_id")
            ->where("iqamaacknowledgements.id",$id)
            ->select("iqamaacknowledgements.file_url as file_url")
            ->first();

        if(is_null($file))
        {
            abort(403);
        }

        try{
            if(!$file)
            {
                throw  new \Exception("file not found");
            }
            $file_path= ($file["file_url"]);

            $type = explode("/",mime_content_type($file_path))[1];

            if(in_array($type,$ext))
            {

                return response()->file($file_path);
            }

            $headers = array(
                "Content-Type: mime_content_type($file_path)",
            );
            return Response::download($file_path,'',$headers);
        }
        catch(\Exception $exception)
        {
            abort(404);
        }

    }

}
