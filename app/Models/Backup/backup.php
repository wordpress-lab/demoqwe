<?php

namespace App\Models\Backup;

use Illuminate\Database\Eloquent\Model;

class backup extends Model
{
    protected $table = "backup";

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}
