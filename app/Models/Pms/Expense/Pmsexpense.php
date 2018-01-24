<?php

namespace App\Models\Pms\Expense;

use Illuminate\Database\Eloquent\Model;

class Pmsexpense extends Model
{
    public function sector(){
        return $this->belongsTo('App\Models\Pms\Expense\Pmssector','pmsexpense_sector_id');
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
