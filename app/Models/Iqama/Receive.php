<?php

namespace App\Models\Iqama;

use Illuminate\Database\Eloquent\Model;

class Receive extends Model
{

    protected  $table = "iqamareceives";
    protected $fillable = array("recruitingorder_id","receive_date","created_by","updated_by","file_url");

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function Recruitorder(){

        return $this->belongsTo('App\Models\Recruit\Recruitorder','recruitingorder_id');
    }

}
