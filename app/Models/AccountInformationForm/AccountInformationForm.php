<?php

namespace App\Models\AccountInformationForm;

use Illuminate\Database\Eloquent\Model;
use MichaelAChrisco\ReadOnly\ReadOnlyTrait;
class AccountInformationForm extends Model
{

    //use ReadOnlyTrait;

    protected $table = 'account_information_forms';

    protected $fillable = [
    	'signature_of_executive',
    	'executive_comment',
    	'signature_of_manager',
    	'manager_comment',
    	'signature_of_account',
    	'account_comment',
    	'signature_of_admin',
    	'admin_comment',
    	'signature_of_director',
    	'director_comment',
    	'signature_of_billing_officer',
    	'billing_officer_comment',
    ];

    public function user()
    {
        return $this->belongsTo('App\User','user_id');
    }

    public function modelNo1()
    {
        return $this->belongsTo('App\Models\Inventory\Item','machine_model_no_1');
    }

    public function modelNo2()
    {
        return $this->belongsTo('App\Models\Inventory\Item','machine_model_no_2');
    }

    public function optionalModelNo1()
    {
        return $this->belongsTo('App\Models\Inventory\Item','optional_model_no_1');
    }

    public function optionalModelNo2()
    {
        return $this->belongsTo('App\Models\Inventory\Item','optional_model_no_2');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }
}
