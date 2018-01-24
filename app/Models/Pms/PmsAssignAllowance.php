<?php

namespace App\Models\Pms;

use Illuminate\Database\Eloquent\Model;

class PmsAssignAllowance extends Model
{
    protected $table = 'pms_assign_allowances';

    public function sectorId()
    {
    	return $this->belongsTo('App\Models\Pms\PmsSector','pms_sectors_id');
    }

    public function employeeId()
    {
    	return $this->belongsTo('App\Models\Pms\Pms_Employee','pms_employees_id');
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
