<?php

namespace App\Modules\Report\Http\Controllers;

use App\Models\Contact\Agent;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\Invoice;
use App\Models\OrganizationProfile\OrganizationProfile;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class SalesCommissionReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        $begin_time = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
       $journal = Invoice::groupBy('agents_id')->whereNotNull('agents_id')->whereBetween('created_at',array($start,$end))->selectRaw('agentcommissionAmount ,commission_type ,sum(total_amount) as sum, sum(CASE WHEN commission_type = "1" THEN (total_amount*agentcommissionAmount/100) WHEN commission_type = "2" THEN agentcommissionAmount ELSE 0 END) as payable, count(id) as totalinvoice, agents_id,sum(total_amount-due_amount) as receivable ')->get();
     //  $journal2 = Invoice::groupBy('agents_id')->whereNotNull('agents_id')->whereBetween('invoice_date',array($start,$end))->selectRaw('*')->get();

        return view('report::salesbyagent',compact('end','start','OrganizationProfile','journal'));
    }


    public function details($id,$start,$end)
    {



        $OrganizationProfile = OrganizationProfile::find(1);
        $start = $start." " ."00:00:00";
        $end = $end." " ."23:59:00";

       $ag= Agent::find($id);
        $journal = JournalEntry::whereBetween('created_at',array($start,$end))->where('jurnal_type','sales_commission')->where('agent_id',$id)->where('debit_credit',0)->get()->sortBy('assign_date');
        return view('report::single_agent_commission',compact('end','start','OrganizationProfile','journal','id','ag'));
    }

    public function detailsbydate(Request $request)
    {


        $OrganizationProfile = OrganizationProfile::find(1);
        $start = $request->start." " ."00:00:00";
        $end = $request->end." " ."23:59:00";
        $id = $request->id;
        $ag= Agent::find($id);
        $journal = JournalEntry::whereBetween('created_at',array($start, $end))->where('jurnal_type','sales_commission')->where('agent_id',$id)->where('debit_credit',0)->get()->sortBy('assign_date');
        return view('report::single_agent_commission',compact('end','start','OrganizationProfile','journal','id','ag'));
    }

    public function filterbydate(Request $request)
    {
        $OrganizationProfile = OrganizationProfile::find(1);
        $start =$request->from_date;
        if($request->to_date){
            $end = date('Y-m-d', strtotime($request->to_date . ' +1 day'));
        }else{
            $end  =$start;
        }


        $journal = Invoice::groupBy('agents_id')->whereNotNull('agents_id')->whereBetween('created_at',array($start,$end))->selectRaw('agentcommissionAmount ,commission_type ,sum(total_amount) as sum, sum(CASE WHEN commission_type = "1" THEN (total_amount*agentcommissionAmount/100) WHEN commission_type = "2" THEN agentcommissionAmount ELSE 0 END) as payable, count(id) as totalinvoice, agents_id,sum(total_amount-due_amount) as receivable ')->get();
        return view('report::salesbyagent',compact('end','start','OrganizationProfile','journal'));
    }




}
