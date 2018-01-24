<?php

namespace App\Models\Recruit;

use Illuminate\Database\Eloquent\Model;

class RecruitExpense extends Model
{
    protected $table = "recruiteexpense";



    public function Sector()
    {

        return $this->belongsTo('App\Models\Recruit\ExpenseSector','expenseSectorid');
    }

    public function paxId()
    {
        return $this->belongsToMany('App\Models\Recruit\Recruitorder','recruiteexpensepax','recruitExpenseid','paxid');
    }

    public function vendor()
    {
//        return $this->hasManyThrough(
//            'App\Models\Contact\Contact', 'App\Models\MoneyOut\Expense',
//             'expense_id','vendor_id'
//        );

    }

    public function recruitExpensePax()
    {
        return $this->hasOne('App\Models\Recruit\RecruiteExpensePax','recruitExpenseid');
    }


    public function amount()
    {
        return $this->belongsTo('App\Models\MoneyOut\Expense','expense_id');
    }
    public function expense()
    {
        return $this->belongsTo('App\Models\MoneyOut\Expense','expense_id');
    }
    public function salesCommission()
    {
        return $this->belongsTo('App\Models\Setting\SalesComission','sales_commission_id');
    }
}
