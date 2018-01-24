<?php

namespace App\Models\Recruit_Customer;

use Illuminate\Database\Eloquent\Model;

class Recruit_customer extends Model
{
    protected $table = 'recruit_customer';

    protected $fillable = [
        'dateOfBirthEN',
        'dateOfBirthBN',
        'gender',
        'addressEN',
        'addressBN',
        'religionEN',
        'religionBN',
        'guardianName',
        'guardianFatherName',
        'guardianAddressEN',
        'guardianAddressBN',
        'guardianReligion',
        'relationWithCustomer_1',
        'relationWithCustomer_2',
        'motherName',
        'fatherName',
        'placeOfBirth',
        'previousNationality',
        'presentNationality',
        'maritalStatus',
        'group',
        'professionEn',
        'professionBn',
        'professionAR',
        'businessAddressEN',
        'businessAddressBN',
        'purposeOfTravel',
        'durationOfStay',
        'arrivalDate',
        'departureDate',
        'visaAdvice',
        'destination',
        'recruit_id',
        'pax_id',
    ];

    public function contact_file()
    {
        return $this->hasMany('App\Models\Contact\Customer_file','customer_id');
    }

    public function paxId()
    {
        return $this->belongsTo('App\Models\Recruit\Recruitorder','recruit_id');
    }

    public function RecruitCustomer(){
        return $this->hasMany('App\Models\Contact\Subreference','recruit_customer_id');
    }
}
