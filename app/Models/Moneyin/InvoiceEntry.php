<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class InvoiceEntry extends Model
{
    protected $table = 'invoice_entries';

    protected $fillable = ['quantity','amount','discount','item_id','invoice_id','tax_id','account_id'];
    
    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item','item_id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Models\Moneyin\Invoice','invoice_id');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\AccountChart\Account','account_id');
    }
}
