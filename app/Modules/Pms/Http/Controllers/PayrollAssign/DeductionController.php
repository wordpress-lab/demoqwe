<?php

namespace App\Modules\Pms\Http\Controllers\PayrollAssign;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

//Models
use App\Models\Pms\PmsAssignDeduction;
use App\Models\Pms\Pms_Employee;
use App\Models\Pms\PmsSector;
use Auth;

class DeductionController extends Controller
{
    public function index()
    {
        $allowance = PmsAssignDeduction::all();

        return view('pms::AssignDeduction.index' , compact('allowance'));
    }

    public function create()
    {
        $employee = Pms_Employee::all();
        $sector = PmsSector::where(['type' => 0 , 'required' => 0])->get();

        return view('pms::AssignDeduction.create' , compact('employee' , 'sector'));
    }

    public function store(Request $request)
    {
        $inputdata =[
            'date' => 'required',
            'pms_employees_id' => 'required',
            'pms_sectors_id' => 'required',
            'amount' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        $user = Auth::id();

        $insert = new PmsAssignDeduction;

        $insert->date                       = $input['date'];
        $insert->pms_employees_id           = $input['pms_employees_id'];
        $insert->pms_sectors_id             = $input['pms_sectors_id'];
        $insert->amount                     = $input['amount'];
        $insert->created_by                 = $user;
        $insert->updated_by                 = $user;

        $insert->save();

        return Redirect::route('pms_assign_deduction_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Assign Deduction Inserted Successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $allowance = PmsAssignDeduction::find($id);
        $employee = Pms_Employee::all();
        $sector = PmsSector::where(['type' => 0 , 'required' => 0])->get();

        return view('pms::AssignDeduction.edit' , compact('allowance' , 'employee' , 'sector'));
    }

    public function update(Request $request, $id)
    {
        $inputdata =[
            'date' => 'required',
            'pms_employees_id' => 'required',
            'pms_sectors_id' => 'required',
            'amount' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        $user = Auth::id();

        $insert = PmsAssignDeduction::find($id);

        $insert->date                       = $input['date'];
        $insert->pms_employees_id           = $input['pms_employees_id'];
        $insert->pms_sectors_id             = $input['pms_sectors_id'];
        $insert->amount                     = $input['amount'];
        $insert->updated_by                 = $user;

        $insert->update();

        return Redirect::route('pms_assign_deduction_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Assign Deduction Updated Successfully!');
    }

    public function destroy($id)
    {
        $delete = PmsAssignDeduction::find($id);

        if($delete->delete()){
            return back()->with(['alert.status' => 'success','alert.message' => 'Assign Deduction Deleted Successfully!']);
        }
        else{
            return back()->with(['alert.status' => 'danger','alert.message' => 'Assign Deduction Deleted Fail!']);
        }
    }
}
