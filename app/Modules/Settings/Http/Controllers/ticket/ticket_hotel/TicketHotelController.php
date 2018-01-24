<?php

namespace App\Modules\Settings\Http\Controllers\ticket\ticket_hotel;

use App\Models\Ticket\Ticket_Hotel;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TicketHotelController extends Controller
{

    public function index()
    {
       $hotel=Ticket_Hotel::all();

        return view('settings::ticket.ticket_hotel.index', compact('hotel'));
    }

    public function create()
    {
        return view('settings::ticket.ticket_hotel.create');
    }

    public function store(Request $request){


        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'country' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }


            $hotel=new Ticket_Hotel();
            $hotel->title=$request->title;
            $hotel->country=$request->country;
            $hotel->address=$request->address;
            $hotel->note=$request->note;
            $hotel->created_by=Auth::user()->id;
            $hotel->updated_by=Auth::user()->id;
            $hotel->save();

            return Redirect::route('ticket_hotel_index')->with('msg', 'Ticket Hotel Inserted');

    }

    public function edit($id){

        $hotel=Ticket_Hotel::find($id);

        return view('settings::ticket.ticket_hotel.edit',compact('hotel'));
    }

    public function update(Request $request,$id){


        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'country' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $hotel=Ticket_Hotel::find($id);
        $hotel->title=$request->title;
        $hotel->country=$request->country;
        $hotel->address=$request->address;
        $hotel->note=$request->note;
        $hotel->created_by=Auth::user()->id;
        $hotel->updated_by=Auth::user()->id;
        $hotel->save();
        return Redirect::route('ticket_hotel_index')->with('msg', 'Ticket Hotel Updated');

    }

    public function delete($id){

        $hotel=Ticket_Hotel::find($id);

        $hotel->delete();
        return redirect()->back()->with('del','Ticket Hotel Deleted');
    }



}
