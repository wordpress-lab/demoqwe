<?php

namespace App\Models\ConveyanceBill;

use Illuminate\Database\Eloquent\Model;

class ConveyanceBillList extends Model
{
    protected $table = 'conveyance_bill_lists';

    public function conveyanceBillId()
    {
        return $this->belongsTo('App\Models\ConveyanceBill\ConveyanceBill','conveyance_bill_id');
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
