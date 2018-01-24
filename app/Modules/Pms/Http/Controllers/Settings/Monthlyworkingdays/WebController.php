<?php

namespace App\Modules\Pms\Http\Controllers\Settings\Monthlyworkingdays;

use App\Models\Pms\Pms_setting;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class WebController extends Controller
{
    public function index()
    {

      $settings= Pms_setting::where("title","monthly_working_days")->first();
      return view('pms::Settings.MonthlyWorkingHours.create',compact('settings'));

    }

    public function store(Request $request)
    {
        $stl  =  new \stdClass();
        $stl->rate = (float)$request->monthly_working_days;
        $pms_setting = Pms_setting::updateOrCreate([
            'title' => 'monthly_working_days',
        ],
        [
         'setting_data' => serialize($stl),
        ]);

        $pms_setting->save();

        return Redirect::route('pms_settings_index')->withInput()->with(['alert.message' => 'monthly hour rate inserted succcessfully','alert.status' => 'success']);
    }
}
