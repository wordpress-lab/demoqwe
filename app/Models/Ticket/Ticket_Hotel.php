<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class Ticket_Hotel extends Model
{

    protected $table='ticket_hotel';

    protected $fillable=[

        'title',
        'country',
        'address',
        'note',
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
