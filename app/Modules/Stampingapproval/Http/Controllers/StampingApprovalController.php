<?php

namespace App\Modules\Stampingapproval\Http\Controllers;

use App\Models\Recruit\Recruitorder;
use App\Models\StampingApproval\StampingApproval;
use App\Models\Moneyin\PaymentReceives;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class StampingApprovalController extends Controller
{

    public function index(Request $request){

        $total_approve = StampingApproval::where('stampingapproval.status' , 1)
                        ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'stampingapproval.pax_id')
                        ->where('recruitingorder.status' , 1)
                        ->count();

        $total_disapprove = StampingApproval::where('stampingapproval.status' , 0)
                        ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'stampingapproval.pax_id')
                        ->where('recruitingorder.status' , 1)
                        ->count();

        $left_temp = Recruitorder::where('status' , 1)->count();

        $left = $left_temp - $total_approve - $total_disapprove;
        if(isset($request->all)){
            $count = $request->id;
            $recruit = Recruitorder::join('police_clearances','recruitingorder.id','=','police_clearances.paxid')
                                    ->where('recruitingorder.status',1)
                                    ->select('recruitingorder.*')
                                    ->get();
        }
        else{
            $recruit = Recruitorder::join('police_clearances','recruitingorder.id','=','police_clearances.paxid')
                                    ->leftjoin('visastamping','visastamping.pax_id','recruitingorder.id')
                                    ->whereNull('visastamping.send_date')
                                    ->where('recruitingorder.status',1)
                                    ->select('recruitingorder.*')
                                    ->get();
            $count = count($recruit);
        }
        

        //dd($recruit->stamp_approval['status']);

        return view('stampingapproval::stamp_approval.index',compact('id','branch','recruit','total_approve','total_disapprove','left','count'));
    }

    public function stampApproval($id){
        $recruit = Recruitorder::find($id);
        $payment_receive = PaymentReceives::where([['excess_payment','>',0],['customer_id','=',$recruit->customer_id]])->get();

            if ($recruit->createdBy['type']==0){

                return view('stampingapproval::stamp_approval.approval',compact('recruit' , 'payment_receive'));
            }else{
                return back()->withInput()->with('alert.status', 'danger')
                    ->with('alert.message', 'User not access.');
            }
        }

    public function stampApprovalConfirm(Request $request,$id,$remarks=null){

        $recruit=Recruitorder::find($id);

        $recruit->visa_category_id = $request->company_id;
        $recruit->save();

        $count=StampingApproval::where('pax_id',$recruit->id)->count();

        if ($count>0){
            $submission=StampingApproval::where('pax_id',$recruit->id)->first();
            $submission->status=1;
            $submission->remarks=$remarks;
            $submission->save();
        }else{

            $stamp=new StampingApproval();
            $stamp->pax_id=$recruit->id;
            $stamp->status=1;
            $stamp->remarks=$remarks;
            $stamp->created_by=Auth::user()->id;
            $stamp->updated_by=Auth::user()->id;
            $stamp->save();

        }

        return Redirect::route('stamp_approval_index')->with('msg','Owner Approval Confirmed.');

    }


    public function stampApprovalNotConfirm(Request $request,$id,$remarks=null){

        $recruit=Recruitorder::find($id);

        $recruit->visa_category_id = $request->company_id;
        $recruit->save();
        
        
        $count=StampingApproval::where('pax_id',$recruit->id)->count();

        if ($count>0){
            $submission=StampingApproval::where('pax_id',$recruit->id)->first();
            $submission->status=0;
            $submission->remarks=$remarks;
            $submission->created_by=Auth::user()->id;
            $submission->updated_by=Auth::user()->id;
            $submission->save();
        }else{

            $stamp=new StampingApproval();
            $stamp->pax_id=$recruit->id;
            $stamp->status=0;
            $stamp->remarks=$remarks;
            $stamp->created_by=Auth::user()->id;
            $stamp->updated_by=Auth::user()->id;
            $stamp->save();

        }

        return Redirect::route('stamp_approval_index')->with('msg','Owner Approval Not Confirmed..');
    }



}
