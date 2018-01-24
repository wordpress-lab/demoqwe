<?php

namespace App\Models\Iqama\Delivery;

use Illuminate\Database\Eloquent\Model;

class Clearance extends Model
{
    protected  $table = "iqamaclearance";
    protected $fillable = array("recruitingorder_id","file_url","comments","status","created_by","updated_by");

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
