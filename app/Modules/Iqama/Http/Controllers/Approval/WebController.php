<?php

namespace App\Modules\Iqama\Http\Controllers\Approval;


use App\Models\Branch\Branch;
use App\Models\Iqama\Iqamaapprival;
use App\Models\Recruit\Recruitorder;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index(Request $request)
    {
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $usertype =0;
        $branch= [];
        $recruit = [];
        $completed = Iqamaapprival::where('apprivalstatus' , 1)
                                    ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'iqamaapproval.recruitingorder_id')
                                    ->where('recruitingorder.status' , 1)
                                    ->count();

        $left_temp = Recruitorder::where('status' , 1)->count();
        $left = $left_temp - $completed;
        if(isset($request->all))
        {
            $count = $request->id;
            if($branch_id==1)
            {
                $recruit = Recruitorder::leftjoin('arrival_recruit','arrival_recruit.recruitorder_id','recruitingorder.id')
                    ->whereNotNull('arrival_number')
                    ->where('status',1)
                    ->select('recruitingorder.*')
                    ->get();
            }
            else
            {
                $recruit = Recruitorder::leftjoin('arrival_recruit','arrival_recruit.recruitorder_id','recruitingorder.id')
                    ->whereNotNull('arrival_number')
                    ->where('status',1)
                    ->join('users','users.id','=','arrival_recruit.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select('recruitingorder.*')
                    ->get();
            }
        }
        else
        {
            if($branch_id==1)
            {
                $recruit = Recruitorder::leftjoin('arrival_recruit','arrival_recruit.recruitorder_id','recruitingorder.id')
                    ->leftjoin('insurances','insurances.recruitingorder_id','recruitingorder.id')
                    ->WhereNull('insurances.date_of_payment')
                    ->whereNotNull('arrival_number')
                    ->where('status',1)
                    ->select('recruitingorder.*')
                    ->get();
            }
            else
            {
                $recruit = Recruitorder::leftjoin('arrival_recruit','arrival_recruit.recruitorder_id','recruitingorder.id')
                    ->leftjoin('insurances','insurances.recruitingorder_id','recruitingorder.id')
                    ->WhereNull('insurances.date_of_payment')
                    ->whereNotNull('arrival_number')
                    ->where('status',1)
                    ->join('users','users.id','=','arrival_recruit.created_by')
                    ->where('users.branch_id',$branch_id)
                    ->select('recruitingorder.*')
                    ->get();
            }
            $count = count($recruit);
        }
        
        $usertype = Auth::user()['type'];
        return view('iqama::Approval.index',compact('branch','recruit','usertype','completed','left','count'));
    }
    public function submission($id=null)
    {

        $branch= [];
        $usertype = Auth::user()['type'];
        if(is_null($id))
        {
            return back()->with('alert.status', 'danger')
                ->with('alert.message', 'No Passenger found.');
        }
        $recruit = Recruitorder::with('invoice','customer')->find($id);

        if(!$recruit)
        {
            return back()->with('alert.status', 'danger')
                ->with('alert.message', 'No Passenger found.');
        }

        $iqama =  Iqamaapprival::where('recruitingorder_id',$id)->count();
        if(!$iqama)
        {
            $newIqama =  new Iqamaapprival();
            $newIqama->recruitingorder_id = $id;
            $newIqama->created_by = Auth::id();
            $newIqama->updated_by = Auth::id();
            $newIqama->save();
        }
        $total_due = Recruitorder::join('invoices','invoices.id','recruitingorder.invoice_id')
                                  ->where('recruitingorder.customer_id',$recruit['customer_id'])->sum('invoices.due_amount');

        $reference = Recruitorder::where('customer_id',$recruit['customer_id'])->where('status',1)->get();


        return view('iqama::Approval.approval',compact('branch','recruit','usertype','total_due','reference'));
    }
    public function confirm($id=null,$code=404)
    {
        if(is_null($id))
        {
            return back()->with('alert.status', 'danger')
                ->with('alert.message', 'No Passnger found.');
        }

        if($code==404)
        {
            return back()->with('alert.status', 'danger')
                ->with('alert.message', 'User has no access.');
        }
        try{
            DB::beginTransaction();
            $iqama =  Iqamaapprival::where('recruitingorder_id',$id)->first();
            if($iqama)
            {
                $iqama->apprivalstatus = $code;
                $iqama->created_by = Auth::id();
                $iqama->updated_by = Auth::id();
                $iqama->save();
            }
            if(!$iqama)
            {
                $iqama = new Iqamaapprival();
                $iqama->apprivalstatus = $code;
                $iqama->created_by = Auth::id();
                $iqama->updated_by = Auth::id();
                $iqama->save();
            }
            DB::commit();
            return redirect()->route('iqama_approval_index')->with('alert.status', 'success')
                                           ->with('alert.message', 'submission success');
        }catch(\Exception $ex){
            DB::rollBack();
            return back()->with('alert.status', 'danger')
                ->with('alert.message', 'submission fail');
        }

    }

}
