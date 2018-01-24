<?php

namespace App\Models\Pms;

use Illuminate\Database\Eloquent\Model;

class PmsLeaveSettings extends Model
{
    protected $table = 'pms_leave_settings';

    protected $fillable = [
    	'id',
        'highest_allowed_leave',
        'created_by',
        'updated_by',
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
