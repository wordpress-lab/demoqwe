<?php

namespace App\Modules\Kafala\Http\Controllers\Beforesixtydays;

use App\Models\Branch\Branch;
use App\Models\Iqama\Delivery\Iqamaacknowledgement;
use App\Models\Kafala\kafala;
use App\Models\Recruit\Recruitorder;
use Faker\Provider\cs_CZ\DateTime;
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
        $completed = kafala::whereNotNull('date_of_kafala')
                                    ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'kafalas.recruitingorder_id')
                                    ->where('recruitingorder.status' , 1)
                                    ->count();

        $left_temp = Recruitorder::where('status' , 1)->count();

        $left = $left_temp - $completed;
        if(isset($request->today))
        {
            if($branch_id==1)
            {
                $acknowledgement = Iqamaacknowledgement::leftjoin("recruitingorder", "recruitingorder.id", "iqamaacknowledgements.recruitingorder_id")
                    ->leftjoin('contact', 'contact.id', 'recruitingorder.customer_id')
                    ->leftjoin("kafalas", "recruitingorder.id", "kafalas.recruitingorder_id")
                    ->whereNotNull("iqamaacknowledgements.file_url")
                    ->where("iqamaacknowledgements.file_url", "!=", " ")
                    ->where("recruitingorder.status", 1)
                    ->whereDate("kafalas.created_at",date("Y-m-d"))
                    ->select("recruitingorder.*", "kafalas.date_of_kafala as date_of_kafala", "contact.display_name as display_name")
                    ->get();
            }
            else
            {
                $acknowledgement = Iqamaacknowledgement::leftjoin("recruitingorder", "recruitingorder.id", "iqamaacknowledgements.recruitingorder_id")
                    ->leftjoin('contact', 'contact.id', 'recruitingorder.customer_id')
                    ->leftjoin("kafalas", "recruitingorder.id", "kafalas.recruitingorder_id")
                    ->whereNotNull("iqamaacknowledgements.file_url")
                    ->where("iqamaacknowledgements.file_url", "!=", " ")
                    ->where("recruitingorder.status", 1)
                    ->whereDate("kafalas.created_at",date("Y-m-d"))
                    ->join('users','users.id','=','kafalas.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.*", "kafalas.date_of_kafala as date_of_kafala", "contact.display_name as display_name")
                    ->get();
            }

        }else {
            if($branch_id==1)
            {
                $acknowledgement = Iqamaacknowledgement::leftjoin("recruitingorder", "recruitingorder.id", "iqamaacknowledgements.recruitingorder_id")
                    ->leftjoin('contact', 'contact.id', 'recruitingorder.customer_id')
                    ->leftjoin("kafalas", "recruitingorder.id", "kafalas.recruitingorder_id")
                    ->whereNotNull("iqamaacknowledgements.file_url")
                    ->where("iqamaacknowledgements.file_url", "!=", " ")
                    ->where("recruitingorder.status", 1)
                    ->select("recruitingorder.*", "kafalas.date_of_kafala as date_of_kafala", "contact.display_name as display_name")
                    ->get();
            }
            else
            {
                $acknowledgement = Iqamaacknowledgement::leftjoin("recruitingorder", "recruitingorder.id", "iqamaacknowledgements.recruitingorder_id")
                    ->leftjoin('contact', 'contact.id', 'recruitingorder.customer_id')
                    ->leftjoin("kafalas", "recruitingorder.id", "kafalas.recruitingorder_id")
                    ->whereNotNull("iqamaacknowledgements.file_url")
                    ->where("iqamaacknowledgements.file_url", "!=", " ")
                    ->where("recruitingorder.status", 1)
                    ->join('users','users.id','=','kafalas.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select("recruitingorder.*", "kafalas.date_of_kafala as date_of_kafala", "contact.display_name as display_name")
                    ->get();
            }

        }
        return view('kafala::kafala.index',compact('acknowledgement','completed','left'));
    }

    public function create($id)
    {
        $kafala = Iqamaacknowledgement::leftjoin("recruitingorder","recruitingorder.id","iqamaacknowledgements.recruitingorder_id")
                                        ->leftjoin("kafalas","recruitingorder.id","kafalas.recruitingorder_id")
                                        ->whereNotNull("iqamaacknowledgements.file_url")
                                        ->where("iqamaacknowledgements.file_url","!="," ")
                                        ->where("recruitingorder.status",1)
                                        ->where("recruitingorder.id",$id)
                                        ->select("recruitingorder.*","kafalas.date_of_kafala as date_of_kafala","kafalas.company_name as company_name")
                                        ->first();

        return view('kafala::kafala.create',compact('kafala'));
    }

    public function store(Request $request,$id)
    {
        $this->validate($request, [
            'date_of_kafala'  => 'date',

        ]);
        if(is_null($id))
        {
            abort(403);
        }

        $receive = kafala::updateOrCreate(
            ['recruitingorder_id' => $id],
            ['date_of_kafala'=>!empty($request->date_of_kafala)?$request->date_of_kafala:null,'company_name'=>$request->company_name,'created_by'=>Auth::id(),'updated_by'=>Auth::id()]
        );
        $receive->saveOrFail();
        return redirect()->route("iqama_kafala_index")->with('alert.status', 'success')
                                                      ->with('alert.message', "Success");
    }
}
