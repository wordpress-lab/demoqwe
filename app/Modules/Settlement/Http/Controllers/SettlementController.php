<?php

namespace App\Modules\Settlement\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Models
use App\Models\Recruit\Recruitorder;

class SettlementController extends Controller
{
    public function index()
    {
        $recruit = Recruitorder::where('status' , 1)->whereNotNull('invoice_id')->get();

        return view('settlement::index',compact('recruit'));

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $recruit = Recruitorder::find($id);

        $recruit->last_invoice_amount = $recruit->invoice['total_amount'];

        if($recruit->update()){
            return Redirect::route('invoice_edit', ['id' => $recruit->invoice_id,'amount' => $recruit->last_invoice_amount]);
        }
        
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
