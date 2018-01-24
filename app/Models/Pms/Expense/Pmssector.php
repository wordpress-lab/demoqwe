<?php

namespace App\Models\Pms\Expense;

use Illuminate\Database\Eloquent\Model;

class Pmssector extends Model
{

    protected $table = "pms_expense_sector";
    public function expense(){
        return $this->hasMany('App\Models\Pms\Expense\Pmsexpense','pmsexpense_sector_id');
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
