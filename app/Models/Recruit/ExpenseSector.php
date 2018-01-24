<?php

namespace App\Models\Recruit;

use Illuminate\Database\Eloquent\Model;

class ExpenseSector extends Model
{
    protected $table = "expensesector";


    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
