<?php

namespace App\Modules\Settings\Http\Controllers;

use App\Models\Contact\Contact;
use App\Models\Visa\Ticket\Order\Order;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use mPDF;

//Models
use App\Models\Ticket\TicketRefund;
use App\Models\Ticket\TicketRefundOthers;
use App\Models\OrganizationProfile\OrganizationProfile;

class IataBillController extends Controller
{


    public function bill(){

            return view('settings::bill.bill');
    }

    public function find_bill(Request $request){

        $validator = Validator::make($request->all(), [
            'from_date' => 'required|max:255',
            'to_date' => 'required',
        ]);


        if ($validator->fails())
        {
           return Redirect::route('ticket_bill_index')->withErrors($validator);
        }

        $start = date("Y-m-d",strtotime($request->input('from_date')));
        $end =   date("Y-m-d",strtotime($request->input('to_date')));

        $order = Order::whereBetween('issuDate', [$start, $end])
                                    ->orderBy('issuDate','asc')
                                   ->get();

        $refund_others_adm_fee = TicketRefundOthers::whereBetween('date',[$start, $end])->sum('adm_fee');

        $refund_invoice = TicketRefund::join('invoices','invoices.id','ticket_refunds.invoice_id')
                                        ->join('contact','contact.id','ticket_refunds.vendor_id')
                                        ->whereBetween('ticket_refunds.submit_date', [$start, $end])
                                        ->where('contact.display_name','IATA')
                                        ->sum('invoices.total_amount');

        $refund_others_commission = TicketRefundOthers::whereBetween('date',[$start, $end])->sum('difference_of_airline_commission');

        //dd($refund_others_commission);

        $ita=[];
        foreach ($order as $item)
        {
            if($item->vendor->display_name=='IATA')
            {
                $ita[]=$item;
            }
        }

        $OrganizationProfile = OrganizationProfile::first();

        $mpdf = new mPDF('utf-8', 'A4-L');
        $view =  view('settings::bill.billing_pdf',compact('order','ita','start','end','refund_others_adm_fee','refund_invoice','refund_others_commission','OrganizationProfile'));
        $mpdf->WriteHTML($view);
        $mpdf->Output();

    }
}
