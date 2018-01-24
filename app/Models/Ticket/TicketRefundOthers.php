<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class TicketRefundOthers extends Model
{
    protected $table='ticket_refund_others';

    public function invoice()
    {
        return $this->belongsTo('App\Models\Moneyin\Invoice','invoice_id');
    }

    public function bill()
    {
        return $this->belongsTo('App\Models\MoneyOut\Bill','bill_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
