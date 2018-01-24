<?php

namespace App\Models\ManualJournal;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
    protected $table = 'journal';

    protected $fillable = ['date', 'reference', 'note', 'branch_id'];
    
    public function journalEntries()
    {
        return $this->hasMany('App\Models\ManualJournal\JournalEntry', 'journal_id');
    }
    
    public function branch()
    {
        return $this->belongsTo('App\Models\Branch\Branch');
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
