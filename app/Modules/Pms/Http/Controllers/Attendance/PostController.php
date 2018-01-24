<?php

namespace App\Modules\Pms\Http\Controllers\Attendance;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Redirect;

//Models
use App\Models\Pms\Pms_Employee;
use App\Models\Pms\Pms_Site;
use App\Models\Pms\PmsAttendance;
use App\Models\Pms\PmsLeaveAssign;
use App\Models\OrganizationProfile\OrganizationProfile;
use DB;

use Carbon\Carbon;
use DateTime;

class PostController extends Controller
{
    public function index()
    {

        $attendance = PmsAttendance::groupBy('date')->groupBy('pms_site_id')->latest()->get();

        return view('pms::Attendance.index', compact('attendance'));
    }

    public function create()
    {
        $site = Pms_Site::all();
        $entry_date = date('Y-m-d');

        return view('pms::Attendance.create' , compact('site','entry_date'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'pms_site_id' => 'required',

        ]);

        $user = Auth::user()->id;

        $input = $request->all();

        $attendance = PmsAttendance::where(['pms_site_id' => $input['pms_site_id'],'date' => $input['date']])->get();

        $count = count($input['pms_employee_id']);

        if(!count($attendance))
        {
            for($i=0; $i<$count; $i++){

                $insert = new PmsAttendance;

                $insert->date                   = $input['date'];
                $insert->pms_site_id            = $input['pms_site_id'];
                $insert->created_by             = $user;
                $insert->updated_by             = $user;
                $insert->entrance_time          = date('H:i:s', strtotime($input['entrance_time'][$i]));
                $insert->leave_time             = date('H:i:s', strtotime($input['leave_time'][$i]));
                $insert->pms_employee_id        = $input['pms_employee_id'][$i];
                $insert->absense                = $input['absense'][$i];
                $insert->overtime               = $input['overtime'][$i];

                $insert->save();

            }

            return Redirect::route('pms_attendance_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Attendance added successfully!');
            
        }
        else
        {
            for($i=0; $i<$count; $i++){
                $insert = PmsAttendance::where(['pms_site_id' => $input['pms_site_id'],'date' => $input['date'],'pms_employee_id' => $input['pms_employee_id'][$i]])->first();

                $insert->updated_by             = $user;
                $insert->entrance_time          = date('H:i:s', strtotime($input['entrance_time'][$i]));
                $insert->leave_time             = date('H:i:s', strtotime($input['leave_time'][$i]));
                $insert->absense                = $input['absense'][$i];
                $insert->overtime               = $input['overtime'][$i];

                $insert->update();

            }

            return Redirect::route('pms_attendance_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Attendance updated successfully!');
        }

        
    }

    public function show($id)
    {
        $attendance = PmsAttendance::find($id);

        return view('pms::Attendance.show' , compact('attendance'));
    }

    public function edit($id,$date)
    {
        //$attendance = PmsAttendance::where(['pms_site_id' => $id,'date' => $date])->get();

        $attendance = PmsAttendance::join('pms__employees','pms__employees.id','pms_attendance.pms_employee_id')
                        ->where(['pms_site_id' => $id,'date' => $date])
                        ->selectRaw("pms__employees.id as id,pms__employees.name as name,pms__employees.code_name as code_name,pms_attendance.entrance_time as entrance_time,pms_attendance.leave_time as leave_time,pms_attendance.overtime as overtime,pms_attendance.absense as absense,(SELECT pms_leave_assigns.leave_from FROM pms_leave_assigns WHERE pms_leave_assigns.pms_employee_id=pms__employees.id AND '$date' > pms_leave_assigns.leave_from AND '$date' < pms_leave_assigns.leave_to) AS leave_from,(SELECT pms_leave_assigns.leave_to FROM pms_leave_assigns WHERE pms_leave_assigns.pms_employee_id=pms__employees.id AND '$date' > pms_leave_assigns.leave_from AND '$date' < pms_leave_assigns.leave_to) AS leave_to")
                        ->get();

        $site = Pms_Site::find($id);

        return view('pms::Attendance.edit' , compact('attendance','date','site'));
    }

    public function update(Request $request, $id,$date)
    { 
        $user = Auth::user()->id;

        $input = $request->all();

        $count = count($input['pms_employee_id']);

        for($i=0; $i<$count; $i++){
            $insert = PmsAttendance::where(['pms_site_id' => $id,'date' => $date,'pms_employee_id' => $input['pms_employee_id'][$i]])->first();

            $insert->updated_by             = $user;
            $insert->entrance_time          = date('H:i:s', strtotime($input['entrance_time'][$i]));
            $insert->leave_time             = date('H:i:s', strtotime($input['leave_time'][$i]));
            $insert->absense                = $input['absense'][$i];
            $insert->overtime               = $input['overtime'][$i];

            $insert->update();

        }

        return Redirect::route('pms_attendance_index')->withInput()->with('alert.status', 'success')
             ->with('alert.message', 'Attendance updated successfully!');
        
    }

    public function destroy($id,$date)
    {
        $delete = PmsAttendance::where(['pms_site_id' => $id,'date' => $date])->delete();

            return back()->with('alert.status', 'success')
             ->with('alert.message', 'Attendance deleted successfully!');
        
    }

    public function site($id,$date)
    {
        $site = Pms_Employee::where('site_name', $id)
                            ->leftJoin('pms_attendance','pms_attendance.pms_employee_id','pms__employees.id')
                            ->Where('pms_attendance.date',$date)
                            ->selectRaw("pms__employees.code_name as code_name,pms_attendance.pms_employee_id as id,pms_attendance.entrance_time as entrance_time,pms_attendance.leave_time as leave_time,pms_attendance.date as date,pms_attendance.overtime as overtime,pms__employees.daily_work_hour as daily_work_hour,(SELECT pms_leave_assigns.leave_from FROM pms_leave_assigns WHERE pms_leave_assigns.pms_employee_id=pms__employees.id AND '$date' > pms_leave_assigns.leave_from AND '$date' < pms_leave_assigns.leave_to) AS leave_from,(SELECT pms_leave_assigns.leave_to FROM pms_leave_assigns WHERE pms_leave_assigns.pms_employee_id=pms__employees.id AND '$date' > pms_leave_assigns.leave_from AND '$date' < pms_leave_assigns.leave_to) AS leave_to")
                            ->get();

        if(!count($site)){
            $site = Pms_Employee::where('site_name', $id)
                    ->selectRaw("pms__employees.id as id,pms__employees.code_name as code_name,pms__employees.daily_work_hour as daily_work_hour,(SELECT pms_leave_assigns.leave_from FROM pms_leave_assigns WHERE pms_leave_assigns.pms_employee_id=pms__employees.id AND '$date' > pms_leave_assigns.leave_from AND '$date' < pms_leave_assigns.leave_to) AS leave_from,(SELECT pms_leave_assigns.leave_to FROM pms_leave_assigns WHERE pms_leave_assigns.pms_employee_id=pms__employees.id AND '$date' > pms_leave_assigns.leave_from AND '$date' < pms_leave_assigns.leave_to) AS leave_to")
                    ->get();
        }
        
        return Response::json($site);
    }

    public function pdf($id,$date)
    {
        $OrganizationProfile = OrganizationProfile::first();
        //$attendance = PmsAttendance::where(['pms_site_id' => $id,'date' => $date])->get();

        $attendance = PmsAttendance::join('pms__employees','pms__employees.id','pms_attendance.pms_employee_id')
                        ->where(['pms_site_id' => $id,'date' => $date])
                        ->selectRaw("pms__employees.name as name,pms__employees.code_name as code_name,pms_attendance.entrance_time as entrance_time,pms_attendance.leave_time as leave_time,pms_attendance.overtime as overtime,pms_attendance.absense as absense,(SELECT pms_leave_assigns.leave_from FROM pms_leave_assigns WHERE pms_leave_assigns.pms_employee_id=pms__employees.id AND '$date' > pms_leave_assigns.leave_from AND '$date' < pms_leave_assigns.leave_to) AS leave_from,(SELECT pms_leave_assigns.leave_to FROM pms_leave_assigns WHERE pms_leave_assigns.pms_employee_id=pms__employees.id AND '$date' > pms_leave_assigns.leave_from AND '$date' < pms_leave_assigns.leave_to) AS leave_to")
                        ->get();

        $site = Pms_Site::find($id);

        return view('pms::Attendance.pdf' , compact('attendance','date','site','OrganizationProfile'));
    }
}
