<?php

namespace App\Modules\Kafala\Http\Controllers\Aftersixtydays;

use App\Models\Branch\Branch;
use App\Models\Iqama\Delivery\Iqamaacknowledgement;
use App\Models\Kafala\Aftersixyday;
use App\Models\Recruit\Recruitorder;
use App\Models\Kafala\kafala;
use App\Modules\Kafala\Response\Aftersixtydays\AftersixtydaysResponse;
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

        $completed = Aftersixyday::whereNotNull('date_of_payment')
                                    ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'aftersixydays.recruitingorder_id')
                                    ->where('recruitingorder.status' , 1)
                                    ->count();

        $left_temp = Recruitorder::where('status' , 1)->count();

        $left = $left_temp - $completed;
        if(isset($request->today))
        {
            if($branch_id==1)
            {
                $acknowledgement = Iqamaacknowledgement::leftjoin("recruitingorder","recruitingorder.id","iqamaacknowledgements.recruitingorder_id")
                    ->leftjoin('contact','contact.id','recruitingorder.customer_id')
                    ->leftjoin("aftersixydays","recruitingorder.id","aftersixydays.recruitingorder_id")
                    ->whereNotNull("iqamaacknowledgements.file_url")
                    ->where("iqamaacknowledgements.file_url","!="," ")
                    ->where("recruitingorder.status",1)
                    ->whereDate("aftersixydays.created_at",date("Y-m-d"))
                    ->select("recruitingorder.*","aftersixydays.id as after_status","contact.display_name as display_name")
                    ->get();
            }
            else
            {
                $acknowledgement = Iqamaacknowledgement::leftjoin("recruitingorder","recruitingorder.id","iqamaacknowledgements.recruitingorder_id")
                    ->leftjoin('contact','contact.id','recruitingorder.customer_id')
                    ->leftjoin("aftersixydays","recruitingorder.id","aftersixydays.recruitingorder_id")
                    ->whereNotNull("iqamaacknowledgements.file_url")
                    ->where("iqamaacknowledgements.file_url","!="," ")
                    ->where("recruitingorder.status",1)
                    ->whereDate("aftersixydays.created_at",date("Y-m-d"))
                    ->join('users','users.id','=','aftersixydays.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.*","aftersixydays.id as after_status","contact.display_name as display_name")
                    ->get();
            }

        }else {

            if($branch_id==1)
            {
                $acknowledgement = Iqamaacknowledgement::leftjoin("recruitingorder", "recruitingorder.id", "iqamaacknowledgements.recruitingorder_id")
                    ->leftjoin('contact', 'contact.id', 'recruitingorder.customer_id')
                    ->leftjoin("aftersixydays", "recruitingorder.id", "aftersixydays.recruitingorder_id")
                    ->whereNotNull("iqamaacknowledgements.file_url")
                    ->where("iqamaacknowledgements.file_url", "!=", " ")
                    ->where("recruitingorder.status", 1)
                    ->select("recruitingorder.*", "aftersixydays.id as after_status", "contact.display_name as display_name")
                    ->get();
            }
            else
            {
                $acknowledgement = Iqamaacknowledgement::leftjoin("recruitingorder", "recruitingorder.id", "iqamaacknowledgements.recruitingorder_id")
                    ->leftjoin('contact', 'contact.id', 'recruitingorder.customer_id')
                    ->leftjoin("aftersixydays", "recruitingorder.id", "aftersixydays.recruitingorder_id")
                    ->whereNotNull("iqamaacknowledgements.file_url")
                    ->where("iqamaacknowledgements.file_url", "!=", " ")
                    ->where("recruitingorder.status", 1)
                    ->join('users','users.id','=','aftersixydays.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.*", "aftersixydays.id as after_status", "contact.display_name as display_name")
                    ->get();
            }

        }
        return view('kafala::Aftersixtydays.index',compact('acknowledgement','completed','left'));
    }

    public function create($id)
    {

        $response  = new AftersixtydaysResponse();
        $kafala = $response->singleRecruite($id);
        if(is_null($id) || is_null($kafala))
        {
            abort(403);
        }
        $userType = Auth::user()["type"];
        return view('kafala::Aftersixtydays.create',compact('userType','kafala'));
    }

    public function store(Request $request,$id)
    {

        $this->validate($request, [
            'grama_rate'  => 'required',
            'receive_date'  => 'date',
            'date_of_payment'  => 'date',

        ]);
        $kafalas =  new AftersixtydaysResponse();
       if(is_null($id) || is_null($kafalas->singleRecruite($id)))
        {
            abort(403);
        }

        $file_url = $kafalas->upload($request);
        $newdata =['date_of_payment'=>!empty($request->date_of_payment)?$request->date_of_payment:null,'receive_date'=>!empty($request->receive_date)?$request->receive_date:null,'grama_rate'=>$request->grama_rate,'created_by'=>Auth::id(),'updated_by'=>Auth::id()];
        if($file_url)
        {
           $newdata["file_url"] = $file_url;
        }

        $receive = Aftersixyday::updateOrCreate(
            ['recruitingorder_id' => $id],
            $newdata
        );
        $receive->saveOrFail();
        return redirect()->route("iqama_kafala_after_index")->with('alert.status', 'success')
                                                      ->with('alert.message', "Success");
    }


}
