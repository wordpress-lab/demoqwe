<?php

namespace App\Models\Bank;

use Illuminate\Database\Eloquent\Model;

class Bank extends Model
{
    protected $table = 'bank';

    protected $fillable = [
        'type',
        'bank_name_id',
        'particulars',
        'date',
        'cheque_number',
        'total_amount',
        'notes',
    ];

    public function bankName()
    {
        return $this->belongsTo('App\Models\Bank\BankName');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function contact()
    {
        return $this->belongsTo('App\Models\Contact\Contact');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\AccountChart\Account','account_id');
    }
}
