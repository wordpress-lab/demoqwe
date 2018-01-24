<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class PaymentMade extends Model
{
    protected $table = 'payment_made';

    public function paymentMadeEntries()
    {
        return $this->hasMany('App\Models\MoneyOut\PaymentMadeEntry', 'payment_made_id');
    }

    public function JournalEntry()
    {
        return $this->hasMany('App\Models\ManualJournal\JournalEntry', 'payment_made_id');
    }

    public function paymentMode()
    {
        return $this->belongsTo('App\Models\PaymentMode\PaymentMode','payment_mode_id');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\AccountChart\Account','account_id');
    }

    public function customer()
    {
        return $this->belongsTo('App\Models\Contact\Contact','vendor_id');
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