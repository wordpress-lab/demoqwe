<?php

namespace App\Models\OrganizationProfile;

use Illuminate\Database\Eloquent\Model;

class OrganizationProfile extends Model
{
    protected $table = "organization_profiles";

    protected $fillable = [
        'logo',
        'display_name',
        'company_name',
        'street',
        'city',
        'state',
        'country',
        'zip_code',
        'website',
        'contact',
        'email',
    ];
}
