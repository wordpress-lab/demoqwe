<?php

namespace App\Modules\Pms\Http\Controllers\PayrollPayslip;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use mPDF;

//Models
use App\Models\Pms\PmsPayslip;
use App\Models\Pms\PmsPayrollSheet;
use App\Models\Pms\Pms_Employee;
use App\Models\Pms\PmsPayslipsPayment;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Modules\Pms\Http\Response\PayrollPdfResponse;
use Auth;

class PayslipController extends Controller
{
    public function index()
    {
        $payslip = PmsPayslip::all();

        return view('pms::Payslip.index' , compact('payslip'));
    }

    public function create()
    {
        // $sheet = PmsPayrollSheet::all();
        // $employee = Pms_Employee::all();

        // return view('pms::Payslip.create' , compact('sheet' , 'employee'));
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        // $payment = PmsPayslipsPayment::where('pms_payslips_id' , $id)->get();
        // dd($payment);
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }

    public function pdf($id)
    {
        $payslip = PmsPayslip::find($id);

        $pay = new PayrollPdfResponse($payslip->sheetId->id);
        $data =  $pay->get();

        foreach($data as $value){
            if($value['id'] == $payslip->pms_employees_id){
                $deduction_absense = $value['deductionAbsense'];
                $total_duction = $value['total_duction'];
                break;
            }
        }

        return view('pms::Payslip.payslip_pdf' , compact('payslip','deduction_absense','total_duction'));
    }
}
