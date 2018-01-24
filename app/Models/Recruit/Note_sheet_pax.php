<?php

namespace App\Models\Recruit;

use Illuminate\Database\Eloquent\Model;

class Note_sheet_pax extends Model
{
    protected $table='note_sheet_pax';

    protected $fillable=[
        'brifing',
        'comment',
        'recruit_id',
        'note_sheet_id',
        'created_by',
        'updated_by'
    ];


    public function note_sheet(){

        return $this->belongsTo('App\Models\Recruit\Note_sheet','note_sheet_id');
    }

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
