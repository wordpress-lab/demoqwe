<?php

namespace App\Models\Flightnew;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $table = 'submission';

    protected $fillable = [
        'submission_date',
        'expected_flight_date',
        'comment',
        'owner_approval',
        'pax_id',
        'created_by',
        'updated_by',
    ];

    public function submition_file()
    {
        return $this->hasMany('App\Models\Flightnew\Submission_file','submission_id');
    }

    public function paxID()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','pax_id');
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
