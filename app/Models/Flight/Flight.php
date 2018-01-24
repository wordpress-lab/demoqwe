<?php

namespace App\Models\Flight;

use Illuminate\Database\Eloquent\Model;

class Flight extends Model
{
    protected $table = 'flight';

    protected $fillable = [
        'carrierName',
        'flightDate',
        'country',
        'comment',
        'vendor_id',
        'paxid',
        'created_by',
        'updated_by',
    ];

    public function vendor()
    {
        return $this->belongsTo('App\Models\Contact\Contact','vendor_id');
    }

    public function paxId()
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
