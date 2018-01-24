<?php

namespace App\Models\Pms;

use Illuminate\Database\Eloquent\Model;

class Pms_Site extends Model
{
    protected $fillable = [
        'created_by',
        'updated_by',
    ];
    public function employees(){
        return $this->hasMany('App\Models\Pms\Pms_Employee','site_name');
    }
    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
