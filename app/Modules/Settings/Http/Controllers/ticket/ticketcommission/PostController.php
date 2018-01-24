<?php

namespace App\Modules\Settings\Http\Controllers\ticket\ticketcommission;

use App\Models\Visa\Ticket\TicketCommission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
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
        $commission = TicketCommission::all();
        return view('settings::ticket.ticketcommission.index', compact('commission'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings::ticket.ticketcommission.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $tax  = new TicketCommission();
            $tax->commissionRate =$request->commissionRate;
            $tax->commissionTax =$request->commissionTax;

            $tax->saveOrFail();
            return Redirect::route('ticket_commission')->with('alert.status', 'success')
                ->with('alert.message', 'Data saved!');
        }catch (\Illuminate\Database\QueryException $ex){

            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Not Saved!');;;
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
    public function edit($id=null)
    {


        $tax = TicketCommission::first();

        if($tax){
            return view('settings::ticket.ticketcommission.edit')->with('commission',$tax);
        }else{

            $tax= TicketCommission::firstOrNew(['commissionTax' => 0]);
            $tax->commissionTax= 0;
            $tax->commissionRate= 0;
            $tax->save();
            return view('settings::ticket.ticketcommission.edit')->with('commission',$tax);
        }



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
            $tax  =TicketCommission::find($id);
            $tax->commissionRate =$request->commissionRate;
            $tax->commissionTax =$request->commissionTax;
            $tax->saveOrFail();
            return Redirect::route('ticket_commission_edit',0)->with('alert.status', 'success')
                ->with('alert.message', 'updated!');;;
        }catch (\Illuminate\Database\QueryException $ex){

            return back()->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(is_null($id)){
            return back();
        }
        try{

            TicketCommission::find($id)->delete();

            return Redirect::route('ticket_commission')->with('alert.status', 'danger')
                ->with('alert.message', 'Ticket Commission deleted successfully!');
        }catch (\Illuminate\Database\QueryException $ex){

            return back()->with('alert.status', 'success')
                ->with('alert.message', 'Not deleted!');;
        }
    }
}
