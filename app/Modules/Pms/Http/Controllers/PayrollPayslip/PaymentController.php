<?php

namespace App\Modules\Pms\Http\Controllers\PayrollPayslip;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

//Models
use App\Models\Pms\PmsPayslip;
use App\Models\Pms\PmsPayslipsPayment;
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
        $payslip_due_amount = PmsPayslip::find($id)->total_due;

        if(is_null($payslip_due_amount)){
            $payslip_due_amount = 0;
        }

        return view('pms::Payment.create',compact('id','payslip_due_amount'));
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

            $payment = PmsPayslipsPayment::max('number');

            if($payment)
            {
                $payment_number = $payment + 1;
            }
            else
            {
                $payment_number = 1;
            }
            $payment_number = str_pad($payment_number, 6, '0', STR_PAD_LEFT);

            $insert = new PmsPayslipsPayment;

            $insert->date                       = $input['date'];
            $insert->number                     = $payment_number;
            $insert->pms_payslips_id            = $input['pms_payslips_id'];
            $insert->amount                     = $input['amount'];
            $insert->note                       = $input['note'];
            $insert->created_by                 = $user;
            $insert->updated_by                 = $user;

            if($insert->save()){
                $payslip = PmsPayslip::find($input['pms_payslips_id']);

                $payslip->total_due -= $input['amount'];
                $payslip->update();
            }

            DB::commit();
            return Redirect::route('pms_payroll_payslip_index')->withInput()->with('alert.status', 'success')
                    ->with('alert.message', 'Payslip Payment Inserted Successfully!');

        }
        catch (\Exception $exception){
            DB::rollBack();
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
        }
    }

    public function show($id)
    {
        $payment = PmsPayslipsPayment::where('pms_payslips_id' , $id)->get();

        if(count($payment)==0){
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'No payment history');
        }

        return view('pms::Payment.show',compact('payment','id'));
    }

    public function edit($id)
    {
        $payment = PmsPayslipsPayment::find($id);

        return view('pms::Payment.edit',compact('payment'));
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

            $insert = PmsPayslipsPayment::find($id);

            $pre_due = $insert->amount;

            $insert->date                       = $input['date'];
            $insert->amount                     = $input['amount'];
            $insert->note                       = $input['note'];
            $insert->updated_by                 = $user;

            if($insert->update()){
                $payslip = PmsPayslip::find($insert->pms_payslips_id);

                $payslip->total_due = ($payslip->total_due+$pre_due-$input['amount']);
                $payslip->update();
            }

            DB::commit();
            return Redirect::route('pms_payroll_payment_show',$insert->pms_payslips_id)->withInput()->with('alert.status', 'success')
                    ->with('alert.message', 'Payslip Payment Updated Successfully!');

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

            $delete = PmsPayslipsPayment::find($id);

            $pms_payslips_id = $delete->pms_payslips_id;
            $amount = $delete->amount;

            if($delete->delete()){

                $payslip = PmsPayslip::find($pms_payslips_id);

                $payslip->total_due += $amount;
                $payslip->update();

                $data = PmsPayslipsPayment::where('pms_payslips_id',$pms_payslips_id)->get();

                if(count($data)==0){
                    DB::commit();
                    return Redirect::route('pms_payroll_payslip_index')->with(['alert.status' => 'danger','alert.message' => 'Payslip payment are not found!']);
                }
                DB::commit();
                return back()->with(['alert.status' => 'danger','alert.message' => 'Payslip Payment Deleted Successfully!']);
            }
            else{
                DB::rollBack();
                return back()->with(['alert.status' => 'danger','alert.message' => 'Payslip Payment Deleted Fail!']);
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
        $payslip = PmsPayslip::find($id);
        $payment = PmsPayslipsPayment::where('pms_payslips_id',$id)->latest()->get();

        if(count($payment)==0){
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'No payment history');
        }
        
        return view('pms::Payment.payment_pdf' , compact('payslip','payment'));
    }
}
