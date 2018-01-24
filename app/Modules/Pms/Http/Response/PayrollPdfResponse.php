<?php
/**
 * Created by PhpStorm.
 * User: ontik
 * Date: 1/15/2018
 * Time: 4:39 PM
 */

namespace App\Modules\Pms\Http\Response;


use App\Models\Pms\Pms_Employee;
use App\Models\Pms\Pms_setting;
use App\Models\Pms\PmsAssignAllowance;
use App\Models\Pms\PmsAssignDeduction;
use App\Models\Pms\PmsAttendance;
use App\Models\Pms\PmsPayrollSheet;
use App\Models\Pms\PmsPayslip;
use App\Models\Pms\PmsSector;
use DateTime;
use Illuminate\Support\Facades\DB;

class PayrollPdfResponse
{

   protected $data = [];
   protected $id= null;
   public $pms_sites_id = null;
   protected $temp_emp = [];
   protected $days_count = 0;
   protected $over_time = null;
   protected $days_abs = null;
   protected $emp_all_id = null;
   protected $month_work_days = 1;
   protected $month_work_days_settings = 1;
   public $pms_sector_allowance = [];
   public $pms_sector_deduction = [];
   public function __construct($id= null)
   {


       $this->id = $id;
       $this->pms_sites_id = PmsPayrollSheet::find($this->id);
       $pms_setting  = Pms_setting::where("title","monthly_working_days")
           ->first();
       //  dayacount

       $to = $this->pms_sites_id['period_to'];
       $from = $this->pms_sites_id['period_from'];
       $date1 = new DateTime($to);
       $date2 = new DateTime($from);
       $this->days_count = $date2->diff($date1)->format("%a")+1;

      //setting
       if($pms_setting)
       {
           $days = unserialize($pms_setting->setting_data);
           if(isset($days->rate))
           {
               $this->month_work_days_settings = $days->rate;
           }

       }
       //month days count
       $month = date("m",strtotime($from));
       $year = date("Y",strtotime($from));
       $this->month_work_days = cal_days_in_month(CAL_GREGORIAN, $month, $year); // 31

       $this->pms_sector_allowance = PmsSector::where("type",1)->get();
       $this->pms_sector_deduction = PmsSector::where("type",0)->get();




   }

   public function get()
   {
   $this->temp_emp = $this->employeeName();
   $this->data["employeeName"] = $this->temp_emp;
   $this->data["basicPay"] = $this->basicPay();
   $this->data["food_allowance"] = $this->allowance();
   $this->data["total"] = $this->total();
   $this->data["overTime"] = $this->overTime();
   $this->data["daysAbsent"] = $this->daysAbsent();
   $this->data["deduction"] = $this->deduction();
   $this->data["allowanceSector"] = $this->allowanceSector();
   $this->data["deductionAbsense"] = $this->deductionAbsense();
   $this->data["netAmountPaid"] = $this->netAmountPaid();
   return $this->data["deductionAbsense"];
   }

   public function employeeName()
   {
    $col= ["id","name","code_name","basic_salary","food_allowance","daily_work_hour","overtime_amount_per_hour"];
    $emp = [];
    $pay = $this->pms_sites_id;
    if(is_null($pay["pms_sites_id"]))
    {
     $emp=Pms_Employee::all($col);
    }else{
      $emp=Pms_Employee::where("site_name",$pay["pms_sites_id"])->get($col);
    }
    return $emp;
   }
   public function basicPay()
   {

     foreach($this->temp_emp as $item)
     {
       $item->basic_pay = number_format(($item->basic_salary*$this->days_count)/$this->month_work_days,2,'.', '');
     }


     return $this->temp_emp;
   }
   public function allowance()
   {
       foreach($this->temp_emp as $item)
       {
           $item->allowance = number_format((($item->food_allowance*$this->days_count)/$this->month_work_days),2,'.', '');
       }


       return $this->temp_emp;
   }
   public function total()
   {
       foreach($this->temp_emp as $item)
       {
           $item->total = number_format($item["basic_pay"]+$item["allowance"],2,'.', '');
       }


       return $this->temp_emp;
   }
   public function overTime()
   {

       $to = $this->pms_sites_id['period_to'];
       $from = $this->pms_sites_id['period_from'];
       $pms_sites_id =$this->pms_sites_id->pms_sites_id;
       if(!is_null($pms_sites_id) && is_numeric($pms_sites_id))
       {

           $this->over_time = PmsAttendance::whereBetween("date", [$from, $to])
               ->selectRaw('pms_attendance.*,sum(pms_attendance.overtime) as total_overtime')
               ->where("pms_site_id", $pms_sites_id)
               ->where("absense", 0)
               ->whereIn("pms_employee_id",function($query) use ($pms_sites_id)
               {
                   $query->select('id')->from('pms__employees')
                       ->where("site_name",$pms_sites_id)
                       ->get();
               })
               ->groupBy('pms_employee_id')
               ->get();

       }
       else
       {
           $this->over_time = PmsAttendance::whereBetween("date", [$from, $to])
               ->selectRaw('pms_attendance.*,sum(pms_attendance.overtime) as total_overtime')
               ->where("absense", 0)
               ->whereIn("pms_employee_id",function($query)
               {
                   $query->select('id')
                         ->from('pms__employees')
                         ->get();
               })
               ->groupBy('pms_employee_id')
               ->get();
       }
       foreach($this->temp_emp as $item)
       {
           $attendance = $this->over_time->where("pms_employee_id",$item->id)->first();
           if($attendance)
           {
           $item->total_overtime = $attendance["total_overtime"]*$item["overtime_amount_per_hour"];
           $item->overtime = $attendance["total_overtime"];


           }
           else
           {
           $item->total_overtime = 0;
           $item->overtime = 0;
           }
       }

       return $this->temp_emp;
   }
   public function daysAbsent()
   {
       $to = $this->pms_sites_id['period_to'];
       $from = $this->pms_sites_id['period_from'];
       $pms_sites_id =$this->pms_sites_id->pms_sites_id;
       if(!is_null($pms_sites_id) && is_numeric($pms_sites_id))
       {

           $this->days_abs = PmsAttendance::whereBetween("date", [$from, $to])
               ->selectRaw('pms_attendance.*,sum((MINUTE(TIMEDIFF(pms_attendance.leave_time,pms_attendance.entrance_time))+ HOUR(TIMEDIFF(pms_attendance.leave_time,pms_attendance.entrance_time))*60))/60 as total_minu')
               ->where("pms_site_id", $pms_sites_id)
               ->where("absense",1)
               ->where("overtime",0)
               ->whereIn("pms_employee_id",function($query) use ($pms_sites_id)
               {
                   $query->select('id')->from('pms__employees')
                       ->where("site_name",$pms_sites_id)
                       ->get();
               })
               ->groupBy('pms_employee_id')
               ->get();


       }
       else
       {
           $this->days_abs = PmsAttendance::whereBetween("date", [$from, $to])
               ->selectRaw('pms_attendance.*,sum((MINUTE(TIMEDIFF(pms_attendance.leave_time,pms_attendance.entrance_time))+ HOUR(TIMEDIFF(pms_attendance.leave_time,pms_attendance.entrance_time))*60))/60 as total_minu')
               ->where("absense", 1)
               ->where("overtime", 0)
               ->whereIn("pms_employee_id",function($query)
               {
                   $query->select('id')
                         ->from('pms__employees')
                         ->get();
               })
               ->groupBy('pms_employee_id')
               ->get();
       }
       foreach($this->temp_emp as $item)
       {
           $attendance = $this->days_abs->where("pms_employee_id",$item->id)->first();
           if($attendance)
           {
            $item->days_absent = floor($attendance["total_minu"]/24);
           }
           else
           {
               $item->days_absent = 0;
           }
       }


       return $this->temp_emp;
   }

   public function deduction()
   {
       $to = $this->pms_sites_id['period_to'];
       $from = $this->pms_sites_id['period_from'];

       $pms_sites_id =$this->pms_sites_id->pms_sites_id;
       if(!is_null($pms_sites_id) && is_numeric($pms_sites_id))
       {

           $pms_deduction_data = PmsAssignDeduction::whereBetween("date", [$from, $to])
               ->selectRaw('pms_assign_deductions.*,GROUP_CONCAT(DISTINCT pms_assign_deductions.pms_sectors_id) as sec,GROUP_CONCAT(DISTINCT pms_assign_deductions.id) as assign_id')
               ->whereIn("pms_employees_id",function($query) use ($pms_sites_id)
               {
                   $query->select('id')->from('pms__employees')
                       ->where("site_name",$pms_sites_id)
                       ->get();
               })
               ->groupBy('pms_employees_id')
               ->get();
       }else{


           $pms_deduction_data = PmsAssignDeduction::whereBetween("date", [$from, $to])
               ->selectRaw('pms_assign_deductions.*, GROUP_CONCAT(DISTINCT pms_assign_deductions.pms_sectors_id) as sec,GROUP_CONCAT(DISTINCT pms_assign_deductions.id) as assign_id')
               ->whereIn("pms_employees_id",function($query)
               {
                   $query->select('id')->from('pms__employees')->get();

               })
               ->groupBy('pms_employees_id')
               ->get();
       }



       foreach($pms_deduction_data as $datum)
       {
          $sector =  explode(',',$datum->sec);
          $id= $datum->pms_employees_id;
          $data = [];
          foreach($sector as $value)
          {
            $data[]= PmsAssignDeduction::whereBetween("date", [$from, $to])
                  ->selectRaw('pms_assign_deductions.*, sum(pms_assign_deductions.amount) as sector_amount,pms_sectors.name as sector_name')
                  ->where("pms_assign_deductions.pms_sectors_id",$value)
                  ->where("pms_assign_deductions.pms_employees_id",$id)
                  ->join("pms_sectors","pms_sectors.id","pms_assign_deductions.pms_sectors_id")
                  ->first()->toArray();
          }
          $datum->deduction_sector = $data;
       }

       foreach($this->temp_emp as $item)
       {


           $attendance = $pms_deduction_data->where("pms_employees_id",$item->id)->first();

           if($attendance)
           {
               $item->all_deduction_assign_id = $attendance["assign_id"];
               $item->deduction = $attendance["deduction_sector"];
               $item->total_duction = array_sum(array_column($attendance["deduction_sector"],'sector_amount'));
           }
           else
           {
               $item->all_deduction_assign_id = null;
               $item->deduction =[];
               $item->total_duction = 0;
           }
       }
       return $this->temp_emp;
   }

   public function allowanceSector()
   {
       $to = $this->pms_sites_id['period_to'];
       $from = $this->pms_sites_id['period_from'];

       $pms_sites_id =$this->pms_sites_id->pms_sites_id;
       if(!is_null($pms_sites_id) && is_numeric($pms_sites_id))
       {

           $pms_deduction_data = PmsAssignAllowance::whereBetween("date", [$from, $to])
               ->selectRaw('pms_assign_allowances.*,GROUP_CONCAT(DISTINCT pms_assign_allowances.pms_sectors_id) as sec,GROUP_CONCAT(DISTINCT pms_assign_allowances.id) as assign_id')
               ->whereIn("pms_employees_id",function($query) use ($pms_sites_id)
               {
                   $query->select('id')->from('pms__employees')
                       ->where("site_name",$pms_sites_id)
                       ->get();
               })
               ->groupBy('pms_employees_id')
               ->get();
       }else{


           $pms_deduction_data = PmsAssignAllowance::whereBetween("date", [$from, $to])
               ->selectRaw('pms_assign_allowances.*, GROUP_CONCAT(DISTINCT pms_assign_allowances.pms_sectors_id) as sec,GROUP_CONCAT(DISTINCT pms_assign_allowances.id) as assign_id')
               ->whereIn("pms_employees_id",function($query)
               {
                   $query->select('id')->from('pms__employees')->get();

               })
               ->groupBy('pms_employees_id')
               ->get();
       }
       foreach($pms_deduction_data as $datum)
       {
           $sector =  explode(',',$datum->sec);
           $id= $datum->pms_employees_id;
           $data = [];
           foreach($sector as $value)
           {
               $data[]= PmsAssignAllowance::whereBetween("date", [$from, $to])
                   ->selectRaw('pms_assign_allowances.*, sum(pms_assign_allowances.amount) as sector_amount,pms_sectors.name as sector_name,GROUP_CONCAT(DISTINCT pms_assign_allowances.id) as allowance_id')
                   ->where("pms_assign_allowances.pms_sectors_id",$value)
                   ->where("pms_assign_allowances.pms_employees_id",$id)
                   ->join("pms_sectors","pms_sectors.id","pms_assign_allowances.pms_sectors_id")
                   ->groupBy('pms_assign_allowances.pms_employees_id')
                   ->first();

           }
           $datum->deduction_sector = $data;
       }
       foreach($this->temp_emp as $item)
       {
           $attendance = $pms_deduction_data->where("pms_employees_id",$item->id)->first();
           if($attendance)
           {
               $item->all_allowance_assign_id = $attendance["assign_id"];
               $item->allowance_sector = $attendance["deduction_sector"];
               $item->allowance_sector_total = array_sum(array_column($attendance["deduction_sector"],'sector_amount'));
           }
           else
           {
               $item->all_allowance_assign_id = null;
               $item->allowance_sector =[];
               $item->allowance_sector_total = 0;
           }
       }
       return $this->temp_emp;
   }

   public function deductionAbsense()
   {
       foreach($this->temp_emp as $item)
       {
         $item->deductionAbsense = number_format(($item["basic_pay"] * floor($item["days_absent"]))/$this->month_work_days,2,'.', '');
       }

       return $this->temp_emp;
   }

   public function netAmountPaid()
   {

   foreach($this->temp_emp as $item)
   {
       $paid_amount=0;
       $to = $this->pms_sites_id['period_to'];
       $from = $this->pms_sites_id['period_from'];
   $advance = PmsAssignDeduction::whereBetween("date", [$from, $to])
        ->where("pms_assign_deductions.pms_sectors_id",2)
       ->where("pms_assign_deductions.pms_employees_id",$item->id)->sum('amount');
   if($this->pms_sites_id["status"]){
       $paid_amount = PmsPayslip::where("pms_payslips.pms_employees_id",$item->id)->first(["total_paid"]);
       $paid_amount = $paid_amount["total_paid"] - $advance;
   }


   $item->netAmountPaid = number_format(($advance+$paid_amount),2,'.','');
   }
    return $this->temp_emp;
   }

}