<?php

namespace App\Modules\Pms\Http\Controllers\Payroll;

use App\Modules\Pms\Http\Response\PayrollPdfResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

//Models
use App\Models\Pms\PmsPayrollSheet;
use App\Models\Pms\PmsCompany;
use App\Models\Pms\PmsPayslip;
use App\Models\Pms\PmsPayslipAllowance;
use App\Models\Pms\PmsPayslipDeduction;
use App\Models\Pms\Pms_Site;
use Auth;
use DB;

use mPDF;


class SheetController extends Controller
{

    public function index()
    {
        $sheet = PmsPayrollSheet::all();

        return view('pms::Sheet.index' , compact('sheet'));
    }

    public function create()
    {
        $site = Pms_Site::all();
        $company = PmsCompany::all();

        return view('pms::Sheet.create' , compact('site','company'));
    }

    public function store(Request $request)
    {
        $inputdata =[
            'period_from' => 'required',
            'period_to' => 'required',
            'pms_company_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        $user = Auth::id();

        $insert = new PmsPayrollSheet;

        $insert->period_from                = $input['period_from'];
        $insert->period_to                  = $input['period_to'];
        $insert->pms_sites_id               = empty($input['pms_sites_id'])?Null:$input['pms_sites_id'];
        $insert->pms_company_id             = $input['pms_company_id'];
        $insert->status                     = 0;
        $insert->created_by                 = $user;
        $insert->updated_by                 = $user;

        $insert->save();

        return Redirect::route('pms_payroll_sheet_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Payroll Sheet Inserted Successfully!');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $sheet = PmsPayrollSheet::find($id);
        $company = PmsCompany::all();
        $site = Pms_Site::all();

        return view('pms::Sheet.edit' , compact('sheet' , 'site' , 'company'));
    }

    public function update(Request $request, $id)
    {
        $inputdata =[
            'period_from' => 'required',
            'period_to' => 'required',
            'pms_company_id' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $input = $request->all();

        $user = Auth::id();

        $insert = PmsPayrollSheet::find($id);

        $insert->period_from                = $input['period_from'];
        $insert->period_to                  = $input['period_to'];
        $insert->pms_sites_id               = empty($input['pms_sites_id'])?Null:$input['pms_sites_id'];
        $insert->pms_company_id             = $input['pms_company_id'];
        $insert->updated_by                 = $user;

        $insert->update();

        return Redirect::route('pms_payroll_sheet_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Payroll Sheet Updated Successfully!');
    }

    public function destroy($id)
    {
        $delete = PmsPayrollSheet::find($id);

        if($delete->delete()){
            return back()->with(['alert.status' => 'success','alert.message' => 'Payroll Sheet Deleted Successfully!']);
        }
        else{
            return back()->with(['alert.status' => 'danger','alert.message' => 'Payroll Sheet Deleted Fail!']);
        }
    }

    public function pdf($id)
    {
        $pay = new PayrollPdfResponse($id);
        $data =  $pay->get();
        $site_period = $pay->pms_sites_id;
        $site_allowance = $pay->pms_sector_allowance;
        $site_deduction = $pay->pms_sector_deduction;



        $mpdf = new mPDF('utf-8', 'A4-L');
        $view =  view('pms::Sheet.payroll_sheet',compact('data','site_period','site_deduction','site_allowance'));
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }

    public function pdfSectorWise($id)
    {
        $pay = new PayrollPdfResponse($id);
        $data =  $pay->get();
        $site_period = $pay->pms_sites_id;
        $site_allowance = $pay->pms_sector_allowance;
        $site_deduction = $pay->pms_sector_deduction;
       // dd($data);
        $mpdf = new mPDF('utf-8', 'A4-L');
        $view =  view('pms::Sheet.payroll_sheet_sector',compact('data','site_period','site_deduction','site_allowance'));
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }

    public function confirm($id)
    {
        try{
            DB::beginTransaction();

            $user = Auth::id();

            //PMS Payroll Sheet

            $sheet = PmsPayrollSheet::find($id);

            //PMS Payroll Payslip

            $pay = new PayrollPdfResponse($id);
            $data =  $pay->get();


            foreach ($data as $value) {

                $total_payable = $value['total'] + $value['total_overtime'] + $value['allowance_sector_total'] - $value['deductionAbsense'] - $value['total_duction'];
                
                $payslip_number = PmsPayslip::max('number');

                 if($payslip_number)
                {
                    $number = $payslip_number + 1;
                }
                else
                {
                    $number = 1;
                }
                $number = str_pad($number, 6, '0', STR_PAD_LEFT);

                $payslip = new PmsPayslip;

                $payslip->pms_payroll_sheets_id         = $id;
                $payslip->number                        = $number;
                $payslip->pms_employees_id              = $value['id'];
                $payslip->basic_pay                     = $value['basic_pay'];
                $payslip->allowance                     = $value['allowance'];
                $payslip->over_time                     = $value['overtime'];
                $payslip->over_time_per_hour            = $value['overtime_amount_per_hour'];
                $payslip->days_absent                   = $value['days_absent'];
                $payslip->total_payable                 = $total_payable;
                $payslip->total_paid                    = $value["netAmountPaid"];
                $payslip->total_due                     = ($total_payable - $value["netAmountPaid"]);
                $payslip->created_by                    = $user;
                $payslip->updated_by                    = $user;

                if($payslip->save()){
                    //Pms Payslip Allowance
                    if(!is_null($value['all_allowance_assign_id'])){

                        $allowance_id = $value['all_allowance_assign_id'];
                        $allowance_assign_id = explode(",", $allowance_id);

                        foreach($allowance_assign_id as $allowances){
                            $allowance = new PmsPayslipAllowance;

                            $allowance->pms_payslip_id                  = $payslip->id;
                            $allowance->pms_assign_allowances_id        = $allowances;
                            $allowance->created_by                      = $user;
                            $allowance->updated_by                      = $user;
                            $allowance->save();
                        }
                    }

                    //Pms Payslip Deduction
                    if(!is_null($value['all_deduction_assign_id'])){
                        $deduction_id = $value['all_deduction_assign_id'];
                        $deduction_assign_id = explode(",", $deduction_id);

                        foreach($deduction_assign_id as $deductions){
                            $deduction = new PmsPayslipDeduction;

                            $deduction->pms_payslip_id                  = $payslip->id;
                            $deduction->pms_assign_deductions_id        = $deductions;
                            $deduction->created_by                      = $user;
                            $deduction->updated_by                      = $user;
                            $deduction->save();
                        }
                    }
                }
            }

            //PMS Payroll Sheet Update
            $sheet->status          = 1;
            $sheet->updated_by      = $user;
            $sheet->update();

            DB::commit();
            return Response::json(1);
        }
        catch (\Exception $exception){

            DB::rollBack();

            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
        }

    }
}
