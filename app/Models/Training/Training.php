<?php

namespace App\Models\Training;

use Illuminate\Database\Eloquent\Model;

class Training extends Model
{
    protected $table = 'trainings';

    public function paxId()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','paxid');
    }

    public function trainingFile()
    {
        return $this->hasMany('App\Models\Training\TrainingFile','training_id');
    }

    public function singletrainingFile()
    {
        return $this->hasOne('App\Models\Training\TrainingFile','training_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
