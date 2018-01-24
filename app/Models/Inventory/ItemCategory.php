<?php

namespace App\Models\Inventory;

use Illuminate\Database\Eloquent\Model;

class ItemCategory extends Model
{
    protected $table = 'item_category';

    protected $fillable = [
        'id',
        'item_category_name',
        'item_category_description',
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
}
