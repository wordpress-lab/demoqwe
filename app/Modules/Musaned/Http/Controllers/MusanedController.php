<?php

namespace App\Modules\Musaned\Http\Controllers;


use App\Models\Branch\Branch;
use App\Models\Company\Company;
use App\Models\Musaned\Musaned;
use Illuminate\Support\Facades\Validator;
use App\Models\Recruit\Recruitorder;
use App\Models\PoliceClearance\PoliceClearance;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
class MusanedController extends Controller
{

    public function index($id=null)
    {

        $id=$id;

        if (is_null($id))
        {
            if (session('branch_id')==1){
                $branch=Branch::all();
                $recruit = Recruitorder::where('status',1)->get();
                return view('musaned::index',compact('id','branch','recruit'));
            }
            else { 

                $branch=Branch::where('id',session('branch_id'))->get();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->where('users.branch_id',session('branch_id'))
                    ->where('status',1)
                    ->select('recruitingorder.*')
                    ->get();
                return view('musaned::index',compact('id','branch','recruit'));
            }
        }
        else {

            $branch=Branch::all();
            $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                ->where('users.branch_id',$id)
                ->where('status',1)
                ->select('recruitingorder.*')
                ->get();
            return view('musaned::index',compact('id','branch','recruit'));

        }
    }

    public function create($id)
    {
        $fibbo = Musaned::all();
        $recrut=Recruitorder::all();
        $com=Company::all();

        return view('musaned::create', compact('fibbo','recrut','com','id'));

    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'paxid' => 'required',
            'isssue_date' => 'required',

        ]);
        if ($validator->fails()) {
            return Redirect::route('musaned_create')->withErrors($validator);
        }
        $fibbo = new Musaned();
        $fibbo->pax_id = $request->paxid;
        $fibbo->issue_date = $request->isssue_date;
        $fibbo->company_id = $request->cpname?$request->cpname:null;
        $fibbo->created_by = Auth::user()->id;
        $fibbo->updated_by = Auth::user()->id;
          //dd($fibbo);
         $fibbo->save();
          if( $fibbo->save())
         {
            return Redirect::route('musaned')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Musaned added successfully!');
        }else{
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
        }

    }

    public function edit($id)
    {
        $musanand=Musaned::all();
        $recruit=Recruitorder::find($id);
        $order=Recruitorder::all();
        $company=Company::all();
        foreach ($musanand as $value){
            if ($value->pax_id==$recruit->id){
                return view('musaned::edit', compact('musanand','recruit','order','company'));
            }
        }
        return Redirect::route('musaned_create',$id);


    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'paxid' => 'required',
            'isssue_date' => 'required',

        ]);
        if ($validator->fails()) {
            return Redirect::route('musaned_edit',$id)->withErrors($validator);
        }
        $fibbo=Musaned::find($id);
        $fibbo->pax_id = $request->paxid;
        $fibbo->issue_date = $request->isssue_date;
        $fibbo->company_id = $request->cpname;
        $fibbo->updated_by = Auth::user()->id;
        //return " $fibbo";
        $fibbo->update();

        if( $fibbo->update())
        {
            return Redirect::route('musaned')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Musaned Updated successfully!');
        }else{
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be Updated.');
        }

    }

    public function delete($id )
    {

        $fibbo = Musaned::find($id);
        $fibbo->delete();

        return back()->withInput()->with('alert.status', 'danger')
            ->with('alert.message', 'Musaned deleted.');

    }

}

