<?php

namespace App\Models\Visa;

use Illuminate\Database\Eloquent\Model;

class Visaacceptance extends Model
{
    protected $table = "visaacceptance";



    public function visaentry()
    {

        return $this->belongsTo('App\Models\Visa\Visa','visaentry_id');
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
