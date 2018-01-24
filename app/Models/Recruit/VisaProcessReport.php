<?php

namespace App\Models\Recruit;

use Illuminate\Database\Eloquent\Model;

class VisaProcessReport extends Model
{
     protected $table='visa_process_report';

     protected $fillable=[
         'date',
         'visa_number',
         'remarks',
         'recruit_id',
         'created_by',
         'updated_by'
     ];


     public function recruit(){

         return $this->belongsTo('App\Models\Recruit\Recruitorder','recruit_id');
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
