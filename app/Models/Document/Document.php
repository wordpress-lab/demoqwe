<?php

namespace App\Models\Document;

use Illuminate\Database\Eloquent\Model;

class Document extends Model
{
    protected $table = "document";


    public function Category()
    {
        return $this->belongsTo('App\Models\Document\Category','documentcategory_id');
    }

    public function Pax()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','pax_id');
    }
    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}
