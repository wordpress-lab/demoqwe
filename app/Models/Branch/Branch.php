<?php

namespace App\Models\Branch;

use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    protected $table = 'branch';

    protected $fillable = [
        'branch_name',
        'branch_description',
        'created_by',
        'updated_by'
    ];

 public function Users(){

     return $this->hasMany('App\User','branch_id');
 }
}
