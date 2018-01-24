<?php

namespace App\Models\Musaned;

use Illuminate\Database\Eloquent\Model;

class Musaned extends Model
{
    protected $table = 'musaned';
    protected $fillable = [
        'pax_id',
        'issue_date',
        'company_id',
        'created_by',
        'updated_by',
    ];

    public function paxId()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','pax_id');
    }

    public function companyId(){
        return $this->belongsTo('App\Models\Company\Company','company_id');
    }
    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','created_by');
    }


}
