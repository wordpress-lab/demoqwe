<?php

namespace App\Modules\Pms\Http\Controllers\Leave;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

//Models
use App\Models\Pms\PmsLeaveAssign;
use App\Models\Pms\Pms_Employee;

class AssignController extends Controller
{
    public function index()
    {
        $assign = PmsLeaveAssign::latest()->get();

        return view('pms::Assign.index',compact('assign'));
    }

    public function create()
    {
        $employee = Pms_Employee::all();

        return view('pms::Assign.create',compact('employee'));
    }

    public function store(Request $request)
    {
        $inputdata =[
            'pms_employee_id' => 'required',
            'start' => 'required',
            'end' => 'required',
        ];
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $user = Auth::id();

        $start_time = date('Y-m-d H:i:s', strtotime($input['start']));
        $end_time = date('Y-m-d H:i:s', strtotime($input['end']));

        $insert = new PmsLeaveAssign;

        $insert->pms_employee_id        = $input['pms_employee_id'];
        $insert->leave_from             = $start_time;
        $insert->leave_to               = $end_time;
        $insert->created_by             = $user;
        $insert->updated_by             = $user;

        $insert->save();

        return Redirect::route('pms_leave_assign_index')->withInput()->with(['alert.message' => 'Leave assigned inserted succcessfully','alert.status' => 'success']);

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $employee = Pms_Employee::all();
        $assign = PmsLeaveAssign::find($id);

        return view('pms::Assign.edit',compact('employee','assign'));
    }

    public function update(Request $request, $id)
    {
        $inputdata =[
            'start' => 'required',
            'end' => 'required',
        ];
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $input = $request->all();
        $user = Auth::id();

        $start_time = date('Y-m-d H:i:s', strtotime($input['start']));
        $end_time = date('Y-m-d H:i:s', strtotime($input['end']));

        $insert = PmsLeaveAssign::find($id);

        $insert->leave_from             = $start_time;
        $insert->leave_to               = $end_time;
        $insert->updated_by             = $user;

        $insert->update();

        return Redirect::route('pms_leave_assign_index')->withInput()->with(['alert.message' => 'Leave assigned updated succcessfully','alert.status' => 'success']);
    }

    public function destroy($id)
    {
        $delete = PmsLeaveAssign::find($id);

        if($delete->delete()){
            return back()->withInput()->with(['alert.message' => 'Leave assigned deleted succcessfully','alert.status' => 'success']);
        }
        else{
            return back()->withInput()->with(['alert.message' => 'Leave assigned deleted failed!!','alert.status' => 'danger']);
        }
    }
}
