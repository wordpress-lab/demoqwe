<?php

namespace App\Modules\Okala\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\Okala\Okala;
use App\Models\Recruit\Recruitorder;
use App\Models\Visa\Ticket\Order\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class OkalaController extends Controller
{
    public function index($id=null){

        $id=$id;

        if (is_null($id))
        {
            if (session('branch_id')==1){
                $branch=Branch::all();
                $recruit = Recruitorder::where('status' , 1)->get();
                return view('okala::okala.index', compact('id','branch','recruit'));
            }
            else {

                $branch=Branch::where('id',session('branch_id'))->get();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->where('users.branch_id',session('branch_id'))
                    ->where('recruitingorder.status',1)
                    ->select('recruitingorder.*')
                    ->get();
                    dd($recruit);
                return view('okala::okala.index', compact('id','branch','recruit'));
            }
        }
        else {

            $branch=Branch::all();
            $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                ->where('users.branch_id',$id)
                ->where('recruitingorder.status',1)
                ->select('recruitingorder.*')
                ->get();
            dd($recruit);
            return view('okala::okala.index', compact('id','branch','recruit'));

        }
    }

    public function create($id){

        $id=$id;
        $order=Recruitorder::all();
        return view('okala::okala.create',compact('order','id'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'paxid' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        if ($request->status==1){

            $result=new Okala();
            $result->date=$request->date;
            $result->comment=$request->comment;
            $result->status=1;
            $result->paxid=$request->paxid;
            $result->created_by=Auth::user()->id;
            $result->updated_by=Auth::user()->id;
            $result->save();
            return Redirect::route('okala_index')->with('create','Okala Created');
        }
        else{
            $result=new Okala();
            $result->date=$request->date;
            $result->comment=$request->comment;
            $result->status=0;
            $result->paxid=$request->paxid;
            $result->created_by=Auth::user()->id;
            $result->updated_by=Auth::user()->id;
            $result->save();
            return Redirect::route('okala_index')->with('create','Okala Created');
        }
    }

    public function edit($id){

        $okala=Okala::all();
        $recruit=Recruitorder::find($id);
        $order=Recruitorder::all();

        foreach ($okala as $value){
            if ($value->paxid==$recruit->id){
                return view('okala::okala.edit',compact('okala','order','recruit'));
            }
        }
        return Redirect::route('okala_create');
    }

    public function update(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'paxid' => 'required',
            'date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        if ($request->status==1){

            $result=Okala::find($id);
            $result->date=$request->date;
            $result->comment=$request->comment;
            $result->status=1;
            $result->paxid=$request->paxid;
            $result->created_by=Auth::user()->id;
            $result->updated_by=Auth::user()->id;
            $result->save();
            return Redirect::route('okala_index')->with('msg','Okala Updated');
        }
        else{
            $result=Okala::find($id);
            $result->date=$request->date;
            $result->comment=$request->comment;
            $result->status=0;
            $result->paxid=$request->paxid;
            $result->created_by=Auth::user()->id;
            $result->updated_by=Auth::user()->id;
            $result->save();
            return Redirect::route('okala_index')->with('msg','Okala Updated');
        }
    }

    public function delete($id){

        $company=Okala::find($id);
        $company->delete();
        return redirect()->back()->with('delete','Okala Deleted');
    }

}
