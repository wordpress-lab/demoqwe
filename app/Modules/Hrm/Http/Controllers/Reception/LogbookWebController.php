<?php

namespace App\Modules\Hrm\Http\Controllers\Reception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

//Model
use App\Models\Contact\Contact;
use App\Models\Inventory\Item;
use App\Models\Reception\ReciptionCategory;
use App\Models\Reception\ReciptionLogbook;

class LogbookWebController extends Controller
{

    public function index()
    {
        $category = ReciptionLogbook::all();

        return view('hrm::reception.logbook.index' , compact('category'));
    }

    
    public function create()
    {
        $contact = Contact::all();
        $item = Item::all();
        $category = ReciptionCategory::all();
        return view('hrm::reception.logbook.create' , compact('contact' , 'item' , 'category'));
    }

    
    public function store(Request $request)
    {
        //dd($request->all());
        $validator = Validator::make($request->all(), [
            'category_id'                   => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $category = new ReciptionLogbook;

        $category->category_id                  = $request->category_id;
        if($request->associated_contact == 0)
        $category->associated_contact           = Null;
        else
        $category->associated_contact           = $request->associated_contact?$request->item_name: Null;
        $category->name                         = $request->name;
        $category->organization_name            = $request->organization_name;
        $category->contact_number               = $request->contact_number;
        $category->email                        = $request->email;
        $category->location_street              = $request->location_street;
        $category->location_city                = $request->location_city;
        $category->location_state               = $request->location_state;
        $category->location_zip_code            = $request->location_zip_code;
        $category->location_country             = $request->location_country;
        $category->department                   = $request->department;
        $category->item_name                    = $request->item_name?$request->item_name: Null;
        $category->symptom                      = $request->symptom;
        $category->remark                       = $request->remark;
        $category->meeting_date                 = $request->meeting_date;
        $category->meeting_time                 = $request->meeting_time;
        $category->created_by                   = Auth::user()->id;
        $category->updated_by                   = Auth::user()->id;

        $category->save();

        return redirect('hrm/reception/logbook/')->with('message' , 'Reception Logbook Insert Successfully');

    }

   
    public function show($id)
    {
        $category = ReciptionLogbook::find($id);

        return view('hrm::reception.logbook.show' , compact('category'));
    }

    
    public function edit($id)
    {
        $contact = Contact::all();
        $category = ReciptionLogbook::find($id);
        $reception = ReciptionCategory::all();
        $item = Item::all();

        return view('hrm::reception.logbook.edit' , compact('category' , 'reception' , 'item' , 'contact'));
    }

    
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'category_id'                   => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $category = ReciptionLogbook::find($id);

        $category->category_id                  = $request->category_id;
        if($request->associated_contact == 0)
        $category->associated_contact           = Null;
        else
        $category->associated_contact           = $request->associated_contact?$request->item_name: Null;
        $category->name                         = $request->name;
        $category->organization_name            = $request->organization_name;
        $category->contact_number               = $request->contact_number;
        $category->email                        = $request->email;
        $category->location_street              = $request->location_street;
        $category->location_city                = $request->location_city;
        $category->location_state               = $request->location_state;
        $category->location_zip_code            = $request->location_zip_code;
        $category->location_country             = $request->location_country;
        $category->department                   = $request->department;
        $category->item_name                    = $request->item_name?$request->item_name: Null;
        $category->symptom                      = $request->symptom;
        $category->remark                       = $request->remark;
        $category->meeting_date                 = $request->meeting_date;
        $category->meeting_time                 = $request->meeting_time;
        $category->updated_by                   = Auth::user()->id;

        $category->update();

        return back()->with('message' , 'Reception Logbook Updated Successfully');
    }

    
    public function destroy($id)
    {
        $category = ReciptionLogbook::find($id);

        if($category->delete()){
            return back()->with('message' , 'Reception Logbook Deleted Successfully');
        }
        else{
            return back()->with('message' , 'Reception Logbook Update Failed');
        }
    }

    public function info($id)
    {
        $contact = Contact::find($id);

        return Response::json($contact);
    }
}
