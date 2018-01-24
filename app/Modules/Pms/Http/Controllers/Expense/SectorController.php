<?php

namespace App\Modules\Pms\Http\Controllers\Expense;


use App\Models\Pms\Expense\Pmssector;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SectorController extends Controller
{
    public function index()
    {
        $sectors = Pmssector::all();
        return view('pms::Expense.Sector.index', compact('sectors'));
    }

    public function create()
    {

      return view('pms::Expense.Sector.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:pmssectors|max:255',
        ]);
        $id = Auth::id();

        $sector = new Pmssector();
        $sector->name =  $request->name;
        $sector->note =  $request->note;
        $sector->created_by =  $id;
        $sector->updated_by =  $id;
        try{
            $sector->save();
            return redirect()->route('pms_expense_sector_index')->with('alert.status', 'success')
                ->with('alert.message', 'Sector added successfully!');
        }catch (\Exception $exception){
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sector add fail!');
        }

    }

    public function edit($id)
    {
        $sector = Pmssector::find($id);
        return view('pms::Expense.Sector.edit',compact('sector'));
    }

    public function update(Request $request,$id)
    {
        $sector = Pmssector::find($id);
        if($sector->name!=$request->name){
            $this->validate($request, [
                'name' => 'required|unique:pmssectors|max:255',
            ]);
        }

        $id = Auth::id();

        $sector->name =  $request->name;
        $sector->note =  $request->note;
        $sector->updated_by =  $id;
        try{
            $sector->save();
            return redirect()->route('pms_expense_sector_index')->with('alert.status', 'success')
                ->with('alert.message', 'Sector update successfully!');
        }catch (\Exception $exception){
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sector update fail!');
        }
    }

    public function destroy($id)
    {

        try{
            $sector = Pmssector::find($id)->delete();
            return redirect()->route('pms_expense_sector_index')->with('alert.status', 'danger')
                ->with('alert.message', 'Sector deleted !');
        }catch (\Exception $exception){
            return back()->withInput()->with('alert.status', 'warning')
                ->with('alert.message', 'Sector delete fail!');
        }
    }
}
