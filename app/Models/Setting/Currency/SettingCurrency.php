<?php

namespace App\Models\Setting\Currency;

use Illuminate\Database\Eloquent\Model;

class SettingCurrency extends Model
{


    public function rate()
    {
      return $this->hasMany('App\Models\Setting\Currency\SettingCurrencyRate','currency_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
