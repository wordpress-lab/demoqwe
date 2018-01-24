<?php

namespace App\Models\Pms;

use Illuminate\Database\Eloquent\Model;

class PmsPayslipsPayment extends Model
{
    protected $table = 'pms_payslips_payments';

    public function payslipId()
    {
    	return $this->belongsTo('App\Models\Pms\PmsPayslip','pms_payslips_id');
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
