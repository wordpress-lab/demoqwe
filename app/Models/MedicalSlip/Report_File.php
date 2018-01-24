<?php

namespace App\Models\MedicalSlip;

use Illuminate\Database\Eloquent\Model;

class Report_File extends Model
{
    protected $table = 'report_file';

    protected $fillable = [
        'mrdical_slip_id',
        'title',
        'img_url'
    ];

    public function medical_slip()
    {
        return $this->belongsTo('App\Models\MedicalSlip\Medicalslip','mrdical_slip_id');
    }

}
