<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class PaymentReceives extends Model
{
    protected $table = 'payment_receives';

    protected $fillable = ['payment_date','reference','note','amount','file_name','file_url','payment_mode_id','account_id','customer_id'];

    public function PaymentReceiveEntryData()
    {
        return $this->hasMany('App\Models\Moneyin\PaymentReceiveEntryModel');
    }

    public function JournalEntry()
    {
        return $this->hasMany('App\Models\ManualJournal\JournalEntry');
    }
    
    public function paymentMode()
    {
        return $this->belongsTo('App\Models\PaymentMode\PaymentMode','payment_mode_id');
    }

    public function excessPayment()
    {
        return $this->hasMany('App\Models\Moneyin\ExcessPayment', 'payment_receives_id');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\AccountChart\Account','account_id');
    }

    public function paymentContact()
    {
        return $this->belongsTo('App\Models\Contact\Contact','customer_id');
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
