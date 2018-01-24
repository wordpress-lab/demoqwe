<?php

namespace App\Models\Recruit;

use Illuminate\Database\Eloquent\Model;

class Recruitorder extends Model
{
    protected $table = 'recruitingorder';

    public function geturlAttribute($value)
    {
        $value = route("customer_dashboard",$value);
        return $value;
    }
    public function paxId()
    {
        return $this->belongsTo('App\Models\Okala\Okala','paxid','id');
    }

    public function order_file()
    {
        return $this->hasMany('App\Models\Order\Order_file','recruit_order_id');
    }
    public function iqamaReceive()
    {
        return $this->hasOne('App\Models\Iqama\Receive','recruitingorder_id');
    }
    public function reciepient()
    {
         return $this->hasOne('App\Models\Iqama\Delivery\Receipient','recruitingorder_id');
    }
    public function iqamaSubmission()
    {
        return $this->hasOne('App\Models\Iqama\IqamaSubmission','recruitingorder_id');
    }
    public function report_file()
    {
        return $this->hasMany('App\Models\MedicalSlip\Report_File','mrdical_slip_id');
    }

    public function fitcard()
    {
        return $this->hasOne('App\Models\Fitcard\Fit_Card', 'pax_id');
    }

    public function submission()
    {
        return $this->hasOne('App\Models\Flightnew\Submission', 'pax_id');
    }

    public function document()
    {
        return $this->hasOne('App\Models\Document\Document','pax_id');
    }

    public function confirmation()
    {
        return $this->hasOne('App\Models\Flightnew\Confirmation', 'pax_id');
    }

    public function okala()
    {
        return $this->hasOne('App\Models\Okala\Okala','paxid','id');
    }
    public function ft_pax()
    {
        return $this->belongsTo('App\Models\Fingerprint\Fingerprint','paxid','id');
    }
    public function beforeSixtyDays()
    {
        return $this->hasone('App\Models\Kafala\kafala','recruitingorder_id','id');
    }
    public function afterSixtyDays()
    {
        return $this->hasone('App\Models\Kafala\Aftersixyday','recruitingorder_id','id');
    }
    public function finger()
    {
        return $this->hasOne('App\Models\Fingerprint\Fingerprint','paxid','id');
    }
    public function training()
    {
        return $this->hasOne('App\Models\Training\Training','paxid','id');
    }

    public function arrival_recruit()
    {
        return $this->hasOne('App\Models\Recruit\ArrivalRecruit','recruitorder_id','id');
    }

    public function completion()
    {
        return $this->hasOne('App\Models\Completion\Completion','paxid','id');
    }
    public function police()
    {
        return $this->hasOne('App\Models\PoliceClearance\PoliceClearance','paxid','id');
    }
    public function mp_pax()
    {
        return $this->belongsTo('App\Models\Manpower\Manpower','paxid','id');
    }

    public function manpower()
    {
        return $this->hasOne('App\Models\Manpower\Manpower','paxid','id');
    }

    public function gamca(){

        return $this->belongsTo('App\Models\Recruit\Gamca','recruit_id');
    }

    public function newflight()
    {
        //rayhan
        return $this->hasone('App\Models\Flight\Flight','paxid');
    }
    public function flight()
    {
        return $this->belongsTo('App\Models\Flight\Flight','paxid','id');
    }
    public function flights()
    {
        return $this->hasOne('App\Models\Flight\Flight','paxid','id');
    }
    public function mofa()
    {
        return $this->belongsTo('App\Models\Mofa\Mofa','paxid','id');
    }
    public function mofas()
    {
        return $this->hasOne('App\Models\Mofa\Mofa','pax_id','id');
    }
    public function musan()
    {
        return $this->belongsTo('App\Models\Musaned\Musaned','paxid','id');
    }
    public function musanand()
    {
        return $this->hasOne('App\Models\Musaned\Musaned','pax_id','id');
    }
    public function medical()
    {
    return $this->belongsTo('App\Models\MedicalSlip\Medicalslip','paxid','id');
    }
    public function medical_slip()
    {
        return $this->hasOne('App\Models\MedicalSlip\Medicalslip','pax_id','id');
    }
    public function visa()
    {
        return $this->belongsTo('App\Models\VisaStamp\VisaStamp','paxid','id');
    }

    public function visas()
    {
        return $this->hasOne('App\Models\VisaStamp\VisaStamp','pax_id','id');
    }
    public function iqamaApproval()
    {
        return $this->hasOne('App\Models\Iqama\Iqamaapprival','recruitingorder_id','id');
    }

    public function insurance()
    {
        return $this->hasOne('App\Models\Iqama\Insurance','recruitingorder_id','id');
    }

    public function stamp_approval()
    {
        return $this->hasOne('App\Models\StampingApproval\StampingApproval','pax_id','id');
    }
    public function customer()
    {
        return $this->belongsTo('App\Models\Contact\Contact','customer_id');
    }
    public function package()
    {
        return $this->belongsTo('App\Models\Inventory\Item','package_id');
    }
    public function registerserial()
    {
        return $this->belongsTo('App\Models\Visa\Visa','registerSerial_id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Models\Moneyin\Invoice','invoice_id');
    }


    public function bill()
    {
        return $this->belongsTo('App\Models\MoneyOut\Bill','bill_id');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function recruit_customer()
    {
        return $this->hasOne('App\Models\Recruit_Customer\Recruit_customer','recruit_id');
    }

    public function medicalslipFromPax()
    {
        return $this->belongsToMany('App\Models\MedicalSlipForm\MedicalSlipForm','medical_slip_form_pax','recruit_id','medicalslip_id');
    }

    public function visaForm()
    {
        return $this->hasOne('App\Models\Visa\Visaform','pax_id');
    }
}
