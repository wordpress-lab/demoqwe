<?php

namespace App\Models\Email;

use Illuminate\Database\Eloquent\Model;

class Email extends Model
{
    protected $table='email';

    protected $fillable=['to','subject','details','file','created_by','updated_by'];


    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
