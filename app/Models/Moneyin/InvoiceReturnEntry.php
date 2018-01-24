<?php

namespace App\Models\Moneyin;

use Illuminate\Database\Eloquent\Model;

class InvoiceReturnEntry extends Model
{
    protected $table = 'invoice_return_entries';

    protected $fillable = ['invoice_entries_id', 'returned_quantity', 'created_by', 'updated_by'];

    public function invoiceEntries()
    {
    	return $this->belongsTo('App\Models\Moneyin\InvoiceEntry','invoice_entries_id');
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
