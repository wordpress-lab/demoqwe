<?php

namespace App\Models\Reception;

use Illuminate\Database\Eloquent\Model;

class ReciptionCategory extends Model
{
    protected $table = 'reciption_categories';

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}
