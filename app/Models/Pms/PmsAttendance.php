<?php

namespace App\Models\Pms;

use Illuminate\Database\Eloquent\Model;

class PmsAttendance extends Model
{
    protected $table = 'pms_attendance';

    protected $fillable = [
    	'date',
    	'entrance_time',
    	'leave_time',
    	'pms_site_id',
    	'pms_employee_id',
        'created_by',
        'updated_by',
    ];

    public function siteId()
    {
    	return $this->belongsTo('App\Models\Pms\Pms_Site','pms_site_id');
    }

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
