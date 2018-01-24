<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected  $table = "documentcategory";

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}
