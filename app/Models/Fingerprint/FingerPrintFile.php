<?php

namespace App\Models\Fingerprint;

use Illuminate\Database\Eloquent\Model;

class FingerPrintFile extends Model
{
    protected $table = 'finger_print_files';

    public function fingerId()
    {
        return $this->belongsTo('App\Models\Fingerprint\Fingerprint' , 'fingerprint_id');
    }
}
