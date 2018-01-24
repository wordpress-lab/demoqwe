<?php

namespace App\Modules\Report\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Modules\Report\Http\Response\TotalTransaction;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class TotalTransectionController extends Controller
{


   public function index()
   {
       $OrganizationProfile = OrganizationProfile::find(1);
       $start = date("Y-m-d");
       $end = date("Y-m-d");
       $total_transaction = new TotalTransaction($start,$end);
       $branch = Branch::all();
       $journal=$total_transaction->getUpStairSheet();

       return view('report::total_account_transactions',compact('branch','end','start','OrganizationProfile','journal'));

   }

    public function filter(Request $request)
    {
        $OrganizationProfile = OrganizationProfile::find(1);
        $start = date("Y-m-d",strtotime($request->from_date));
        $end = date("Y-m-d",strtotime($request->to_date));

        $total_transaction = new TotalTransaction($start,$end);
        $branch = Branch::all();
        $journal=$total_transaction->getUpStairSheet();




        return view('report::total_account_transactions',compact('branch','end','start','OrganizationProfile','journal'));

    }
}
