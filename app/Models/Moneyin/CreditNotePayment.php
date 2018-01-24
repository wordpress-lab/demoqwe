<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class CreditNotePayment extends Model
{
    protected $table = 'credit_note_payments';

    protected $fillable = [
        'amount',
        'invoice_id',
        'credit_note_id'
    ];
    
    public function invoice()
    {
        return $this->belongsTo('App\Models\Moneyin\Invoice','invoice_id');
    }

    public function creditNote()
    {
        return $this->belongsTo('App\Models\Moneyin\CreditNote','credit_note_id');
    }
}
