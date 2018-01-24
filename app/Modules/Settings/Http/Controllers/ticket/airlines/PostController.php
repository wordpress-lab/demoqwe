<?php

namespace App\Modules\Settings\Http\Controllers\ticket\airlines;

use App\Models\Visa\Ticket\Airline\Airlines;
use App\Modules\Settings\Http\Requests\ticket\airlines\CreatePostRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $airlines = Airlines::all();

        return view('settings::ticket.airlines.index', compact('airlines'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings::ticket.airlines.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        try{
            $airline  = new Airlines();
            $airline->name =$request->name;
            $airline->comment =$request->comment;
            $airline->created_by = Auth::id();
            $airline->updated_by = Auth::id();
            $airline->saveOrFail();
            return Redirect::route('ticket_airlines')->with('alert.status', 'success')
                ->with('alert.message', 'Airlines  saved!');
        }catch (\Illuminate\Database\QueryException $ex){

            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Not saved!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $airline =  Airlines::find($id);


        return view('settings::ticket.airlines.edit')->with('airline',$airline);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        try{
            $airline =  Airlines::find($id);
            $airline->name =$request->name;
            $airline->comment =$request->comment;
            $airline->updated_by = Auth::id();
            $airline->saveOrFail();
            return Redirect::route('ticket_airlines')->with('alert.status', 'success')
                ->with('alert.message', 'Airlines  Updated !');
        }catch (\Illuminate\Database\QueryException $ex){

            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Not Updated!');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id=null)
    {
        if(is_null($id)){
            return back();
        }
        try{

            Airlines::find($id)->delete();
            return Redirect::route('ticket_airlines')->with('alert.status', 'danger')
                ->with('alert.message', 'Airline deleted successfully!');
        }catch (\Illuminate\Database\QueryException $ex){

            return back()->with('alert.status', 'success')
                ->with('alert.message', 'Not deleted!');;
        }
    }
}
