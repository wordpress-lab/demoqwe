<?php

namespace App\Modules\Iqama\Http\Controllers\Insurance;

use App\Models\Branch\Branch;
use App\Models\Iqama\Insurance;
use App\Models\Iqama\Iqamaapprival;
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
      $completed = Insurance::whereNotNull('date_of_payment')
                                    ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'insurances.recruitingorder_id')
                                    ->where('recruitingorder.status' , 1)
                                    ->count();
      $left_temp = Recruitorder::where('status' , 1)->count();
      $left = $left_temp - $completed;
      if(isset($request->all))
      {
        $count = $request->id;
          if($branch_id==1)
          {
              $insurance = Insurance::join("recruitingorder","recruitingorder.id","insurances.recruitingorder_id")
                  ->where("recruitingorder.status",1)
                  ->select("recruitingorder.paxid as paxid","insurances.*")
                  ->get();
          }
          else
          {
              $insurance = Insurance::join("recruitingorder","recruitingorder.id","insurances.recruitingorder_id")
                  ->where("recruitingorder.status",1)
                  ->join('users','users.id','=','insurances.created_by')
                  ->where('users.branch_id',$branch_id)
                  ->select("recruitingorder.paxid as paxid","insurances.*")
                  ->get();
          }

      }
      elseif(isset($request->today))
      {
        $count = $request->id;
          if($branch_id==1)
          {
              $insurance = Insurance::join("recruitingorder","recruitingorder.id","insurances.recruitingorder_id")
                  ->where("recruitingorder.status",1)
                  ->whereDate("insurances.created_at",date("Y-m-d"))
                  ->select("recruitingorder.paxid as paxid","insurances.*")
                  ->get();
          }
          else
          {
              $insurance = Insurance::join("recruitingorder","recruitingorder.id","insurances.recruitingorder_id")
                  ->where("recruitingorder.status",1)
                  ->whereDate("insurances.created_at",date("Y-m-d"))
                  ->join('users','users.id','=','insurances.created_by')
                  ->where('users.branch_id',$branch_id)
                  ->select("recruitingorder.paxid as paxid","insurances.*")
                  ->get();
          }

      }
      else
      {
          if($branch_id==1)
          {
              $insurance = Insurance::join("recruitingorder","recruitingorder.id","insurances.recruitingorder_id")
                  ->leftjoin('iqamasubmissions','iqamasubmissions.recruitingorder_id','recruitingorder.id')
                  ->leftjoin('iqamaapproval','iqamaapproval.recruitingorder_id','recruitingorder.id')
                  ->where('iqamaapproval.apprivalstatus',1)
                  ->whereNull('iqamasubmissions.submission_date')
                  ->where("recruitingorder.status",1)
                  ->select("recruitingorder.paxid as paxid","insurances.*")
                  ->get();
          }
          else
          {
              $insurance = Insurance::join("recruitingorder","recruitingorder.id","insurances.recruitingorder_id")
                  ->leftjoin('iqamasubmissions','iqamasubmissions.recruitingorder_id','recruitingorder.id')
                  ->leftjoin('iqamaapproval','iqamaapproval.recruitingorder_id','recruitingorder.id')
                  ->where('iqamaapproval.apprivalstatus',1)
                  ->whereNull('iqamasubmissions.submission_date')
                  ->where("recruitingorder.status",1)
                  ->join('users','users.id','=','insurances.created_by')
                  ->where('users.branch_id',$branch_id)
                  ->select("recruitingorder.paxid as paxid","insurances.*")
                  ->get();
          }

          $count = count($insurance);

      }

   return view('iqama::Insurance.index',compact('insurance','completed','left','count'));
   }

   public function create()
   {
       $recruit = Recruitorder::leftjoin("iqamaapproval","iqamaapproval.recruitingorder_id","recruitingorder.id")
                                 ->where("iqamaapproval.apprivalstatus",1)
                                 ->select("recruitingorder.*")
                                 ->where("recruitingorder.status",1)
                                 ->get();

       return view('iqama::Insurance.create',compact('recruit'));
   }

   public function store(Request $request)
   {
       $this->validate($request, [
           'date_of_payment'  => 'required',
       ]);
       $authid = Auth::Id();
     try{
         foreach($request->recruitingorder_id as $value)
         {
             Insurance::updateOrCreate(
                 ["recruitingorder_id"=>$value],
                 [
                     'recruitingorder_id'=>$value,
                     "date_of_payment"=> $request->date_of_payment,
                     "created_by"=> $authid,
                     "updated_by"=> $authid
                 ]
             );
         }
         return redirect()->route("iqama_insurance_index")->with('alert.status', 'success')
             ->with('alert.message', 'Insurance added successfully.');
     }catch (\Exception $exception){

         return redirect()->route("iqama_insurance_index")->with('alert.status', 'danger')
             ->with('alert.message', 'Insurance added fail.');
     }

   }

   public function edit($id)
   {
       $recruit = Insurance::join("recruitingorder","recruitingorder.id","insurances.recruitingorder_id")
           ->select("recruitingorder.paxid as paxid","insurances.*")
           ->where("insurances.id",$id)
            ->first();

       return view('iqama::Insurance.edit',compact('recruit'));
   }

   public function update(Request $request,$id)
   {
       try{
           $authid = Auth::Id();
           $insurance = Insurance::find($id);
           $insurance->updated_by = $authid;
           $insurance->date_of_payment =$request->date_of_payment;
           $insurance->save();
           return redirect()->route("iqama_insurance_index")->with('alert.status', 'success')
               ->with('alert.message', 'Insurance updated successfully.');
       }catch (\Exception $exception){

           return redirect()->route("iqama_insurance_index")->with('alert.status', 'danger')
               ->with('alert.message', 'Insurance updated fail !.');
       }

   }

   public function destroy($id)
   {
       $insurance = Insurance::find($id);
       if($insurance)
       {
           $insurance->delete();
       }
       return redirect()->route("iqama_insurance_index")->with('alert.status', 'danger')
           ->with('alert.message', 'Insurance deleted successfully.');
   }
}
