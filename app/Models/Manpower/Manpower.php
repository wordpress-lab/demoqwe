<?php

namespace App\Models\Manpower;

use Illuminate\Database\Eloquent\Model;

class Manpower extends Model
{
    protected $table = 'manpower';

    protected $fillable = [
        'issuingDate',
        'receivingDate',
        'comment',
        'paxid',
        'created_by',
        'updated_by',
    ];

    public function paxId()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','paxid');
    }

    public function challan()
    {
        return $this->hasOne('App\Models\Manpower\ChallanForm','manpower_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
