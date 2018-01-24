<?php

namespace App\Modules\Hrm\Http\Controllers\Reception;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

//Model

use App\Models\Reception\ReciptionCategory;
use App\Models\Reception\ReciptionLogbook;

class WebController extends Controller
{
    public function index()
    {
        $category = ReciptionCategory::all();
        
        return view('hrm::reception.category.index' , compact('category'));
    }

    public function create()
    {
        return view('hrm::reception.category.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $category = new ReciptionCategory;

        $category->name                 = $request->name;
        $category->summary              = $request->summary;
        $category->created_by           = Auth::user()->id;
        $category->updated_by           = Auth::user()->id;

        $category->save();

        return redirect('hrm/reception/')->with('message' , 'Reception Insert Successfully');

    }

    public function show($id)
    {
        $category = ReciptionCategory::find($id);

        return view('hrm::reception.category.show' , compact('category'));
    }

    public function edit($id)
    {
        $category = ReciptionCategory::find($id);

        return view('hrm::reception.category.edit' , compact('category'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $category = ReciptionCategory::find($id);

        $category->name                 = $request->name;
        $category->summary              = $request->summary;
        $category->updated_by           = Auth::user()->id;

        $category->update();

        return redirect('hrm/reception/')->with('message' , 'Reception Updated Successfully');
    }

    public function destroy($id)
    {
        $category = ReciptionCategory::find($id);

        if($category->delete()){
            return back()->with('message' , 'Reception Deleted Successfully');
        }
        else{
            return back()->with('message' , 'Reception Update Failed');
        }
    }
}
