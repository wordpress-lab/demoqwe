<?php

namespace App\Models\Order;

use Illuminate\Database\Eloquent\Model;

class Order_file extends Model
{
    protected $table='order_file';

    protected $fillable=[
        'recruit_order_id',
        'title',
        'img_url'
    ];


    public function order(){

        return $this->belongsTo('App\Models\Recruit\Recruitorder','recruit_order_id');
    }

}
