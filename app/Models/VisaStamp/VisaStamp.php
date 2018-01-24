<?php

namespace App\Models\VisaStamp;

use Illuminate\Database\Eloquent\Model;

class VisaStamp extends Model
{
    protected $table = 'visastamping';
    protected $fillable = [
        'pax_id',
        'send_date',
        'return_date',
        /*'eapplication_no',*/
        'comment',
        'created_by',
        'updated_by',
    ];

    public function paxId()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','pax_id');
    }

    function scopeReturnDateNotNull($query) {

        return $query->whereNotNull('return_date')->where('return_date','!=',"");
    }
    function scopeEappilicationNotNull($query) {

        return $query->whereNotNull('eapplication_no')->where("eapplication_no",'!=',"");
    }
    function scopeDueAmountNotZero($query) {

        return $query->join('recruitingorder','recruitingorder.id','visastamping.pax_id')
            ->join('invoices','invoices.id','recruitingorder.invoice_id')
            ->where('invoices.due_amount','!=',0)
            ->select('visastamping.*');
    }
   /* public function companyId(){
        return $this->belongsTo('App\Models\Company\Company','company_id');
    }*/
    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','created_by');
    }


}
