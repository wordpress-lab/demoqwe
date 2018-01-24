<?php

namespace App\Models\PoliceClearance;

use Illuminate\Database\Eloquent\Model;

class PoliceClearance extends Model
{
    protected $table = 'police_clearances';

    public function paxId()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','paxid');
    }

    public function policeClearanceFile()
    {
        return $this->hasMany('App\Models\PoliceClearance\PoliceClearanceFile' , 'police_clearance_id');
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
