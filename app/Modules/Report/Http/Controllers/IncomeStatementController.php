<?php

namespace App\Modules\Report\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\ManualJournal\JournalEntry;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Modules\Report\Http\Response\AccountDetails;
use App\Modules\Report\Http\Response\IncomeStatementResponse;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class IncomeStatementController extends Controller
{
    public function index()
    {
        $datalist = [];
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = date('d-M-Y',strtotime(date('Y-01-01')));
        $end = date('d-M-Y',strtotime(date('Y-12-31')));
        $OrganizationProfile = OrganizationProfile::find(1);
        $branch=Branch::all();

        $detail_url = route("index_data_account_report_account_details_all",["group"=>'',"id"=>'','start'=>$start,'end'=>$end]);
        return view('report::Ajax.incomestatement.index',compact('detail_url','start','end','OrganizationProfile','branch','branch_id'));
    }

    public function apiIndexDatalist(Request $request)
    {
        //ajax

        $start = date("Y-m-d",strtotime($request->start));
        $end = date("Y-m-d",strtotime($request->end));
        $incomestatemte_response = new IncomeStatementResponse($start,$end);
        $datalist = $incomestatemte_response->all();

        return response($datalist);
    }
    public function indexFilter(Request $request)
    {

        $datalist = [];

        $start = date("Y-m-d",strtotime($request->from_date));
        $end = date("Y-m-d",strtotime($request->to_date));
        $OrganizationProfile = OrganizationProfile::find(1);
        $branch=Branch::all();

        $detail_url = route("index_data_account_report_account_details_all",["id"=>'','start'=>$start,'end'=>$end,'group'=>'']);
        return view('report::Ajax.incomestatement.index',compact('detail_url','start','end','OrganizationProfile','branch','branch_id'));
    }

    public function accountDetails(Request $request,$start,$end,$id,$group)
    {

        if(!is_numeric($id))
        {
            return back();
        }
        $key = array_key_exists('account',$request->all());
        $type = $key?$request["account"]:null;
        $account_details = new AccountDetails($start,$end,$id,$group,$type);
        $account_name = $account_details->accountName($id);
        $report_data= $account_details->findById();
        $start = date("Y-m-d",strtotime($start));
        $end = date("Y-m-d",strtotime($end));
        $OrganizationProfile = OrganizationProfile::find(1);
        $branch=Branch::all();
        $detail_url = route("Api_index_data_account_report_account_details_all",["id"=>$id,'start'=>$start,'end'=>$end]);
        $report_data= $this->convertToJournalModel($report_data);
        return view('report::IncomeStatement.AccountDetails',compact('group','report_data','detail_url','account_name','start','end','OrganizationProfile','branch','branch_id'));
    }
    public function accountDetailsFilter(Request $request,$id,$group)
    {

        if(!is_numeric($id))
        {
            return back();
        }
        $start=date("Y-m-d",strtotime($request->from_date));
        $end=date("Y-m-d",strtotime($request->to_date));
        $key = array_key_exists('account',$request->all());
        $type = $key?$request["account"]:null;
        $account_details = new AccountDetails($start,$end,$id,$group,$type);
        $account_name = $account_details->accountName($id);
        $report_data= $account_details->findById();
        $start = date("Y-m-d",strtotime($start));
        $end = date("Y-m-d",strtotime($end));
        $OrganizationProfile = OrganizationProfile::find(1);
        $branch=Branch::all();
        $detail_url = route("Api_index_data_account_report_account_details_all",["id"=>$id,'start'=>$start,'end'=>$end]);
        $report_data= $this->convertToJournalModel($report_data);
        return view('report::IncomeStatement.AccountDetails',compact('group','report_data','detail_url','account_name','start','end','OrganizationProfile','branch','branch_id'));
    }
    public function apiAccountDetails(Request $request,$start,$end,$id)
    {
        $data = [];
        $account_details = new AccountDetails($start,$end,$id);
        $data= $account_details->findById();
        return $data;
    }

    public function convertToJournalModel($arrdata=[])
    {
        return JournalEntry::hydrate($arrdata);
    }


}
