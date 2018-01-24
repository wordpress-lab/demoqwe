<?php

namespace App\Models\Pms;

use Illuminate\Database\Eloquent\Model;

class PmsPayslip extends Model
{
    protected $table = 'pms_payslips';

    public function sheetId()
    {
    	return $this->belongsTo('App\Models\Pms\PmsPayrollSheet','pms_payroll_sheets_id');
    }

    public function employeeId()
    {
    	return $this->belongsTo('App\Models\Pms\Pms_Employee','pms_employees_id');
    }

    public function payment()
    {
        return $this->hasMany('App\Models\Pms\PmsPayslipsPayment','pms_payslips_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
