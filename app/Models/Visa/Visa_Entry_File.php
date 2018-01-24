<?php

namespace App\Models\Visa;

use Illuminate\Database\Eloquent\Model;

class Visa_Entry_File extends Model
{
    protected $table = "visa_entry_file";


    public function visaentry()
    {

        return $this->belongsTo('App\Models\Visa\Visa','visaentrys_id');
    }
}
