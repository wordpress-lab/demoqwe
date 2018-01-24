<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class PaymentReceiveEntryModel extends Model
{
    protected $table = 'payment_receives_entries';

    protected $fillable = ['amount','payment_receives_id','invoice_id','account_id'];

    public function invoice()
    {
        return $this->belongsTo('App\Models\Moneyin\Invoice','invoice_id');
    }

    public function paymentReceive()
    {
        return $this->belongsTo('App\Models\Moneyin\PaymentReceives','payment_receives_id');
    }

    public function paymentMode()
    {
        return $this->hasManyThrough(
            'App\Models\PaymentMode\PaymentMode','App\Models\Moneyin\PaymentReceives','payment_mode_id','payment_receives_id','id'
        );
    }

    public function account()
    {
        return $this->belongsTo('App\Models\AccountChart\Account','account_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}
