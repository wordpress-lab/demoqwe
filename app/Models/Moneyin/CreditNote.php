<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class CreditNote extends Model
{
    protected $table = 'credit_notes';

    protected $fillable = [
        'credit_note_number',
        'reference',
        'credit_note_date',
        'shiping_charge',
        'adjustment',
        'total_credit_note',
        'customer_id'
    ];

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
        return $this->belongsTo('App\Models\Contact\Contact','customer_id');
    }

    public function creditNoteEntries()
    {
        return $this->hasMany('App\Models\Moneyin\CreditNoteEntry','credit_note_id');
    }

    public function creditNotePayments()
    {
        return $this->hasMany('App\Models\Moneyin\CreditNotePayment','credit_note_id');
    }

    public function creditNoteRefunds()
    {
        return $this->hasMany('App\Models\Moneyin\CreditNoteRefund','credit_note_id');
    }

    public function stocks()
    {
        return $this->hasMany('App\Models\Inventory\Stock', 'credit_note_id');
    }
}
