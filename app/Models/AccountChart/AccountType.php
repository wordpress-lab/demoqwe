<?php

namespace App\Models\AccountChart;

use Illuminate\Database\Eloquent\Model;

class AccountType extends Model
{
    protected $table = 'account_type';

    protected $fillable = [
        'account_name',
        'description',
        'parent_account_type_id',
    ];
}
