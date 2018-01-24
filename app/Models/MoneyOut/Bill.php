<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class Bill extends Model
{
    protected $table = 'bill';

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Contact\Contact', 'vendor_id');
    }

    public function billEntries()
    {
        return $this->hasMany('App\Models\MoneyOut\BillEntry');
    }
    public function OrderbillEntries()
    {
        return $this->hasOne('App\Models\MoneyOut\BillEntry');
    }

    public function paymentModeEntries()
    {
        return $this->hasMany('App\Models\MoneyOut\PaymentMadeEntry','bill_id');
    }

    public function journalEntries()
    {
        return $this->hasMany('App\Models\ManualJournal\JournalEntry', 'bill_id');
    }
    
    public function stocks()
    {
        return $this->hasMany('App\Models\Inventory\Stock', 'bill_id');
    }
    public function Ticket(){

        return $this->hasOne('App\Models\Visa\Ticket\Order\Order','bill_id');
    }

    public function Recruit(){

        return $this->hasOne('App\Models\Recruit\Recruitorder','bill_id');
    }

    public function ticketRefund(){
        
        return $this->hasOne('App\Models\Ticket\TicketRefund','invoice_id');
    }
}
