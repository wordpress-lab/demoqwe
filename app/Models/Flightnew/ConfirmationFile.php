<?php

namespace App\Models\Flightnew;

use Illuminate\Database\Eloquent\Model;

class ConfirmationFile extends Model
{
    protected $table = 'confirmation_files';

    public function confirmationId()
    {
        return $this->belongsTo('App\Models\Flightnew\Confirmation' , 'confirmation_id');
    }
}
