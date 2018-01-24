<?php

namespace App\Models\Visa;

use Illuminate\Database\Eloquent\Model;

class Visaform extends Model
{


    public function pax()
    {

     return $this->belongsTo('App\Models\Recruit\Recruitorder','pax_id');
    }

    public function formBulk()
    {

        return $this->hasMany('App\Models\Visa\Visaformbulk','visaform_id');
    }
    public function agreement()
    {

        return $this->hasMany('App\Models\Visa\Visaformagreement','visaform_id');
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
