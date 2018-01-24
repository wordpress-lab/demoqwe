<?php

namespace App\Models\Fitcard;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Fit_Card extends Model
{
    protected $table = 'fit_card';

    protected $fillable = [
        'pax_id',
        'receive_date',
        'created_by',
        'updated_by'
    ];

    public function fit_card_file()
    {
        return $this->hasMany('App\Models\Fitcard\Fit_Card_File','fit_card_id');
    }


    public function pax_Id()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','pax_id');
    }
    function scopePaxStatus($query,$status=1)
    {

        return $query->join("recruitingorder","recruitingorder.id","fit_card.pax_id")
                     ->where("recruitingorder.status",$status);

   }
    function scopeRecieveDateNotNull($query)
    {

        return $query->whereNotNull("fit_card.receive_date")
                     ->where("fit_card.receive_date","!=","");
    }

    function scopeSelectDaysLeft($query,$col_name='leftdays')
    {

        return $query->select(DB::raw("fit_card.*,DATEDIFF(DATE_ADD(fit_card.receive_date,INTERVAL 50 DAY),CURDATE()) as $col_name"));
    }

    function scopeManpowerRecieveDateNotNull($query)
    {

        return $query->leftjoin("manpower","manpower.paxid","fit_card.pax_id")
                     ->whereNull("manpower.receivingDate")
                     ->Orwhere("manpower.receivingDate","");
    }

    function scopeManpowerissuingDateNotNull($query)
    {

        return $query->leftjoin("manpower","manpower.paxid","fit_card.pax_id")
            ->whereNull("manpower.issuingDate")
            ->Orwhere("manpower.issuingDate","");
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
