<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class CreditNoteRefund extends Model
{
    protected $table = 'credit_note_refunds';

    protected $fillable = [
	    'amount',
	    'credit_note_id',
	    'payment_mode_id',
	    'date',
	    'reference',
	    'account_id',
    ];

    public function creditNote()
    {
        return $this->belongsTo('App\Models\Moneyin\CreditNote','credit_note_id');
    }

    public function paymentMode()
    {
        return $this->belongsTo('App\Models\PaymentMode\PaymentMode','payment_mode_id');
    }
}
