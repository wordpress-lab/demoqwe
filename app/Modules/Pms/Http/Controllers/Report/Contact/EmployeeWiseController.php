<?php

namespace App\Modules\Pms\Http\Controllers\Report\Contact;

use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Pms\Pms_Employee;
use App\Models\Pms\PmsPayslip;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class EmployeeWiseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $OrganizationProfile = OrganizationProfile::first();
        $start = date('Y-m-01',strtotime('this month'));
        $end = date('Y-m-t',strtotime('this month'));

        $emp = PmsPayslip::join("pms__employees","pms__employees.id","pms_payslips.pms_employees_id")
                        ->selectRaw("pms_payslips.pms_employees_id as id,pms__employees.name as name,sum(pms_payslips.total_payable) as total_payable,sum(pms_payslips.total_paid) as total_paid,sum(pms_payslips.total_due) as total_due")
                        ->groupBy("pms_payslips.pms_employees_id")
                        ->get();

        return view('pms::Report.Employee.index',compact('OrganizationProfile','start','end','emp'));
    }
    public function indexFilter(Request $request)
    {
        $OrganizationProfile = OrganizationProfile::first();
        $start = date('Y-m-d',strtotime($request->from_date));
        $end = date('Y-m-d',strtotime($request->to_date));

        $emp = PmsPayslip::whereBetween('pms_payslips.created_at',[$start,$end])
            ->join("pms__employees","pms__employees.id","pms_payslips.pms_employees_id")
            ->selectRaw("pms_payslips.pms_employees_id as id,pms__employees.name as name,sum(pms_payslips.total_payable) as total_payable,sum(pms_payslips.total_paid) as total_paid,sum(pms_payslips.total_due) as total_due")
            ->groupBy("pms_payslips.pms_employees_id")
            ->get();

        return view('pms::Report.Employee.index',compact('OrganizationProfile','start','end','emp'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function details($id,$start,$end)
    {
        $OrganizationProfile = OrganizationProfile::first();
        $openning_balance = PmsPayslip::where("pms_payslips.created_at",'<',$start)
                        ->join("pms__employees","pms__employees.id","pms_payslips.pms_employees_id")
                        ->selectRaw("pms_payslips.pms_employees_id as id,pms__employees.name as name,sum(pms_payslips.total_payable) as total_payable,sum(pms_payslips.total_paid) as total_paid,sum(pms_payslips.total_due) as total_due")
                        ->where("pms_payslips.pms_employees_id",$id)
                        ->first();

        $data = PmsPayslip::whereBetween('pms_payslips.created_at',[$start,$end])
            ->join("pms__employees","pms__employees.id","pms_payslips.pms_employees_id")
            ->select("pms_payslips.*")
            ->where("pms_payslips.pms_employees_id",$id)
            ->with("payment","sheetId")
            ->orderBy("pms_payslips.created_at",'desc')
            ->get();
         $emp= Pms_Employee::find($id);
       return view('pms::Report.Employee.details',compact('emp','OrganizationProfile','start','end','openning_balance','data','id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function detailsFilter($id,Request $request)
    {
        if(!$request->from_date)
        {
            $start = date('Y-m-01',strtotime('this month'));
            $end = date('Y-m-t',strtotime('this month'));
            return redirect()->route("pms_report_employee_wise_details",['id'=>$id,'start'=>$start,'end'=>$end]);
        }
        $start = date('Y-m-d',strtotime($request->from_date));
        $end = date('Y-m-d',strtotime($request->to_date));
        $OrganizationProfile = OrganizationProfile::first();
        $openning_balance = PmsPayslip::where("pms_payslips.created_at",'<',$start)
            ->join("pms__employees","pms__employees.id","pms_payslips.pms_employees_id")
            ->selectRaw("pms_payslips.pms_employees_id as id,pms__employees.name as name,sum(pms_payslips.total_payable) as total_payable,sum(pms_payslips.total_paid) as total_paid,sum(pms_payslips.total_due) as total_due")
            ->where("pms_payslips.pms_employees_id",$id)
            ->first();

        $data = PmsPayslip::whereBetween('pms_payslips.created_at',[$start,$end])
            ->join("pms__employees","pms__employees.id","pms_payslips.pms_employees_id")
            ->select("pms_payslips.*")
            ->where("pms_payslips.pms_employees_id",$id)
            ->with("payment","sheetId")
            ->orderBy("pms_payslips.created_at",'desc')
            ->get();
        $emp= Pms_Employee::find($id);
        return view('pms::Report.Employee.details',compact('emp','OrganizationProfile','start','end','openning_balance','data','id'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
