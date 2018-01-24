<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class Estimate extends Model
{
    protected $table ="estimates";

    public function customer()
    {
        return $this->belongsTo('App\Models\Contact\Contact', 'customer_id');
    }
}
