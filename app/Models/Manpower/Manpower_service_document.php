<?php

namespace App\Models\Manpower;

use Illuminate\Database\Eloquent\Model;

class Manpower_service_document extends Model
{
    protected $table = 'manpower_service_ticket_document';

    protected $fillable = [
        'title',
        'file_url',
        'manpower_service_id',
        'note',
        'created_by',
        'updated_by',
    ];

    public function manpower_service()
    {
        return $this->belongsTo('App\Models\Manpower\Manpower_service','manpower_service_id');
    }


    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
