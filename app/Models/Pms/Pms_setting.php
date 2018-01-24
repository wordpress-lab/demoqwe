<?php

namespace App\Models\Pms;

use Illuminate\Database\Eloquent\Model;

class Pms_setting extends Model
{

    protected $fillable = ['title','setting_data','created_by','updated_by'];

    protected $casts = [
        'options' => 'array',
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
