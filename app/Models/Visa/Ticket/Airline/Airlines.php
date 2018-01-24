<?php

namespace App\Models\Visa\Ticket\Airline;

use Illuminate\Database\Eloquent\Model;

class Airlines extends Model
{
    protected $table = "airlines";

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function tax()
    {
        return $this->belongsToMany('App\Models\Visa\Ticket\TicketTax','airlinetaxs','airline_id','tickettax_id');
    }
}
