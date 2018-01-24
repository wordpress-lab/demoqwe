<?php

namespace App\Models\ConveyanceBill;

use Illuminate\Database\Eloquent\Model;

class ConveyanceBill extends Model
{
    protected $table = 'conveyance_bills';

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }
    public function expense()
    {
        return $this->belongsTo('App\Models\MoneyOut\Expense','expense_id');
    }
    public function conveyance_bill_list()
    {
        return $this->hasMany('App\Models\ConveyanceBill\ConveyanceBillList','conveyance_bill_id');
    }

    public function checkBy()
    {
        return $this->belongsTo('App\User','checked_by');
    }

    public function approveBy()
    {
        return $this->belongsTo('App\User','approved_by');
    }

    public function approveByChireman()
    {
        return $this->belongsTo('App\User','approved_by_chairman');
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
