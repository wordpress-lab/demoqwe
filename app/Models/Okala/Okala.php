<?php

namespace App\Models\Okala;

use Illuminate\Database\Eloquent\Model;

class Okala extends Model
{
    protected $table = 'okala';

    protected $fillable = [
        'date',
        'comment',
        'status',
        'paxid',
        'created_by',
        'updated_by',
    ];

    public function paxId()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','paxid');
    }

    public function recruiting()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','paxid');
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
