<?php

namespace App\Models\MedicalSlipForm;

use Illuminate\Database\Eloquent\Model;

class MedicalSlipForm extends Model
{
    protected $table = 'medical_slip_form';

    protected $fillable = [
        'dateOfApplication',
        'country_name',
        'created_by',
        'updated_by',
    ];

    public function gamca_received_submit()
    {
        return $this->hasMany('App\Models\MedicalSlipForm\Gamca_Received_submit','medical_slip_form_id');
    }

    public function medicalslipFromPax()
    {
        return $this->belongsToMany('App\Models\Recruit\Recruitorder','medical_slip_form_pax','medicalslip_id','recruit_id');
    }

    public function medicalslipFromSubmit()
    {
        return $this->belongsToMany('App\Models\Recruit\Recruitorder','gamca_receive_submit','medical_slip_form_id','pax_id');
    }

    public function gamca_file()
    {
        return $this->hasMany('App\Models\MedicalSlipForm\Gamca_file','medical_slip_form_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }


    public function paxId(){

    }
}
