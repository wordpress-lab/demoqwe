<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $table = 'item';

    protected $fillable = [
        'id',
        'item_name',
        'item_about',
        'item_sales_rate',
        'item_sales_account',
        'item_sales_description',
        'item_sales_tax',
        'item_purchase_rate',
        'item_purchase_account',
        'item_purchase_description',
        'reorder_point',
        'barcode',
        'item_image_url',
        'total_purchase',
        'total_sales',
        'item_category_id',
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

    public function purchaseAccount()
    {
        return $this->belongsTo('App\Models\AccountChart\Account', 'item_purchase_account');
    }

    public function salesAccount()
    {
        return $this->belongsTo('App\Models\AccountChart\Account', 'item_sales_account');
    }

    public function stocks()
    {
        return $this->hasMany('App\Models\Inventory\Stock', 'item_id');
    }
    
    public function invoiceEntries()
    {
        return $this->hasMany('App\Models\Moneyin\InvoiceEntry','item_id');
    }

    public function billEntries()
    {
        return $this->hasMany('App\Models\MoneyOut\BillEntry','item_id');
    }

    public function creditNoteEntries()
    {
        return $this->hasMany('App\Models\Moneyin\CreditNoteEntry','item_id');
    }
}
