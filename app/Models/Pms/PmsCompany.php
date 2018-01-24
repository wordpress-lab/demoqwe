<?php

namespace App\Models\Pms;

use Illuminate\Database\Eloquent\Model;

class PmsCompany extends Model
{
    protected $table = 'pms_companies';

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
