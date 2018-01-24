<?php

namespace App\Models\Pms;

use Illuminate\Database\Eloquent\Model;

class PmsLeaveAssign extends Model
{
    protected $table = 'pms_leave_assigns';

    public function employeeId()
    {
    	return $this->belongsTo('App\Models\Pms\Pms_Employee','pms_employee_id');
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
