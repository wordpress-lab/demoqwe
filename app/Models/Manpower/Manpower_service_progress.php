<?php

namespace App\Models\Manpower;

use Illuminate\Database\Eloquent\Model;

class Manpower_service_progress extends Model
{
    protected $table = 'manpower_service_progress_status';

    protected $fillable = [
        'title',
        'note',
        'created_by',
        'updated_by',
    ];


    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
