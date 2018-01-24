<?php

namespace App\Models\Mofa;

use Illuminate\Database\Eloquent\Model;

class Mofa extends Model
{
    protected $table = 'mofas';

   public function pax()
   {
       return $this->belongsTo('App\Models\Recruit\Recruitorder','pax_id');
   }

    public function mofa_file()
    {
        return $this->hasMany('App\Models\Mofa\Mofa_File','mofa_id');
    }


    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
