<?php

namespace App\Models\AccessLevel;

use Illuminate\Database\Eloquent\Model;

class Modules extends Model
{
    protected $table = 'modules';

    protected $fillable = [
        'module_name',
        'module_prefix'
    ];

    public function accessLevel()
    {
        return $this->hasOne('App\Models\AccessLevel\AccessLevel', 'module_id');
    }
}
