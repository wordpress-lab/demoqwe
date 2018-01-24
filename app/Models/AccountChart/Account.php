<?php

namespace App\Models\AccountChart;

use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    protected $table = 'account';

    protected $fillable = [
        'account_name',
        'account_code',
        'description',
        'dashboard_watchlist',
        'required_status',
        'account_type_id',
        'parent_account_type_id',
        'branch_id',
        'created_by',
        'updated_by'
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch\Branch');
    }

    public function accountType()
    {
        return $this->belongsTo('App\Models\AccountChart\AccountType');
    }

    public function items()
    {
        return $this->hasMany('App\Models\AccountChart\Account', 'item_purchase_account');
    }

    public function invoiceEntries()
    {
        return $this->hasMany('App\Models\Moneyin\InvoiceEntry', 'account_id');
    }

    public function creditNoteEntries()
    {
        return $this->hasMany('App\Models\Moneyin\CreditNoteEntry', 'account_id');
    }

    public function paymentReceives()
    {
        return $this->hasMany('App\Models\Moneyin\PaymentReceive', 'account_id');
    }

    public function paymentModes()
    {
        return $this->hasMany('App\Models\MoneyOut\PaymentMade', 'account_id');
    }

    public function expenses()
    {
        return $this->hasMany('App\Models\MoneyOut\Expense', 'account_id');
    }

    public function incomes()
    {
        return $this->hasMany('App\Models\Moneyin\Income', 'account_id');
    }

    public function expensePaidThroughes()
    {
        return $this->hasMany('App\Models\MoneyOut\Expense', 'paid_through_id');
    }

    public function incomeReceiveThroughes()
    {
        return $this->hasMany('App\Models\Moneyin\Income', 'receive_through_id');
    }
}
