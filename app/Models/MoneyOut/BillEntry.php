<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class BillEntry extends Model
{
    protected $table = 'bill_entry';

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }

    public function bill()
    {
        return $this->belongsTo('App\Models\MoneyOut\Bill','bill_id');
    }
}
