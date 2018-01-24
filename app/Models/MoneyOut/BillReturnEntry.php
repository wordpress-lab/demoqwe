<?php

namespace App\Models\MoneyOut;

use Illuminate\Database\Eloquent\Model;

class BillReturnEntry extends Model
{
    protected $table = 'bill_return_entries';

    protected $fillable = ['bill_entries_id', 'returned_quantity', 'created_by', 'updated_by'];

    public function billEntries()
    {
    	return $this->belongsTo('App\Models\MoneyOut\BillEntry','invoice_entries_id');
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
