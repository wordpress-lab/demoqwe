<?php

namespace App\Models\Pms;

use Illuminate\Database\Eloquent\Model;

class PmsPayslipAllowance extends Model
{
    protected $table = 'pms_payslip_allowances';

    public function payslipId()
    {
    	return $this->belongsTo('App\Models\Pms\PmsPayslip','pms_payslip_id');
    }

    public function assignAllowanceId()
    {
    	return $this->belongsTo('App\Models\Pms\PmsAssignAllowance','pms_assign_allowances_id');
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
