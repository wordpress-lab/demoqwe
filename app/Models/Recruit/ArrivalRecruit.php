<?php

namespace App\Models\Recruit;

use Illuminate\Database\Eloquent\Model;

class ArrivalRecruit extends Model
{
    protected $table='arrival_recruit';

    protected $fillable=[
        'recruitorder_id',
        'arrival_number',
        'file_url',
        'created_by',
        'updated_by'
    ];

    public function recruit_order()
    {

        return $this->hasMany('App\Models\Recruit\Recruitorder','recruitorder_id');
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
