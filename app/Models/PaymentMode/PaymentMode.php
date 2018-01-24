<?php

namespace App\Models\PaymentMode;

use Illuminate\Database\Eloquent\Model;

class PaymentMode extends Model
{
    protected $table = 'payment_mode';

    public function paymentReceives()
    {
        return $this->hasMany('App\Models\Moneyin\PaymentReceive', 'payment_mode_id');
    }

    public function paymentModes()
    {
        return $this->hasMany('App\Models\MoneyOut\PaymentMade', 'payment_mode_id');
    }
    
}


