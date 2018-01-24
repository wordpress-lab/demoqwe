<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class CreditNoteEntry extends Model
{
    protected $table = 'credit_note_entries';

    protected $fillable = [
        'quantity',
        'rate',
        'amount',
        'discount',
        'item_id',
        'credit_note_id',
        'tax_id',
        'account_id'
    ];

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }

    public function creditNote()
    {
        return $this->belongsTo('App\Models\Moneyin\CreditNote','credit_note_id');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\AccountChart\Account','account_id');
    }
}
