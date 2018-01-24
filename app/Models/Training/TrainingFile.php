<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;

class TrainingFile extends Model
{
    protected $table = 'training_files';

    public function trainingId()
    {
        return $this->belongsTo('App\Models\Training\Training' , 'fingerprint_id');
    }
}
