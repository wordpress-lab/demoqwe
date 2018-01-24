<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class PaymentMadeEntry extends Model
{
    protected $table = 'payment_made_entry';

    public function paymentMade()
    {
        return $this->belongsTo('App\Models\MoneyOut\PaymentMade','payment_made_id');
    }

    public function bill()
    {
        return $this->belongsTo('App\Models\MoneyOut\Bill','bill_id');
    }
}

