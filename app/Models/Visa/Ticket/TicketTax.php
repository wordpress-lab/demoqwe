<?php

namespace App\Models\Visa\Ticket;

use Illuminate\Database\Eloquent\Model;

class TicketTax extends Model
{
    protected $table = "tickettaxs";

    public function TicketTax(){

        return $this->belongsToMany('App\Models\Visa\Ticket\Airline\Airlines', 'App\Models\Visa\Ticket\Airline\Airlinetax', 'tickettax_id','airline_id');
    }
}
