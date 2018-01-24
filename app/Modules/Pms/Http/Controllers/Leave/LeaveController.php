<?php

namespace App\Modules\Pms\Http\Controllers\Leave;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

//Models
use App\Models\Pms\PmsLeaveSettings;

class LeaveController extends Controller
{
    public function index()
    {
        $settings = PmsLeaveSettings::first();
        return view('pms::Leave.create',compact('settings'));

    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'highest_allowed_leave' => 'required'
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $user = Auth::id(); 

        $settings = PmsLeaveSettings::first();

        $newUser = PmsLeaveSettings::updateOrCreate([
            'id'   => 1,
        ],[
            'highest_allowed_leave'     => $request->highest_allowed_leave,
            'created_by'                => $user,
            'updated_by'                => isset($settings->updated_by)?$settings->updated_by:$user
        ]);

        return back()->withInput()->with(['alert.message' => 'Leave setting updated succcessfully','alert.status' => 'success']);
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
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
