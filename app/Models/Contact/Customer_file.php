<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Model;

class Customer_file extends Model
{
    protected $table = 'customer_file';

    protected $fillable = [
        'customer_id',
        'title',
        'img_url',

    ];


    public function contact()
    {
        return $this->belongsTo('App\Models\Recruit_Customer\Recruit_customer','customer_id');
    }
}
