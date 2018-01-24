<?php

namespace App\Models\Completion;

use Illuminate\Database\Eloquent\Model;

class Completion extends Model
{
    protected $table = 'completions';

    public function paxId()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','paxid');
    }

    public function completionFile()
    {
        return $this->hasMany('App\Models\Completion\CompletionFile' , 'completion_id');
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
