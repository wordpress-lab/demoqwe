<?php

namespace App\Models\Completion;

use Illuminate\Database\Eloquent\Model;

class CompletionFile extends Model
{
    protected $table = 'completion_files';

    public function completionId()
    {
        return $this->belongsTo('App\Models\Completion\Completion' , 'completion_id');
    }
}
