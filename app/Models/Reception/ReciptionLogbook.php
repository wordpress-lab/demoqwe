<?php

namespace App\Models\Reception;

use Illuminate\Database\Eloquent\Model;

class ReciptionLogbook extends Model
{
    protected $table = 'reciption_logbooks';

    public function categoryId()
    {
        return $this->belongsTo('App\Models\Reception\ReciptionCategory','category_id');
    }

    public function contactId()
    {
        return $this->belongsTo('App\Models\Contact\Contact','associated_contact');
    }

    public function itemId()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_name');
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
