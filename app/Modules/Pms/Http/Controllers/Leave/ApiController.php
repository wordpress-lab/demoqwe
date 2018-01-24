<?php

namespace App\Modules\Pms\Http\Controllers\Leave;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

//Models
use App\Models\Pms\PmsLeaveSettings;
use App\Models\Pms\PmsLeaveAssign;

class ApiController extends Controller
{
	public function index()
	{
		$day = PmsLeaveSettings::first()->highest_allowed_leave;

		return Response::json($day);
	}

	public function create($id)
	{
		$leave = DB::select("SELECT SUM((UNIX_TIMESTAMP(pms_leave_assigns.leave_to)*1000)-(UNIX_TIMESTAMP(pms_leave_assigns.leave_from)*1000)) as sec FROM `pms_leave_assigns` WHERE pms_leave_assigns.pms_employee_id=$id");

		if(is_array($leave)){
			$leave = $leave[0]->sec;
			if(is_null($leave))
				$leave=0;
		}
		
		else
			$leave = 0;
		
		return Response::json($leave); 
	}
    
}
