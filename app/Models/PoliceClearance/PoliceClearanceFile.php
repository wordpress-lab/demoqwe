<?php

namespace App\Models\PoliceClearance;

use Illuminate\Database\Eloquent\Model;

class PoliceClearanceFile extends Model
{
    protected $table = 'police_clearance_files';

    public function policeClearanceId()
    {
        return $this->belongsTo('App\Models\PoliceClearance\PoliceClearance' , 'police_clearance_id');
    }
}
