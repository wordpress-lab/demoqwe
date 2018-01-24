<?php

namespace App\Modules\Recruitment\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\Recruit\ArrivalRecruit;
use App\Models\Recruit\Recruitorder;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class ArrivalRecruitController extends Controller
{
    public function download($id)
    {
        try{
            if(is_null($id))
            {
                throw new \Exception("This file is not available");
            }
            $file = ArrivalRecruit::find($id);
            if(!$file)
            {
                throw new \Exception("This file is not available");
            }
            $path = public_path("all_image/".$file->file_url);
            $mime = mime_content_type($path);
            if($mime=="application/msword")
            {
                return Response::download($path);
            }

            return Response::make(file_get_contents($path), 200, [
                'Content-Type' => $mime,
                'Content-Disposition' => 'inline; filename="'.$file->file_url.'"'
            ]);
        }catch (\Exception $exception){

            $msg=  $exception->getMessage();
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "Sorry, $msg.");
        }
    }

    public function index($id=null)
    {
        $completed = ArrivalRecruit::whereNotNull('arrival_number')
                                            ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'arrival_recruit.recruitorder_id')
                                            ->where('recruitingorder.status' , 1)
                                            ->count();

        $left_temp = Recruitorder::where('status' , 1)->count();

        $left = $left_temp - $completed;

        $id=$id;

        if(isset($request->all)){
            $count = $request->id;
            if (is_null($id))
            {
                if (session('branch_id')==1){

                    $branch=Branch::all();
                    $recruit=Recruitorder::join('confirmations','recruitingorder.id','=','confirmations.pax_id')
                        ->where('recruitingorder.status','=',1)
                        ->where('confirmations.e_ticket_number','!=',null)
                        ->select('recruitingorder.*')
                        ->get();

                   // dd($recruit);

                    return view('recruitment::arrival_recruit.index',compact('id','branch','recruit','completed','left','count'));
                }
                else {

                    $branch=Branch::where('id',session('branch_id'))->get();
                    $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                        ->join('confirmations','recruitingorder.id','=','confirmations.pax_id')
                        ->where('users.branch_id',session('branch_id'))
                        ->where('recruitingorder.status',1)
                        ->where('confirmations.e_ticket_number' , '!=' , Null)
                        ->select('recruitingorder.*')
                        ->get();
                    return view('recruitment::arrival_recruit.index',compact('id','branch','recruit','completed','left','count'));
                }
            }
            else {

                $branch=Branch::all();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->join('confirmations','recruitingorder.id','=','confirmations.pax_id')
                    ->where('users.branch_id',$id)
                    ->where('recruitingorder.status',1)
                    ->where('confirmations.e_ticket_number' , '!=' , Null)
                    ->select('recruitingorder.*')
                    ->get();
                return view('recruitment::arrival_recruit.index',compact('id','branch','recruit','completed','left','count'));

            }
        }
        else{
            if (is_null($id))
            {
                if (session('branch_id')==1){

                    $branch=Branch::all();
                    $recruit=Recruitorder::join('confirmations','recruitingorder.id','=','confirmations.pax_id')
                        ->leftjoin('iqamaapproval','iqamaapproval.recruitingorder_id','recruitingorder.id')
                        ->whereNotNull('confirmations.date_of_flight')
                        ->where('iqamaapproval.apprivalstatus','!=',1)
                        ->orWhereNull('iqamaapproval.apprivalstatus')
                        ->where('recruitingorder.status','=',1)
                        ->where('confirmations.e_ticket_number','!=',null)
                        ->select('recruitingorder.*')
                        ->get();

                   // dd($recruit);
                    $count = count($recruit);
                    return view('recruitment::arrival_recruit.index',compact('id','branch','recruit','completed','left','count'));
                }
                else {

                    $branch=Branch::where('id',session('branch_id'))->get();
                    $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                        ->join('confirmations','recruitingorder.id','=','confirmations.pax_id')
                        ->leftjoin('iqamaapproval','iqamaapproval.recruitingorder_id','recruitingorder.id')
                        ->whereNotNull('confirmations.date_of_flight')
                        ->where('iqamaapproval.apprivalstatus','!=',1)
                        ->orWhereNull('iqamaapproval.apprivalstatus')
                        ->where('users.branch_id',session('branch_id'))
                        ->where('recruitingorder.status',1)
                        ->where('confirmations.e_ticket_number' , '!=' , Null)
                        ->select('recruitingorder.*')
                        ->get();
                    $count = count($recruit);
                    return view('recruitment::arrival_recruit.index',compact('id','branch','recruit','completed','left','count'));
                }
            }
            else {

                $branch=Branch::all();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->join('confirmations','recruitingorder.id','=','confirmations.pax_id')
                    ->leftjoin('iqamaapproval','iqamaapproval.recruitingorder_id','recruitingorder.id')
                    ->whereNotNull('confirmations.date_of_flight')
                    ->where('iqamaapproval.apprivalstatus','!=',1)
                    ->orWhereNull('iqamaapproval.apprivalstatus')
                    ->where('users.branch_id',$id)
                    ->where('recruitingorder.status',1)
                    ->where('confirmations.e_ticket_number' , '!=' , Null)
                    ->select('recruitingorder.*')
                    ->get();
                $count = count($recruit);
                return view('recruitment::arrival_recruit.index',compact('id','branch','recruit','completed','left','count'));

            }
        }
        
    }

    public function create($id){

        $recruit=Recruitorder::find($id);
        return view('recruitment::arrival_recruit.create',compact('recruit','id'));
    }


    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'recruitorder_id' => 'required',
            'arrival_number' => 'required',
            'file_url' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        if ($request->hasFile('file_url')){

            $fileName = uniqid().$request->file_url->getClientOriginalName();
            $request->file_url->move(public_path('all_image'), $fileName);

            $arrival=new ArrivalRecruit();
            $arrival->recruitorder_id=$request->recruitorder_id;
            $arrival->arrival_number=$request->arrival_number;
            $arrival->file_url=$fileName;
            $arrival->created_by=Auth::user()->id;
            $arrival->updated_by=Auth::user()->id;
            $arrival->save();

            return Redirect::route('arrival_recruit_index')->with('msg','Arrival Recruit Inserted Successfully');

        }else{

            $arrival=new ArrivalRecruit();
            $arrival->recruitorder_id=$request->recruitorder_id;
            $arrival->arrival_number=$request->arrival_number;
            $arrival->created_by=Auth::user()->id;
            $arrival->updated_by=Auth::user()->id;
            $arrival->save();

            return Redirect::route('arrival_recruit_index')->with('msg','Arrival Recruit Inserted Successfully');
        }

    }

    public function edit($id){
        $order=Recruitorder::all();
        $recruit=Recruitorder::find($id);
        return view('recruitment::arrival_recruit.edit',compact('recruit','order'));
    }

    public function update(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'recruitorder_id' => 'required',
            'arrival_number' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        if ($request->hasFile('file_url')){

            $fileName = uniqid().$request->file_url->getClientOriginalName();
            $request->file_url->move(public_path('all_image'), $fileName);

            $arrival=ArrivalRecruit::find($id);
            $arrival->recruitorder_id=$request->recruitorder_id;
            $arrival->arrival_number=$request->arrival_number;
            $arrival->file_url=$fileName;
            $arrival->created_by=Auth::user()->id;
            $arrival->updated_by=Auth::user()->id;
            $arrival->save();

            return Redirect::route('arrival_recruit_index')->with('msg','Arrival Recruit Updated Successfully');

        }else{

            $arrival=ArrivalRecruit::find($id);
            $arrival->recruitorder_id=$request->recruitorder_id;
            $arrival->arrival_number=$request->arrival_number;
            $arrival->created_by=Auth::user()->id;
            $arrival->updated_by=Auth::user()->id;
            $arrival->save();

            return Redirect::route('arrival_recruit_index')->with('msg','Arrival Recruit Updated Successfully');
        }
    }


}
