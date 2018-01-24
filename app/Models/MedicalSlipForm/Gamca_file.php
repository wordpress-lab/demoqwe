<?php

namespace App\Models\MedicalSlipForm;

use Illuminate\Database\Eloquent\Model;

class Gamca_file extends Model
{

    protected $table = 'gamca_file';

    protected $fillable = [
        'medical_slip_form_id',
        'title',
        'img_url'
    ];


    public function gamca_form()
    {
        return $this->belongsTo('App\Models\MedicalSlipForm\MedicalSlipForm','medical_slip_form_id');
    }

}
