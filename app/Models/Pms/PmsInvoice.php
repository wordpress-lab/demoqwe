<?php

namespace App\Models\Pms;

use Illuminate\Database\Eloquent\Model;

class PmsInvoice extends Model
{
    protected $table = 'pms_invoices';

    public function siteId()
    {
    	return $this->belongsTo('App\Models\Pms\Pms_Site','pms_sites_id');
    }

    public function companyId()
    {
    	return $this->belongsTo('App\Models\Pms\PmsCompany','pms_company_id');
    }

    public function createdBy()
    {
        return $this->belongsTo('App\User','created_by');
    }

    public function updatedBy()
    {
        return $this->belongsTo('App\User','created_by');
    }
}
