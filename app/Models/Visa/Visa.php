<?php

namespace App\Models\Visa;

use Illuminate\Database\Eloquent\Model;

class Visa extends Model
{
    protected $table = "visaentrys";

   public function RecruitOrder()
   {
       return $this->hasMany('App\Models\Recruit\Recruitorder','registerSerial_id');
   }
   function scopeVisaValidityReminder($query) {

        return $query->whereRaw("CURDATE() + 0 >= DATE_SUB(expire_date,INTERVAL 2 MONTH)");
   }
    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function visaentryfile()
    {

        return $this->hasMany('App\Models\Visa\Visa_Entry_File','visaentrys_id');
    }


    public function Company()
    {
        return $this->belongsTo('App\Models\Company\Company','company_id');
    }

    public function Contact()
    {
        return $this->belongsTo('App\Models\Contact\Contact','local_Reference');
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
