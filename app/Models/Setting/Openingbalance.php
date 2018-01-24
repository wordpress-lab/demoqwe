<?php

namespace App\Models\Setting;

use Illuminate\Database\Eloquent\Model;

class Openingbalance extends Model
{
   protected $table="openningbalances";
   protected $guarded = array('id','openningBalanceDate');
}
