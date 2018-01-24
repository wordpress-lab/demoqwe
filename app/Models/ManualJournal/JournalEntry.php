<?php

namespace App\Models\ManualJournal;

use Illuminate\Database\Eloquent\Model;

class JournalEntry extends Model
{
    protected $table = 'journal_entries';

    protected $fillable = ['note', 'debit_credit', 'amount', 'journal_id', 'account_name_id', 'contact_id','tax_id','payment_receives_id','invoice_id','credit_note_id','payment_made_id','expense_id'];

    public function journal()
    {
        return $this->belongsTo('App\Models\ManualJournal\Journal', 'journal_id');
    }

    public function paymentReceive()
    {
        return $this->belongsTo('App\Models\Moneyin\PaymentReceives', 'payment_receives_id');
    }



    public function paymentMade()
    {
        return $this->belongsTo('App\Models\MoneyOut\PaymentMade', 'payment_made_id');
    }

    public function expense()
    {
        return $this->belongsTo('App\Models\MoneyOut\Expense', 'expense_id');
    }

    public function income()
    {
        return $this->belongsTo('App\Models\Moneyin\Income', 'income_id');
    }

    public function invoice()
    {
        return $this->belongsTo('App\Models\Moneyin\Invoice', 'invoice_id');
    }

    public function bill()
    {
        return $this->belongsTo('App\Models\MoneyOut\Bill', 'bill_id');
    }

     public function bank()
    {
        return $this->belongsTo('App\Models\Bank\Bank', 'bank_id');
    }

    public function creditNote()
    {
        return $this->belongsTo('App\Models\Moneyin\CreditNote', 'credit_note_id');
    }
    public function creditNoteRefund()
    {
        return $this->belongsTo('App\Models\Moneyin\CreditNoteRefund', 'credit_note_refunds_id');
    }

    public function account()
    {
        return $this->belongsTo('App\Models\AccountChart\Account', 'account_name_id');
    }

    public function AccountType()
    {
        return $this->belongsTo('App\Models\AccountChart\AccountType','account_name_id','id','account_type_id');
        
    }

    public function contact()
    {
        return $this->belongsTo('App\Models\Contact\Contact','contact_id');
    }

    public function Agent()
    {
        return $this->belongsTo('App\Models\Contact\Contact','agent_id');
    }

    public function SalesCommission()
    {
        return $this->belongsTo('App\Models\Setting\SalesComission','salesComission_id');
    }


}
