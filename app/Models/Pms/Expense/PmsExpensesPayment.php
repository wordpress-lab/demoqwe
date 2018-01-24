<?php

namespace App\Models\Pms\Expense;

use Illuminate\Database\Eloquent\Model;

class PmsExpensesPayment extends Model
{
    protected $table = 'pms_expenses_payments';

    public function expenseId()
    {
    	return $this->belongsTo('App\Models\Pms\Expense\Pmsexpense','pms_expenses_id');
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
