<?php

namespace App\Models\PriceList;

use Illuminate\Database\Eloquent\Model;

class PriceList extends Model
{
    protected $table = 'price_lists';

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function contact()
    {
        return $this->belongsTo('App\Models\Contact\Contact' , 'contact_id');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item' , 'item_id');
    }
}
