<?php

namespace App\Models\Recruit;

use Illuminate\Database\Eloquent\Model;

class Note_sheet extends Model
{
    protected $table='note_sheet';

    protected $fillable=[
        'countryGender',
        'applicationDate',
        'sourceIncomeTax',
        'wekfareFee',
        'payOrderNumber',
        'chalanNumber',
        'infoAttestation',
        'payOrderDate',
        'chalanDate',
        'certificateAttestation',
        'payOrderAmount',
        'chalanAmount',
        'created_by',
        'updated_by'
    ];


    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
