<?php

namespace App\Models\Recruit;

use Illuminate\Database\Eloquent\Model;

class RecruiteExpensePax extends Model
{
    protected $table = "recruiteexpensepax";

    public function RecruiteExpense()
    {
        return $this->belongsTo('App\Models\Recruit\RecruitExpense','recruitExpenseid');
    }


}
