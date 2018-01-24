<?php

namespace App\Modules\Pms\Http\Controllers\Invoice;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Lib\Date\ArabicDate;

use mPDF;

//Models
use App\Models\Pms\PmsPayslip;
use App\Models\Pms\PmsInvoice;
use App\Models\Pms\PmsPayslipsPayment;
use App\Models\Pms\PmsReceipt;
use App\Models\Pms\PmsCompany;
use Auth;
use DB;

class PaymentController extends Controller
{
    public function index()
    {
        //
    }

    public function create($id)
    {
        $invoice_due_amount = PmsInvoice::find($id)->due_amount;

        if(is_null($invoice_due_amount)){
            $invoice_due_amount = 0;
        }

        return view('pms::PaymentReceive.create',compact('id','invoice_due_amount'));
    }

    public function store(Request $request)
    {
        $inputdata =[
            'date' => 'required',
            'amount' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        try{

            DB::beginTransaction();

            $input = $request->all();

            $user = Auth::id();

            $payment = PmsReceipt::max('number');

            if($payment)
            {
                $payment_number = $payment + 1;
            }
            else
            {
                $payment_number = 1;
            }
            $payment_number = str_pad($payment_number, 6, '0', STR_PAD_LEFT);

            $insert = new PmsReceipt;

            $insert->date                       = $input['date'];
            $insert->number                     = $payment_number;
            $insert->pms_invoices_id            = $input['pms_invoices_id'];
            $insert->amount                     = $input['amount'];
            $insert->note                       = $input['note'];
            $insert->created_by                 = $user;
            $insert->updated_by                 = $user;

            if($insert->save()){
                $payslip = PmsInvoice::find($input['pms_invoices_id']);

                $payslip->due_amount -= $input['amount'];
                $payslip->update();
            }

            DB::commit();
            return Redirect::route('pms_invoice_index')->withInput()->with('alert.status', 'success')
                    ->with('alert.message', 'Invoice Payment Receive Inserted Successfully!');

        }
        catch (\Exception $exception){
            DB::rollBack();
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
        }
    }

    public function show($id)
    {
        $payment = PmsReceipt::where('pms_invoices_id' , $id)->get();

        if(count($payment)==0){
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'No payment history');
        }

        return view('pms::PaymentReceive.show',compact('payment','id'));
    }

    public function edit($id)
    {
        $payment = PmsReceipt::find($id);

        return view('pms::PaymentReceive.edit',compact('payment'));
    }

    public function update(Request $request, $id)
    {
        $inputdata =[
            'date' => 'required',
            'amount' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        try{

            DB::beginTransaction();

            $input = $request->all();

            $user = Auth::id();

            $insert = PmsReceipt::find($id);

            $pre_due = $insert->amount;

            $insert->date                       = $input['date'];
            $insert->amount                     = $input['amount'];
            $insert->note                       = $input['note'];
            $insert->updated_by                 = $user;

            if($insert->update()){
                $payslip = PmsInvoice::find($insert->pms_invoices_id);

                $payslip->due_amount = ($payslip->due_amount+$pre_due-$input['amount']);
                $payslip->update();
            }

            DB::commit();
            return Redirect::route('pms_invoice_payment_receive_show',$insert->pms_invoices_id)->withInput()->with('alert.status', 'success')
                    ->with('alert.message', 'Invoice Payment Receive Updated Successfully!');

        }
        catch (\Exception $exception){
            DB::rollBack();
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
        }
    }

    public function destroy($id)
    {
        try{
            DB::beginTransaction();

            $delete = PmsReceipt::find($id);

            $pms_invoices_id = $delete->pms_invoices_id;
            $amount = $delete->amount;

            if($delete->delete()){

                $payslip = PmsInvoice::find($pms_invoices_id);

                $payslip->due_amount += $amount;
                $payslip->update();

                $data = PmsReceipt::where('pms_invoices_id',$pms_invoices_id)->get();

                if(count($data)==0){
                    DB::commit();
                    return Redirect::route('pms_invoice_index')->with(['alert.status' => 'danger','alert.message' => 'Payslip payment receive are not found!']);
                }

                DB::commit();
                return back()->with(['alert.status' => 'danger','alert.message' => 'Payslip Payment Receive Deleted Successfully!']);
            }
            else{
                DB::rollBack();
                return back()->with(['alert.status' => 'danger','alert.message' => 'Payslip Payment Receive Deleted Fail!']);
            }
        }
        catch (\Exception $exception){
            DB::rollBack();
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
        }
        
    }

    public function pdf($id)
    {
        $payment = PmsReceipt::where('pms_invoices_id' , $id)->get();

        if(count($payment)==0){
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'No payment history');
        }

        $invoice = PmsInvoice::find($id);
        $company = PmsCompany::find($invoice->pms_company_id);
        $date= ArabicDate::Convert(date('d-m-Y',strtotime($invoice->invoice_date)));
        $mpdf = new mPDF('utf-8', 'A4');
        $data = array("1","5","2","5","4","5","4","5","4","85","4","5","4","5","4","5","4","5","4","0");
        $view =  view('pms::PaymentReceive.payment_pdf',compact('data','date','invoice','company','payment'));
        $mpdf->WriteHTML($view);
        $mpdf->Output();
        
    }
}
