<?php

namespace App\Models\Iqama\Delivery;

use Illuminate\Database\Eloquent\Model;

class Iqamaacknowledgement extends Model
{

    protected  $table = "iqamaacknowledgements";

    protected $fillable = array("recruitingorder_id","file_url","created_by","updated_by","receive_date");

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
