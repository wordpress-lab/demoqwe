<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class Income extends Model
{
    protected $table = 'incomes';

    public function customer()
    {
        return $this->belongsTo('App\Models\Contact\Contact', 'customer_id');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\AccountChart\Account', 'account_id');
    }

    public function accountReceiveThrough()
    {
        return $this->belongsTo('App\Models\AccountChart\Account', 'receive_through_id');
    }

    public function journalEntries()
    {
        return $this->hasMany('App\Models\ManualJournal\JournalEntry', 'income_id');
    }


}
