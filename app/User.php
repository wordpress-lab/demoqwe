<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'name', 'image', 'contact', 'note', 'email', 'password', 'role'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function contacts()
    {
        return $this->hasMany('App\Models\Contact\Contact');
    }

    public function contactCategories()
    {
        return $this->hasMany('App\Models\Contact\ContactCategory');
    }

    public function branches()
    {
        return $this->hasMany('App\Models\Branch\Branch');
    }

    public function accounts()
    {
        return $this->hasMany('App\Models\AccountChart\Account');
    }
    
    public function journals()
    {
        return $this->hasMany('App\Models\ManualJournal\Journal');
    }

    public function items()
    {
        return $this->hasMany('App\Models\Inventory\Item');
    }

    public function itemCategories()
    {
        return $this->hasMany('App\Models\Inventory\ItemCategory');
    }

    public function products()
    {
        return $this->hasMany('App\Models\Inventory\Product');
    }

    public function productPhases()
    {
        return $this->hasMany('App\Models\Inventory\ProductPhase');
    }

    public function productPhaseItems()
    {
        return $this->hasMany('App\Models\Inventory\ProductPhaseItem');
    }

    public function stocks()
    {
        return $this->hasMany('App\Models\Inventory\Stock');
    }

    public function userRole()
    {
        return $this->belongsTo('App\Models\AccessLevel\Role', 'role_id');
    }

    public function invoices()
    {
        return $this->hasMany('App\Models\Moneyin\Invoice');
    }

    public function bills()
    {
        return $this->hasMany('App\Models\MoneyOut\Invoice');
    }

    public function creditNotes()
    {
        return $this->hasMany('App\Models\Moneyin\CreditNote');
    }

}
