<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Estimate_Entry extends Model
{
   protected $table= "estimate_entries";

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }




}
