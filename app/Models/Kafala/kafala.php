<?php

namespace App\Models\Kafala;

use Illuminate\Database\Eloquent\Model;

class kafala extends Model
{
    protected $fillable = array("recruitingorder_id","company_name","date_of_kafala","created_by","updated_by");

    public function recruitId()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','recruitingorder_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}
