<?php

namespace App\Models\Manpower;

use Illuminate\Database\Eloquent\Model;

class ChallanForm extends Model
{
    protected $table = 'challanform';


    public function manpower()
    {
        return $this->belongsTo('App\Models\Manpower\Manpower','manpower_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
