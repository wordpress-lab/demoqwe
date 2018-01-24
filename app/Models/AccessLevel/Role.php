<?php

namespace App\Models\AccessLevel;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    protected $table = 'roles';

    protected $fillable = [
        'name'
    ];

    public function users(){

        return $this->hasMany('App\User','role_id');
    }
}
