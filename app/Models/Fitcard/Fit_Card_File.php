<?php

namespace App\Models\Fitcard;

use Illuminate\Database\Eloquent\Model;

class Fit_Card_File extends Model
{
    protected $table = 'fit_card_file';

    protected $fillable = [
        'fit_card_id',
        'title',
        'img_url'

    ];

    public function fit_card()
    {
        return $this->belongsTo('App\Models\Fitcard\Fit_Card','fit_card_id');
    }
}
