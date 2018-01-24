<?php

namespace App\Models\Bank;

use Illuminate\Database\Eloquent\Model;

class BankName extends Model
{
    protected $table = 'bank_name';

    protected $fillable = [
    
        'bank_name',
    ];

    public function bankName()
    {
        return $this->hasMany('App\Models\Bank\Bank','bank_name_id');
    }
}
