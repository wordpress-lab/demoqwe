<?php

namespace App\Models\Agreement;

use Illuminate\Database\Eloquent\Model;

class Agreement_Paper_Pax extends Model
{
    protected $table = 'agreement_paper_pax';

    protected $fillable = [
        'agreement_paper_id',
        'recruit_id',
    ];

    public function customer()
    {
        return $this->belongsTo('App\Models\Agreement\Agreement_Paper','agreement_paper_id');
    }
    public function recruit()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','recruit_id');
    }
}
