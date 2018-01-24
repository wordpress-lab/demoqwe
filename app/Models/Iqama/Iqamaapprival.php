<?php

namespace App\Models\Iqama;

use Illuminate\Database\Eloquent\Model;

class Iqamaapprival extends Model
{
    protected $table = 'iqamaapproval';

    public function recruitId()
    {
    	return $this->belongsTo('App\Models\Recruit\Recruitorder','recruitingorder_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}
