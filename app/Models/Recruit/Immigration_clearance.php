<?php

namespace App\Models\Recruit;

use Illuminate\Database\Eloquent\Model;

class Immigration_clearance extends Model
{
    protected $table='immigration_clearance';

    protected $fillable=[

        'applicationDate',
        'country_name',
        'total_person',
        'person_count',
        'gender',
        'stampFee',
        'licenseValidity',
        'authentication',
        'unitWelfareFee',
        'incomeTaxType',
        'unitIncomeTaxNAFee',
        'unitIncomeTaxSAFee',
        'unitSmartCardFee',
        'payOrderDetails',
        'WelfareComment',
        'incomeTaxComment',
        'SmartCardComment',
        'created_by',
        'updated_by',

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
