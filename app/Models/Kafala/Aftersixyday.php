<?php

namespace App\Models\kafala;

use Illuminate\Database\Eloquent\Model;

class Aftersixyday extends Model
{
    protected $fillable = array("recruitingorder_id","grama_rate","receive_date","file_url","date_of_payment","created_by","updated_by");

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
