<?php

namespace App\Models\AccountChart;

use Illuminate\Database\Eloquent\Model;

class ParentAccountType extends Model
{
    protected $table = 'parent_account_type';

    protected $fillable = [
        'account_name',
        'description',
    ];
}
