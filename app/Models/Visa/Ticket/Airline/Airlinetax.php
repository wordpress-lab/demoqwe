<?php

namespace App\Models\Visa\Ticket\Airline;

use Illuminate\Database\Eloquent\Model;

class Airlinetax extends Model
{
   protected $table = "airlinetaxs";

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function Airline()
    {
        return $this->belongsTo('App\Models\Visa\Ticket\Airline\Airlines','airline_id');
    }

    public function AirlineTax()
    {
        return $this->belongsTo('App\Models\Visa\Ticket\TicketTax','tickettax_id');
    }
}
