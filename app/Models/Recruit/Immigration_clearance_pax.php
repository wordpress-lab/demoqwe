<?php

namespace App\Models\Recruit;

use Illuminate\Database\Eloquent\Model;

class Immigration_clearance_pax extends Model
{
    protected $table='immigration_clearance_pax';

    protected $fillable=[

        'immigration_clearance_id',
        'pax_id',

    ];


    public function recruit(){

        return $this->belongsTo('App\Models\Recruit\Recruitorder','pax_id');
    }

    public function immigration(){

        return $this->belongsTo('App\Models\Recruit\Immigration_clearance','immigration_clearance_id');
    }

}
