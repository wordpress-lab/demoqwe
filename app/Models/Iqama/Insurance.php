<?php

namespace App\Models\Iqama;

use Illuminate\Database\Eloquent\Model;

class Insurance extends Model
{
    protected  $table = "insurances";
    protected $fillable = array("recruitingorder_id","date_of_payment","created_by","updated_by");

    public function paxId()
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
