<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ProductPhase extends Model
{
    protected $table = 'product_phase';

    protected $fillable = [
        'id',
        'product_phase_name',
        'status',
        'product_id',
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

    public function product()
    {
        return $this->belongsTo('App\Models\Inventory\Product');
    }
    
    public function productPhaseItems()
    {
        return $this->hasMany('App\Models\Inventory\ProductPhaseItem','product_phase_id');
    }
}
