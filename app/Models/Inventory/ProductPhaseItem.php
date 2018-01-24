<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ProductPhaseItem extends Model
{
    protected $table = 'product_phase_item';

    protected $fillable = [
        'id',
        'date',
        'issued_number',
        'reference',
        'reason',
        'personal_note',
        'recipient_id',
        'issued_by',
        'product_id',
        'product_phase_id',
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

    public function issuedBy()
    {
        return $this->belongsTo('App\User','issued_by');
    }

    public function itemCategory()
    {
        return $this->belongsTo('App\Models\Inventory\ItemCategory');
    }

    public function item()
    {
        return $this->belongsTo('App\Models\Inventory\Item');
    }

    public function product()
    {
        return $this->belongsTo('App\Models\Inventory\Product');
    }

    public function productPhase()
    {
        return $this->belongsTo('App\Models\Inventory\ProductPhase');
    }
    public function productPhaseItemAdds()
    {
        return $this->hasMany('App\Models\Inventory\ProductPhaseItemAdd','product_phase_item_id');
    }

    public function contact()
    {
        return $this->belongsTo('App\Models\Contact\Contact','recipient_id');
    }

    

}
