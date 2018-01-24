<?php

namespace App\Models\StampingApproval;

use Illuminate\Database\Eloquent\Model;

class StampingApproval extends Model
{
    protected $table = "stampingapproval";

    public function pax_id()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','pax_id');
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
