<?php

namespace App\Models\Formbasis;

use Illuminate\Database\Eloquent\Model;

class Formbasis extends Model
{
    protected $table = 'form_basis';

    protected $fillable = [
        'companyNameEN',
        'companyNameBN',
        'ownerNameEN',
        'ownerNameBN',
        'addressEN',
        'addressBN',
        'licenceEN',
        'licenceBN',
        'ownerDesignationEN',
        'ownerDesignationBN',
        'setting_id',
    ];


}
