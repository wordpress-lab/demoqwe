<?php

namespace App\Models\Agreement;

use Illuminate\Database\Eloquent\Model;

class Agreement_Paper extends Model
{
    protected $table = 'agreement_paper';

    protected $fillable = [
        'country_name',
        'gender',
        'created_by',
        'updated_by',
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
