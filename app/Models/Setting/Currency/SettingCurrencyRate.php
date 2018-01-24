<?php

namespace App\Models\Setting\Currency;

use Illuminate\Database\Eloquent\Model;

class SettingCurrencyRate extends Model
{
    public function currency()
    {
        return $this->belongsTo('App\Models\Setting\Currency\SettingCurrency','currency_id');
    }
}
