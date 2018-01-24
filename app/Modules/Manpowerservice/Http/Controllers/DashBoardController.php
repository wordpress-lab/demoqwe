<?php

namespace App\Modules\Manpowerservice\Http\Controllers;

use App\Models\Manpower\Manpower_service;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Visa\Ticket\Order\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class DashBoardController extends Controller
{
    public function dashboard()
    {
        $start= Carbon::today()->format('Y-m-d');
        $end= Carbon::today()->format('Y-m-d');
        $order=Manpower_service::whereDate('issue_date',$start)
            ->orderBy('issue_date','desc')
            ->get();

        $total=Manpower_service::leftjoin('bill','bill.id','=','manpower_service.bill_id')
            ->select(DB::raw('manpower_service.*,count(manpower_service.vendor_id) as total_order,count(manpower_service.bill_id) as total_bill,sum(bill.amount) as total_amount,sum(bill.due_amount) as due_amount'))
            ->whereBetween('manpower_service.issue_date',[$start, $end])
            ->groupBy('manpower_service.vendor_id')
            ->orderBy('issue_date','desc')
            ->get();
        return view('manpowerservice::Dashboard.index',compact('order','start','total','end'));
    }
    public function dashboardfilter(Request $request)
    {

        $start= $request->from_date;
        $end= $request->to_date;

        $order=Manpower_service::whereBetween('issue_date',[$start,$end])
            ->orderBy('issue_date','desc')
            ->get();

        $total=Manpower_service::leftjoin('bill','bill.id','=','manpower_service.bill_id')
            ->select(DB::raw('manpower_service.*,count(manpower_service.vendor_id) as total_order,count(manpower_service.bill_id) as total_bill,sum(bill.amount) as total_amount,sum(bill.due_amount) as due_amount'))
            ->whereBetween('manpower_service.issue_date',[$start, $end])
            ->groupBy('manpower_service.vendor_id')
            ->orderBy('issue_date','desc')
            ->get();
        return view('manpowerservice::Dashboard.index',compact('order','start','total','end'));
    }

    public function totalmanpowerOrderById($id,$start,$end){


        $order=Manpower_service::where('vendor_id',$id)
            ->whereBetween('issue_date',[$start, $end])
            ->get();

        return view('manpowerservice::Dashboard.vendorstatusdetails',compact('order','start','end','id'));

    }
    public function manpower_summery_pdf($start,$end)
    {
        $OrganizationProfile = OrganizationProfile::find(1);
        $order = Manpower_service::whereBetween('issue_date', [$start, $end])->count();
        if($order)
        {
            $order = Manpower_service::orderBy('issue_date','asc')->whereBetween('issue_date', [$start, $end])->get();
            $pdf = PDF::loadView('manpowerservice::Dashboard.manpowerummery',compact('OrganizationProfile','order','start','end'));
            return $pdf->stream("manpower summery");
        }
        abort(404);

    }
    public function vendor_pdf($start,$end)
    {
        $count=Manpower_service::leftjoin('bill','bill.id','=','manpower_service.bill_id')
            ->select(DB::raw('manpower_service.*,count(manpower_service.vendor_id) as total_order,count(manpower_service.bill_id) as total_bill,sum(bill.amount) as total_amount,sum(bill.due_amount) as due_amount'))
            ->whereBetween('manpower_service.issue_date',[$start, $end])
            ->groupBy('manpower_service.vendor_id')
            ->count();
        $OrganizationProfile = OrganizationProfile::find(1);
        if($count)
        {
            $vendor=Manpower_service::orderBy('manpower_service.issue_date','asc')->leftjoin('bill','bill.id','=','manpower_service.bill_id')
                ->select(DB::raw('manpower_service.*,count(manpower_service.vendor_id) as total_order,count(manpower_service.bill_id) as total_bill,sum(bill.amount) as total_amount,sum(bill.due_amount) as due_amount'))
                ->whereBetween('manpower_service.issue_date',[$start, $end])
                ->groupBy('manpower_service.vendor_id')
                ->get();

            $pdf = PDF::loadView('manpowerservice::Dashboard.vendorstatus',compact('OrganizationProfile','vendor','start','end'));
            return $pdf->stream("vendor status");
        }
        abort(404);

    }

    public function totalManpowerOrderpdf($id,$start,$end){

        try{
            $vendor= '';
            $OrganizationProfile = OrganizationProfile::find(1);
            $order=Manpower_service::where('vendor_id',$id)
                ->orderBy('issue_date','asc')
                ->whereBetween('issue_date',[$start, $end])
                ->get();

            if(!count($order))
            {
                abort(404);
            }
            if(method_exists($order,'first'))
            {

                $vendor =$order->first()['vendor']->first()['display_name'];
            }
            $pdf = PDF::loadView('manpowerservice::Dashboard.singlevendorstatus',compact('OrganizationProfile','order','start','end','id','vendor'));
            return $pdf->stream("vendor status details");
        }catch(\Exception $exception){

            abort(404);
        }



    }
}
