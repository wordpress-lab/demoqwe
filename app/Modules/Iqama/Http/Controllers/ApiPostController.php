<?php

namespace App\Modules\Iqama\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ApiPostController extends Controller
{
    public function summery()
    {

      //iqama
      $sql = "SELECT (SELECT COUNT(iqamaacknowledgements.id) from iqamaacknowledgements WHERE DATE(iqamaacknowledgements.created_at) = CURDATE() ) as total_ack,(SELECT COUNT(iqamaclearance.id) from iqamaclearance WHERE DATE(iqamaclearance.created_at) = CURDATE() ) as total_clr ,(SELECT COUNT(iqamareceives.id) from iqamareceives WHERE DATE(iqamareceives.created_at) = CURDATE() ) as total_rcv,(SELECT COUNT(iqamarecipient.id) from iqamarecipient WHERE DATE(iqamarecipient.created_at) = CURDATE() ) as total_rcpnt,(SELECT COUNT(iqamasubmissions.id) from iqamasubmissions WHERE DATE(iqamasubmissions.created_at) = CURDATE() ) as total_subm,(SELECT COUNT(insurances.id) from insurances WHERE DATE(insurances.created_at) = CURDATE() ) as total_insur,(SELECT COUNT(iqamasubmissions.id) from iqamasubmissions WHERE DATE(iqamasubmissions.created_at) = CURDATE() ) as total_subm";
      $results = DB::select( DB::raw($sql));
      return response($results);
    }
}
