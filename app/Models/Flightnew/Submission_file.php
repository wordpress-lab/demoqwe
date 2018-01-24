<?php

namespace App\Models\Flightnew;

use Illuminate\Database\Eloquent\Model;

class Submission_file extends Model
{
    protected $table = 'submission_file';

    protected $fillable = [
        'submission_id',
        'title',
        'img_url'
    ];


    public function submition()
    {
        return $this->belongsTo('App\Models\Flightnew\Submission','submission_id');
    }

}
