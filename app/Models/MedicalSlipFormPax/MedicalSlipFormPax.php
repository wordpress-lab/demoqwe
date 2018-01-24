<?php

namespace App\Models\MedicalSlipFormPax;

use Illuminate\Database\Eloquent\Model;

class MedicalSlipFormPax extends Model
{
    protected $table = 'medical_slip_form_pax';

    protected $fillable = [
        'medicalslip_id',
        'recruit_id',
    ];
    public function medicalslip()
    {
        return $this->belongsToMany('App\Models\MedicalSlipForm\MedicalSlipForm','medicalslip_id');
    }

    public function recruit()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','recruit_id');
    }


}
