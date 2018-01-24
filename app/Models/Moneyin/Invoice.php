<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $table = 'invoices';

    protected $fillable = ['invoice_number', 'invoice_date', 'payment_date', 'customer_id','customer_note','shipping_charge','adjustment','file_name','file_url'];


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
        return $this->belongsTo('App\Models\Contact\Contact');
    }

    public function invoiceEntries()
    {
        return $this->hasMany('App\Models\Moneyin\InvoiceEntry');
    }
    public function OrderInvoiceEntries()
    {
        return $this->hasOne('App\Models\Moneyin\InvoiceEntry');
    }
    
    public function creditNotePayments()
    {
        return $this->hasMany('App\Models\Moneyin\CreditNotePayment','invoice_id');
    }

    public function excessPayments()
    {
        return $this->hasMany('App\Models\Moneyin\ExcessPayment','invoice_id');
    }

    public function paymentReceives()
    {
        return $this->hasMany('App\Models\Moneyin\PaymentReceives','invoice_id');
    }

    public function paymentReceivesEntry()
    {
        return $this->hasMany('App\Models\Moneyin\PaymentReceiveEntryModel','invoice_id');
    }

    public function journalEntries()
    {
        return $this->hasMany('App\Models\ManualJournal\JournalEntry', 'invoice_id');
    }

    public function Agent()
    {
        return $this->belongsTo('App\Models\Contact\Agent','agents_id');
    }

    public function Commission()
    {
        return $this->hasMany('App\Models\Setting\SalesComission','agents_id','agents_id');
    }

    public function Ticket(){

        return $this->hasOne('App\Models\Visa\Ticket\Order\Order','invoice_id');
    }

    public function Recruit(){

        return $this->hasOne('App\Models\Recruit\Recruitorder','invoice_id');
    }

    public function ticketRefund(){
        
        return $this->hasOne('App\Models\Ticket\TicketRefund','invoice_id');
    }


}
