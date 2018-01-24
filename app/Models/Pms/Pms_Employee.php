<?php

namespace App\Models\Pms;

use Illuminate\Database\Eloquent\Model;

class Pms_Employee extends Model
{
    protected $fillable = [
        'created_by',
        'updated_by',
    ];

    public function site(){
        return $this->belongsTo('App\Models\Pms\Pms_Site','site_name')->select(['company_name', 'id']);
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
