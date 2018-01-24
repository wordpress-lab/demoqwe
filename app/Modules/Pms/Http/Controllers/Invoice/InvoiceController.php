<?php

namespace App\Modules\Pms\Http\Controllers\Invoice;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Lib\Date\ArabicDate;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use mPDF;

//Models
use App\Models\Pms\PmsInvoice;
use App\Models\Pms\PmsCompany;
use App\Models\Pms\PmsAttendance;
use App\Models\Pms\Pms_Site;
use App\Models\OrganizationProfile\OrganizationProfile;
use DB;
use Auth;

class InvoiceController extends Controller
{
    public function index()
    {
        $invoice = PmsInvoice::all();

        return view('pms::Invoice.index' , compact('invoice'));
    }

    public function create()
    {
        $site = Pms_Site::all();
        $company = PmsCompany::all();

        $invoice = PmsInvoice::max('invoice_number');

        if($invoice)
        {
            $invoice_number = $invoice + 1;
        }
        else
        {
            $invoice_number = 1;
        }
        $invoice_number = str_pad($invoice_number, 6, '0', STR_PAD_LEFT);

        return view('pms::Invoice.create' , compact('site' , 'company' , 'invoice_number'));
    }

    public function store(Request $request)
    {
        $inputdata =[
            'invoice_date' => 'required',
            'pms_sites_id' => 'required',
            'invoice_from_date' => 'required',
            'invoice_to_date' => 'required',
            'total_hours' => 'required',
            'per_hour_rate' => 'required',
            'total_amount' => 'required',
            'pms_company_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $invoice = PmsInvoice::max('invoice_number');

        if($invoice)
        {
            $invoice_number = $invoice + 1;
        }
        else
        {
            $invoice_number = 1;
        }
        $invoice_number = str_pad($invoice_number, 6, '0', STR_PAD_LEFT);

        $input = $request->all();

        $invoice_from_date = date('Y-m-d', strtotime($input['invoice_from_date']));
        $invoice_to_date = date('Y-m-d', strtotime($input['invoice_to_date']));
        
        $user = Auth::id();

        $insert = new PmsInvoice;

        $insert->invoice_date               = $input['invoice_date'];
        $insert->invoice_number             = $invoice_number;
        $insert->pms_sites_id               = $input['pms_sites_id'];
        $insert->pms_company_id             = $input['pms_company_id'];
        $insert->invoice_from_date          = $invoice_from_date;
        $insert->invoice_to_date            = $invoice_to_date;
        $insert->total_hours                = $input['total_hours'];
        $insert->per_hour_rate              = $input['per_hour_rate'];
        $insert->total_amount               = $input['total_amount'];
        $insert->created_by                 = $user;
        $insert->updated_by                 = $user;

        $insert->save();

        return Redirect::route('pms_invoice_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'PMS Invoice Inserted Successfully!');
    }

    public function show($id)
    {
        $invoice = PmsInvoice::find($id);
        $company = PmsCompany::find($invoice->pms_company_id);
        $date= ArabicDate::Convert(date('d-m-Y',strtotime($invoice->invoice_date)));
        $mpdf = new mPDF('utf-8', 'A4');
        $data = array("1","5","2","5","4","5","4","5","4","85","4","5","4","5","4","5","4","5","4","0");
        $view =  view('pms::Invoice.pms_invoice_pdf',compact('data','date','invoice','company'));
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }

    public function edit($id)
    {
        $invoice = PmsInvoice::find($id);
        $site = Pms_Site::all();
        $company = PmsCompany::all();

        return view('pms::Invoice.edit' , compact('invoice' , 'site' , 'company'));
    }

    public function update(Request $request, $id)
    {
        $inputdata =[
            'invoice_date' => 'required',
            'pms_sites_id' => 'required',
            'invoice_from_date' => 'required',
            'invoice_to_date' => 'required',
            'total_hours' => 'required',
            'per_hour_rate' => 'required',
            'total_amount' => 'required',
            'pms_company_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        $invoice_from_date = date('Y-m-d', strtotime($input['invoice_from_date']));
        $invoice_to_date = date('Y-m-d', strtotime($input['invoice_to_date']));
        
        $user = Auth::id();

        $insert = PmsInvoice::find($id);

        $insert->invoice_date               = $input['invoice_date'];
        $insert->pms_sites_id               = $input['pms_sites_id'];
        $insert->pms_company_id             = $input['pms_company_id'];
        $insert->invoice_from_date          = $invoice_from_date;
        $insert->invoice_to_date            = $invoice_to_date;
        $insert->total_hours                = $input['total_hours'];
        $insert->per_hour_rate              = $input['per_hour_rate'];
        $insert->total_amount               = $input['total_amount'];
        $insert->updated_by                 = $user;

        $insert->update();

        return Redirect::route('pms_invoice_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'PMS Invoice Updated Successfully!');
    }

    public function destroy($id)
    {
        $delete = PmsInvoice::find($id);

        if($delete->delete()){
            return back()->with(['alert.status' => 'danger','alert.message' => 'PMS Invoice Deleted Successfully!']);
        }
        else{
            return back()->with(['alert.status' => 'danger','alert.message' => 'PMS Invoice Deleted Fail!']);
        }
    }

    public function totalHour($id,$from,$to)
    {
        $from = date('Y-m-d',strtotime($from));
        $to = date('Y-m-d',strtotime($to));

        $total_hour = DB::select('SELECT SUM(UNIX_TIMESTAMP(pms_attendance.leave_time) - UNIX_TIMESTAMP(pms_attendance.entrance_time))/3600 AS total_hour FROM pms_attendance WHERE (pms_attendance.pms_site_id = :id) AND pms_attendance.date BETWEEN :from_p AND :to_p',['from_p'=>$from,'to_p'=>$to,'id'=>$id]);

        if(is_array($total_hour)){
            $total_hour = $total_hour[0]->total_hour;
            if(is_null($total_hour))
                $total_hour=0;
        }
        
        else
            $total_hour = 0;

        $site = Pms_Site::find($id)->wages_rate;

        if(empty($site))
            $site = 0;

        $total_amount = ($total_hour * $site);
        
        return Response::json(['total_hour' => $total_hour,'site' => $site,'total_amount' => $total_amount]);

    }
}
