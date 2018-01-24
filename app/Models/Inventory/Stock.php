<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    protected $table = 'stock';

    protected $fillable = [
        'id',
        'total',
        'date',
        'item_category_id',
        'item_id',
        'branch_id',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
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

    public function itemCategory()
    {
        return $this->belongsTo('App\Models\Inventory\ItemCategory');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item');
    }

    public function bill()
    {
        return $this->belongsTo('App\Models\MoneyOut\Bill', 'bill_id');
    }

    public function creditNote()
    {
        return $this->belongsTo('App\Models\Moneyin\CreditNote', 'credit_note_id');
    }
}
