<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Model;

class ContactCategory extends Model
{
    protected $table = 'contact_category';

    protected $fillable = [
        'contact_category_name',
        'contact_category_description',
        'branch_id',
        'created_by',
        'updated_by'
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }


    public function contacts()
    {
        return $this->hasMany('App\Models\Contact\Contact');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch\Branch');
    }
}
