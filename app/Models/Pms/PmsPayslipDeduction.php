<?php

namespace App\Models\Pms;

use Illuminate\Database\Eloquent\Model;

class PmsPayslipDeduction extends Model
{
    protected $table = 'pms_payslip_deductions';

    public function payslipId()
    {
    	return $this->belongsTo('App\Models\Pms\PmsPayslip','pms_payslip_id');
    }

    public function assignDeductionId()
    {
    	return $this->belongsTo('App\Models\Pms\PmsAssignDeduction','pms_assign_deductions_id');
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
