<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class Ticket_Document extends Model
{
    protected $table='ticket_document';

    protected $fillable=[

        'title',
        'file_url',
        'note',
        'order_id',
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

    public function document()
    {
        return $this->belongsTo('App\Models\Visa\Ticket\Order\Order','order_id');
    }
}
