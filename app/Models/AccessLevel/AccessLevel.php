<?php

namespace App\Models\AccessLevel;

use Illuminate\Database\Eloquent\Model;

class AccessLevel extends Model
{
    protected $table = 'access_level';

    protected $fillable = [
        'create',
        'read',
        'update',
        'delete',
        'module_id',
        'role_id',
        'created_by',
        'updated_by'
    ];

    public function module()
    {
        return $this->belongsTo('App\Models\AccessLevel\Modules');
    }
}
