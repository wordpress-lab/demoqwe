<?php

namespace App\Models\Pms;

use Illuminate\Database\Eloquent\Model;

class PmsReceipt extends Model
{
    protected $table = 'pms_receipts';

    public function invoiceId()
    {
    	return $this->belongsTo('App\Models\Pms\PmsInvoice','pms_invoices_id');
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
