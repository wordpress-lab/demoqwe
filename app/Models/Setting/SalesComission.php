<?php

namespace App\Models\setting;

use Illuminate\Database\Eloquent\Model;

class SalesComission extends Model
{
    protected $table = "salescommisions";
    protected $fillable = ['agents_id', 'date', 'bank_info','show','amount','PersonalNote','CustomerNote','paid_through_id','updated_by'];
    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function Agents()
    {
        return $this->belongsTo('App\Models\Contact\Contact', 'agents_id');
    }

    public function Account()
    {
        return $this->belongsTo('App\Models\AccountChart\Account', 'paid_through_id');
    }

    public function recruitExpense(){
        return $this->hasOne('App\Models\Recruit\RecruitExpense',"sales_commission_id");
    }

}
