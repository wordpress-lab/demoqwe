<?php

namespace App\Modules\Kafala\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ApiPostController extends Controller
{
    public function summery()
    {
        //iqama
        $sql= "SELECT (SELECT COUNT(aftersixydays.id) FROM `aftersixydays` WHERE DATE(aftersixydays.created_at)=CURDATE()) as kafala_total_after_days,(SELECT COUNT(kafalas.id) FROM kafalas WHERE DATE(kafalas.created_at)=CURDATE()) as kafala_total_before_days";
        $results = DB::select( DB::raw($sql));
        return response($results);
    }
}
