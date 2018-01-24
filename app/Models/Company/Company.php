<?php

namespace App\Models\Company;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $table = 'company';

    protected $fillable = [
        'name',
        'company_code',
        'created_by',
        'updated_by',
    ];

   public function Visas(){
      return $this->hasMany('App\Models\Visa\Visa','company_id');
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
