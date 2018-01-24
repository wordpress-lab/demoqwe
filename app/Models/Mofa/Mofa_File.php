<?php

namespace App\Models\Mofa;

use Illuminate\Database\Eloquent\Model;

class Mofa_File extends Model
{
    protected $table = 'mofa_file';

    protected $fillable = [
        'mofa_id',
        'title',
        'img_url'
    ];

    public function mofass()
    {
        return $this->belongsTo('App\Models\Mofa\Mofa','mofa_id');
    }
}
