<?php

namespace App\Modules\Pms\Http\Controllers\Expense;

use App\Models\Pms\Expense\Pmsexpense;
use Illuminate\Http\Request;
use App\Models\Pms\Expense\Pmssector;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class WebController extends Controller
{
    public function index()
    {

     $expense = Pmsexpense::with("sector")->get();
     return view('pms::Expense.Expense.index', compact('expense'));
    }

    public function create()
    {

     $sectors = Pmssector::all();
     return view('pms::Expense.Expense.create',compact('sectors'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'date' => 'required|max:255',
            'sector' => 'required',
            'amount' => 'required|numeric',
        ]);
        $id = Auth::id();

        $sector = new Pmsexpense();
        $sector->date =  $request->date;
        $sector->pmsexpense_sector_id =  $request->sector;
        $sector->amount =  $request->amount;
        $sector->paid =  $request->paid;
        $sector->due =  $request->amount-$request->paid;

        $sector->created_by =  $id;
        $sector->updated_by =  $id;
        try{
            $number = Pmsexpense::max("number")+1;
            $sector->number = str_pad($number,6,0,STR_PAD_LEFT);
            $sector->save();
            return redirect()->route('pms_expense_index')->with('alert.status', 'success')
                ->with('alert.message', 'Expense added successfully!');
        }catch (\Exception $exception){

            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Expense add fail!');
        }

    }

    public function edit($id)
    {
        $expense = Pmsexpense::find($id);
        $sectors = Pmssector::all();
        return view('pms::Expense.Expense.edit',compact('expense','sectors'));
    }

    public function update(Request $request,$id)
    {
        $sector = Pmsexpense::find($id);
        $this->validate($request, [
            'date' => 'required|max:255',
            'sector' => 'required',
            'amount' => 'required|numeric',
        ]);

        $id = Auth::id();

        $sector->date =  $request->date;
        $sector->pmsexpense_sector_id =  $request->sector;
        $sector->amount =  $request->amount;
        $sector->due =  ($sector->paid+$sector->due)-$request->paid;
        $sector->paid =  $request->paid;

        $sector->updated_by =  $id;
        try{
            $sector->save();
            return redirect()->route('pms_expense_index')->with('alert.status', 'success')
                ->with('alert.message', 'Expense update successfully!');
        }catch (\Exception $exception){
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Expense update fail!');
        }
    }
    public function pdf($id)
    {

    }

    public function history($id)
    {

    }

    public function pay()
    {

    }
    public function destroy($id)
    {

        try{
             Pmsexpense::find($id)->delete();
            return redirect()->route('pms_expense_index')->with('alert.status', 'danger')
                ->with('alert.message', 'Expense deleted !');
        }catch (\Exception $exception){
            return back()->withInput()->with('alert.status', 'warning')
                ->with('alert.message', 'Expense delete fail!');
        }
    }
}
