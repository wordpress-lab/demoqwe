<?php

namespace App\Models\Iqama\Delivery;

use Illuminate\Database\Eloquent\Model;

class Receipient extends Model
{
    protected  $table = "iqamarecipient";

    protected $fillable = array("recruitingorder_id","recipient_name","relational_passenger","created_by","updated_by");

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
