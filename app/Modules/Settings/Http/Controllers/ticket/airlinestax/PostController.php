<?php

namespace App\Modules\Settings\Http\Controllers\ticket\airlinestax;

use App\Models\Visa\Ticket\Airline\Airlines;
use App\Models\Visa\Ticket\Airline\Airlinetax;
use App\Models\Visa\Ticket\TicketTax;
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


        $airlinetax = Airlines::all();
        return view('settings::ticket.airlinestax.index', compact('airlinetax'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $airlines = Airlines::all();
        $tax = TicketTax::all();
        return view('settings::ticket.airlinestax.create',compact('airlines','tax'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $d= Airlinetax::where('airline_id',$request->airline_id);
       $d->delete();
       try{
           foreach ($request->tickettax_id as $value){
               $airlinetax = new Airlinetax();
               $airlinetax->airline_id = $request->airline_id;
               $airlinetax->tickettax_id = $value;
               $airlinetax->created_by = Auth::id();
               $airlinetax->updated_by = Auth::id();
               $airlinetax->save();
           }

           return Redirect::route('ticket_airlinestax')->with('alert.status', 'success')
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
        //
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
        //
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
        $d= Airlinetax::where('airline_id',$id);
        $d->delete();
        return Redirect::route('ticket_airlinestax')->with('alert.status', 'success')
            ->with('alert.message', 'Airlines  deleted!');
           }catch (\Illuminate\Database\QueryException $ex){

         return back()->withInput()->with('alert.status', 'danger')
          ->with('alert.message', 'Not deleted!');
         }
    }
}
