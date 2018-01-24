<?php

namespace App\Models\Ticket;

use Illuminate\Database\Eloquent\Model;

class TicketRefund extends Model
{
    protected $table='ticket_refunds';

    public function invoice()
    {
        return $this->belongsTo('App\Models\Moneyin\Invoice','invoice_id');
    }

    public function bill()
    {
        return $this->belongsTo('App\Models\MoneyOut\Bill','bill_id');
    }
    
    public function customerId()
    {
        return $this->belongsTo('App\Models\Contact\Contact','customer_id');
    }

    public function vendorId()
    {
        return $this->belongsTo('App\Models\Contact\Contact','vendor_id');
    }

    public function sectorId()
    {
        return $this->belongsTo('App\Models\Inventory\Item','refund_sector');
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
