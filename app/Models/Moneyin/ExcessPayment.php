<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class ExcessPayment extends Model
{
    protected $table = 'excess_payment';

    protected $fillable = ['amount','payment_receives_id','invoice_id','created_by','updated_by'];

    public function paymentReceive()
    {
        return $this->belongsTo('App\Models\Moneyin\PaymentReceives','payment_receives_id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Models\Moneyin\Invoice','invoice_id');
    }
}
