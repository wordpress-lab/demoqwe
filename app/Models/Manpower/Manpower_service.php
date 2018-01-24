<?php

namespace App\Models\Manpower;

use Illuminate\Database\Eloquent\Model;

class Manpower_service extends Model
{
    protected $table = 'manpower_service';

    protected $fillable = [
        'first_name',
        'last_name',
        'sector',
        'phone',
        'delivery_date',
        'issue_date',
        'contact_id',
        'bill_id',
        'invoice_id',
        'ticket_hotel_id',
        'progress_status_id',
        'vendor_id',
        'created_by',
        'updated_by',
    ];

    public function contact()
    {
        return $this->belongsTo('App\Models\Contact\Contact','contact_id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Models\Moneyin\Invoice','invoice_id');
    }

    public function bill()
    {
        return $this->belongsTo('App\Models\MoneyOut\Bill','bill_id');
    }

    public function hotel()
    {
        return $this->belongsTo('App\Models\Ticket\Ticket_Hotel','ticket_hotel_id');
    }
    public function ProgressStatus()
    {
        return $this->belongsTo('App\Models\Manpower\Manpower_service_progress','progress_status_id');
    }

    public function vendor()
    {
        return $this->belongsTo('App\Models\Contact\Contact','vendor_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

//    public function Tax()
//    {
//        return $this->belongsToMany('App\Models\Visa\Ticket\TicketTax','ticket_order_tax','ticket_order_id','ticket_tax_id');
//    }
//    public function Ticket_order()
//    {
//        return $this->hasMany('App\Models\Visa\Ticket\Order\Ticket_order_tax','ticket_order_id');
//    }
}
