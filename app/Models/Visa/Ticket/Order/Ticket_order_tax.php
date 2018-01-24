<?php

namespace App\Models\Visa\Ticket\Order;

use Illuminate\Database\Eloquent\Model;

class Ticket_order_tax extends Model
{
    protected $table = "ticket_order_tax";

    protected $fillable=[
        'ticket_order_id',
        'title',
        'amount',
    ];

    public function ticketorder()
    {
        return $this->belongsTo('App\Models\Visa\Ticket\Order\Order','ticket_order_id');
    }

}
