<?php

namespace App\Modules\Settings\Http\Controllers;

use App\Models\Contact\Contact;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Visa\Ticket\Order\Order;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

//Models
use App\Models\Ticket\TicketRefund;

class TicketDashboardController extends Controller
{

    public function vendor_pdf($start,$end)
    {
        $count=Order::leftjoin('bill','bill.id','=','ticketorders.bill_id')
            ->select(DB::raw('ticketorders.*,count(ticketorders.vendor_id) as total_order,count(ticketorders.bill_id) as total_bill,sum(bill.amount) as total_amount,sum(bill.due_amount) as due_amount'))
            ->whereBetween('ticketorders.issuDate',[$start, $end])
            ->groupBy('ticketorders.vendor_id')
            ->count();
        $OrganizationProfile = OrganizationProfile::find(1);
        if($count)
        {


            $vendor=Order::orderBy('ticketorders.issuDate','asc')->leftjoin('bill','bill.id','=','ticketorders.bill_id')
                ->select(DB::raw('ticketorders.*,count(ticketorders.vendor_id) as total_order,count(ticketorders.bill_id) as total_bill,sum(bill.amount) as total_amount,sum(bill.due_amount) as due_amount'))
                ->whereBetween('ticketorders.issuDate',[$start, $end])
                ->groupBy('ticketorders.vendor_id')
                ->get();

//            $pdf = PDF::loadView('settings::dashboard.vendorstatus',compact('OrganizationProfile','vendor','start','end'));
//            return $pdf->stream("vendor status");
            return view('settings::dashboard.vendorstatus',compact('OrganizationProfile','vendor','start','end'));
        }
        abort(404);

    }
    public function ticket_summery_pdf($start,$end)
    {
        $OrganizationProfile = OrganizationProfile::find(1);
        $order = Order::whereBetween('issuDate', [$start, $end])->count();
        if($order){
            $order = Order::orderBy('issuDate','asc')->whereBetween('issuDate', [$start, $end])->get();

           // $pdf = PDF::loadView('settings::dashboard.ticketsummery',compact('OrganizationProfile','order','start','end'));

            return view('settings::dashboard.ticketsummery',compact('OrganizationProfile','order','start','end'));
            // return $pdf->stream("ticket summery");
        }
      abort(404);

    }
    public function dashboard(){
        
        $start= Carbon::yesterday()->format('Y-m-d');
        $end= Carbon::today()->format('Y-m-d');
        $order=Order::whereDate('issuDate',$start)
            ->orderBy('issuDate','desc')
            ->get();
        $total=Order::leftjoin('bill','bill.id','=','ticketorders.bill_id')
            ->select(DB::raw('ticketorders.*,count(ticketorders.vendor_id) as total_order,count(ticketorders.bill_id) as total_bill,sum(bill.amount) as total_amount,sum(bill.due_amount) as due_amount'))
            ->whereBetween('ticketorders.issuDate',[$start, $end])
            ->groupBy('ticketorders.vendor_id')
            ->orderBy('issuDate','desc')
            ->get();
        //dd($order);

        $ticket = Order::where(DB::raw('DATEDIFF(CURDATE(),ticketorders.departureDate)'),'<=',7)->with('contact','invoice')->get();

        $refund = TicketRefund::whereDate('submit_date',$start)->latest()->get();

        $redund_invoice = TicketRefund::join('invoices','invoices.id','ticket_refunds.invoice_id')
                              ->whereDate('ticket_refunds.submit_date',$start)
                              ->sum('invoices.total_amount');
        $redund_payable = TicketRefund::join('bill','bill.id','ticket_refunds.bill_id')
                              ->whereDate('ticket_refunds.submit_date',$start)
                              ->sum('bill.amount');
        
        return view('settings::dashboard.index',compact('order','start','total','end','ticket','refund','redund_invoice','redund_payable'));
    }

    public function filter(Request $request){

        $validator = Validator::make($request->all(), [
            'from_date' => 'required|max:255',
            'to_date' => 'required',
        ]);
        if ($validator->fails()) {
            return Redirect::route('ticket_dashboard_index')->withErrors($validator);
        }
        $start = date("Y-m-d",strtotime($request->input('from_date')));
        $ends =$request->input('to_date');
        $end = date('Y-m-d',strtotime($ends . "+0 days"));
        $total=Order::leftjoin('bill','bill.id','=','ticketorders.bill_id')
                      ->select(DB::raw('ticketorders.*,count(ticketorders.vendor_id) as total_order,count(ticketorders.bill_id) as total_bill,sum(bill.amount) as total_amount,sum(bill.due_amount) as due_amount'))
                      ->whereBetween('ticketorders.issuDate',[$start, $end])
                      ->groupBy('ticketorders.vendor_id')
                       ->orderBy('issuDate','desc')
                      ->get();
        $order = Order::whereBetween('issuDate', [$start, $end])
            ->orderBy('issuDate','desc')
            ->get();
        $t= Carbon::today()->format('Y-m-d');
        $end = date('Y-m-d',strtotime($ends . "+0 days"));
        return view('settings::dashboard.index',compact('order','t','total','end','start'));
    }

    public function totalTicketOrderById($id,$start,$end){


        $order=Order::where('vendor_id',$id)
            ->whereBetween('issuDate',[$start, $end])
            ->get();

        return view('settings::dashboard.index2',compact('order','start','end','id'));

    }
    public function totalTicketOrderpdf($id,$start,$end){

       try{
           $vendor= '';
           $OrganizationProfile = OrganizationProfile::find(1);
           $order=Order::where('vendor_id',$id)
               ->orderBy('issuDate','asc')
               ->whereBetween('issuDate',[$start, $end])
               ->get();

           if(!count($order))
           {
               abort(404);
           }
           if(method_exists($order,'first'))
           {

               $vendor =$order->first()['vendor']->first()['display_name'];
           }
//           $pdf = PDF::loadView('settings::dashboard.singlevendorstatus',compact('OrganizationProfile','order','start','end','id','vendor'));
//           return $pdf->stream("vendor status details");
           return view('settings::dashboard.singlevendorstatus',compact('OrganizationProfile','order','start','end','id','vendor'));
       }catch (\Exception $exception){

          abort(404);
       }



    }


}
