<?php

namespace App\Modules\Manpowerservice\Http\Controllers;

use App\Models\Manpower\Manpower_service_progress;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;


class ManpowerServiceTicketController extends Controller
{

    public function index()
    {
        $progress=Manpower_service_progress::all();
        return view('manpowerservice::manpower_service_hotel.index', compact('progress'));
    }

    public function create()
    {
        return view('manpowerservice::manpower_service_hotel.create');
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $progress=new Manpower_service_progress();
        $progress->title=$request->title;
        $progress->note=$request->note;
        $progress->created_by=Auth::user()->id;
        $progress->updated_by=Auth::user()->id;
        $progress->save();
        return Redirect::route('manpower_service_hotel_index')->with('msg', 'Manpower Service Progress Status Inserted');

    }

    public function edit($id){

        $progress=Manpower_service_progress::find($id);
        return view('manpowerservice::manpower_service_hotel.edit',compact('progress'));
    }

    public function update(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'title' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $progress=Manpower_service_progress::find($id);
        $progress->title=$request->title;
        $progress->note=$request->note;
        $progress->created_by=Auth::user()->id;
        $progress->updated_by=Auth::user()->id;
        $progress->save();
        return Redirect::route('manpower_service_hotel_index')->with('msg', 'Progress Status Updated');

    }

    public function delete($id){

        $progress=Manpower_service_progress::find($id);
        $progress->delete();
        return redirect()->back()->with('del','Progress Status Deleted');
    }



}

