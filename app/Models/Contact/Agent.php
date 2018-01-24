<?php

namespace App\Models\Contact;

use Illuminate\Database\Eloquent\Model;

class Agent extends Model
{
    protected $table = 'agents';

    protected $fillable = [
        'first_name',
        'last_name',
        'profile_pic_url',
        'display_name',
        'company_name',
        'email_address',
        'skype_name',
        'phone_number_1',
        'phone_number_2',
        'phone_number_3',
        'billing_street',
        'billing_city',
        'billing_state',
        'billing_zip_code',
        'billing_country',
        'shipping_street',
        'shipping_city',
        'shipping_zip_code',
        'shipping_country',
        'fb_id',
        'tw_id',
        'about',
        'contact_status',
        'branch_id',
        'created_by',
        'updated_by'
    ];

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','updated_by');
    }

    public function contactCategory()
    {
        return $this->belongsTo('App\Models\Contact\ContactCategory');
    }

    public function branch()
    {
        return $this->belongsTo('App\Models\Branch\Branch');
    }

    public function invoice()
    {
        return $this->hasMany('App\Models\Moneyin\Invoice');
    }

    public function bills()
    {
        return $this->hasMany('App\Models\MoneyOut\Bill', 'vendor_id');
    }

    public function paymentMades()
    {
        return $this->hasMany('App\Models\MoneyOut\PaymentMade', 'vendor_id');
    }

    public function creditNotes()
    {
        return $this->hasMany('App\Models\Moneyin\CreditNote','customer_id');
    }

    public function journalEntries()
    {
        return $this->hasMany('App\Models\ManualJournal\JournalEntry','contact_id');
    }

    public function expenses()
    {
        return $this->hasMany('App\Models\MoneyOut\Expense', 'vendor_id');
    }
    
    public function contacts()
    {
        return $this->hasMany('App\Models\Contact\Contact', 'agent_id');
    }
}
