<?php

namespace App\models\inventory;

use Illuminate\Database\Eloquent\Model;

class ProductPhaseItemAdd extends Model
{
    protected $table = 'product_phase_item_add';

    protected $fillable = [
        'id',
        'item_category_id',
        'item_id',
        'total',
        'product_phase_item_id',
    ];

    public function productPhaseItem()
    {
        return $this->belongsTo('App\Models\Inventory\ProductPhaseItem');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item');
    }

    public function itemCategory()
    {
        return $this->belongsTo('App\Models\Inventory\ItemCategory');
    }

}
