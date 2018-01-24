<?php

namespace App\Modules\Settings\Http\Controllers\ticket\tickettax;

use App\Models\Visa\Ticket\TicketTax;
use App\Modules\Settings\Http\Requests\ticket\tax\CreatePostRequest;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use League\Flysystem\Exception;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $taxs = TicketTax::all();


        return view('settings::ticket.tickettax.index', compact('taxs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('settings::ticket.tickettax.create');
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
           $tax  = new TicketTax();
           $tax->title =$request->title;
           $tax->amount =$request->amount;
           $tax->created_by = Auth::id();
           $tax->updated_by = Auth::id();
           $tax->saveOrFail();
           return Redirect::route('ticket_tax')->with('alert.status', 'success')
               ->with('alert.message', 'Data saved!');
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
        $tax = TicketTax::find($id);
        return view('settings::ticket.tickettax.edit')->with('tax',$tax);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreatePostRequest $request, $id)
    {
        try{
            $tax  = TicketTax::find($id);
            $tax->title =$request->title;
            $tax->amount =$request->amount;

            $tax->updated_by = Auth::id();
            $tax->saveOrFail();
            return Redirect::route('ticket_tax')->with('alert.status', 'success')
                ->with('alert.message', 'Updated!');
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

            TicketTax::find($id)->delete();
            return Redirect::route('ticket_tax')->with('alert.status', 'danger')
                ->with('alert.message', 'Tax deleted successfully!');
        }catch (\Illuminate\Database\QueryException $ex){

            return back()->with('alert.status', 'success')
                ->with('alert.message', 'Not deleted!');;
        }
    }
}
