<?php

namespace App\Modules\Pms\Http\Controllers\PayrollAssign;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

//Models
use App\Models\Pms\PmsAssignAllowance;
use App\Models\Pms\Pms_Employee;
use App\Models\Pms\PmsSector;
use Auth;


class AllowanceController extends Controller
{
    public function index()
    {
        $allowance = PmsAssignAllowance::all();

        return view('pms::AssignAllowance.index' , compact('allowance'));
    }

    public function create()
    {
        $employee = Pms_Employee::all();
        $sector = PmsSector::where(['type' => 1 , 'required' => 0])->get();

        return view('pms::AssignAllowance.create' , compact('employee' , 'sector'));
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

        $insert = new PmsAssignAllowance;

        $insert->date                       = $input['date'];
        $insert->pms_employees_id           = $input['pms_employees_id'];
        $insert->pms_sectors_id             = $input['pms_sectors_id'];
        $insert->amount                     = $input['amount'];
        $insert->created_by                 = $user;
        $insert->updated_by                 = $user;

        $insert->save();

        return Redirect::route('pms_assign_allowance_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Assign Allowance Inserted Successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $allowance = PmsAssignAllowance::find($id);
        $employee = Pms_Employee::all();
        $sector = PmsSector::where(['type' => 1 , 'required' => 0])->get();

        return view('pms::AssignAllowance.edit' , compact('allowance' , 'employee' , 'sector'));
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

        $insert = PmsAssignAllowance::find($id);

        $insert->date                       = $input['date'];
        $insert->pms_employees_id           = $input['pms_employees_id'];
        $insert->pms_sectors_id             = $input['pms_sectors_id'];
        $insert->amount                     = $input['amount'];
        $insert->updated_by                 = $user;

        $insert->update();

        return Redirect::route('pms_assign_allowance_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Assign Allowance Updated Successfully!');
    }

    public function destroy($id)
    {
        $delete = PmsAssignAllowance::find($id);

        if($delete->delete()){
            return back()->with(['alert.status' => 'success','alert.message' => 'Assign Allowance Deleted Successfully!']);
        }
        else{
            return back()->with(['alert.status' => 'danger','alert.message' => 'Assign Allowance Deleted Fail!']);
        }
    }
}
