<?php

namespace App\Models\Flightnew;

use Illuminate\Database\Eloquent\Model;

class Confirmation extends Model
{
    protected $table = 'confirmations';

    public function paxId()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','pax_id');
    }

    public function vendorId()
    {
        return $this->belongsTo('App\Models\Contact\Contact','vendor_name');
    }

    public function confirmationFile()
    {
        return $this->hasMany('App\Models\Flightnew\ConfirmationFile' , 'confirmation_id');
    }

    public function bill()
    {
        return $this->belongsTo('App\Models\MoneyOut\Bill','bill_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
