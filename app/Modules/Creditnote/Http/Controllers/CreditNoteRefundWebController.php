<?php

namespace App\Modules\Creditnote\Http\Controllers;

use DB;
use Auth;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

// Models...
use App\Models\Contact\Contact;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\CreditNoteEntry;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\Moneyin\CreditNoteRefund;
use App\Models\AccountChart\Account;
use App\Models\PaymentMode\PaymentMode;
use App\Models\ManualJournal\JournalEntry;


class CreditNoteRefundWebController extends Controller
{
    public function index()
    {
        //
    }

    public function create($id)
    {
        $credit_note_id = $id;
        $credit_note = CreditNote::with('creditNotePayments')->find($id);
        $accounts = Account::whereIn('account_type_id', [4,5])->get();
        $payment_modes = PaymentMode::all();

        return view('creditnote::refund.create', compact(['credit_note_id', 'credit_note', 'accounts', 'payment_modes']));
    }

    public function store(Request $request)
    {
        $credit_note_refund_data = $request->all();

        $credit_note = CreditNote::find($credit_note_refund_data['credit_note_id']);

        if($credit_note_refund_data['amount'] > $credit_note->total_credit_note)
        {
            $credit_note_amount = $credit_note->total_credit_note;
        }
        else
        {
            $credit_note_amount = $credit_note_refund_data['amount'];
        }


        $user_id = Auth::user()->id;

        $credit_note_refund = new CreditNoteRefund;
        
        $credit_note_refund->amount          = $credit_note_amount;
        $credit_note_refund->payment_mode_id = $credit_note_refund_data['payment_mode_id'];
        $credit_note_refund->date            = $credit_note_refund_data['date'];
        $credit_note_refund->reference       = $credit_note_refund_data['reference'];
        $credit_note_refund->account_id      = $credit_note_refund_data['account_id'];
        $credit_note_refund->credit_note_id  = $credit_note_refund_data['credit_note_id'];
        $credit_note_refund->created_by      = $user_id;
        $credit_note_refund->updated_by      = $user_id;

        if($credit_note_refund->save())
        {

            $credit_note_refunds_id = CreditNoteRefund::all()->last()->id;

            $journal_entry = new JournalEntry;
            $journal_entry->amount                 = $credit_note_amount;
            $journal_entry->debit_credit           = 1;
            $journal_entry->account_name_id        = 5;
            $journal_entry->jurnal_type            = 12;
            $journal_entry->credit_note_id         = $credit_note->id;
            $journal_entry->credit_note_refunds_id = $credit_note_refunds_id;
            $journal_entry->contact_id             = $credit_note->customer_id;
            $journal_entry->created_by             = $user_id;
            $journal_entry->updated_by             = $user_id;
            $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_refund_data['date']));
            $journal_entry->save();

            $journal_entry = new JournalEntry;
            $journal_entry->amount                 = $credit_note_amount;
            $journal_entry->debit_credit           = 0;
            $journal_entry->account_name_id        = $credit_note_refund_data['account_id'];
            $journal_entry->jurnal_type            = 12;
            $journal_entry->credit_note_id         = $credit_note->id;
            $journal_entry->credit_note_refunds_id = $credit_note_refunds_id;
            $journal_entry->contact_id             = $credit_note->customer_id;
            $journal_entry->created_by             = $user_id;
            $journal_entry->updated_by             = $user_id;
            $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_refund_data['date']));
            $journal_entry->save();

            $credit_note->available_credit = ($credit_note->total_credit_note - $credit_note_amount);

            $credit_note->update();

            return redirect()
                ->route('credit_note_show', ['id' => $credit_note->id])
                ->with('alert.status', 'success')
                ->with('alert.message', 'Data Saved Successfully!');
        }
        else
        {
            return redirect()
                ->route('credit_note_refund_create',['id' => $credit_note_refund_data['credit_note_id']])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Data cannot save successfully!');
        }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $refund = CreditNoteRefund::find($id);
        $accounts = Account::where('account_type_id', 4)->get();
        $payment_modes = PaymentMode::all();

        return view('creditnote::refund.edit', compact('refund', 'accounts', 'payment_modes'));
    }

    public function update(Request $request, $id)
    {
        $credit_note_refund_data = $request->all();

        $credit_note = CreditNote::find($credit_note_refund_data['credit_note_id']);

        if($credit_note_refund_data['amount'] > $credit_note->total_credit_note)
        {
            $credit_note_amount = $credit_note->total_credit_note;
        }
        else
        {
            $credit_note_amount = $credit_note_refund_data['amount'];
        }

        $user_id = Auth::user()->id;

        $credit_note_refund = CreditNoteRefund::find($id);

        $credit_note_refunds_id = $id;

        $credit_note_refund->amount          = $credit_note_amount;
        $credit_note_refund->payment_mode_id = $credit_note_refund_data['payment_mode_id'];
        $credit_note_refund->date            = $credit_note_refund_data['date'];
        $credit_note_refund->reference       = $credit_note_refund_data['reference'];
        $credit_note_refund->account_id      = $credit_note_refund_data['account_id'];
        $credit_note_refund->credit_note_id  = $credit_note_refund_data['credit_note_id'];
        $credit_note_refund->created_by      = $user_id;
        $credit_note_refund->updated_by      = $user_id;

        if($credit_note_refund->update())
        {
            //Update Time 

            $created = JournalEntry::where('bank_id',$id)->first();

            $created_by = $created->created_by;
            $created_at = $created->created_at->toDateTimeString();
            $updated_at = \Carbon\Carbon::now()->toDateTimeString();

            $journal_entries = JournalEntry::where('credit_note_refunds_id', $credit_note_refunds_id)->pluck('id')->toArray();

            if (count($journal_entries)) {
                JournalEntry::destroy($journal_entries);
            }

            $journal_entry = new JournalEntry;
            $journal_entry->amount                  = $credit_note_amount;
            $journal_entry->debit_credit            = 1;
            $journal_entry->account_name_id         = 5;
            $journal_entry->jurnal_type             = 12;
            $journal_entry->credit_note_id          = $credit_note->id;
            $journal_entry->credit_note_refunds_id  = $credit_note_refunds_id;
            $journal_entry->contact_id              = $credit_note->customer_id;
            $journal_entry->created_by              = $created_by;
            $journal_entry->updated_by              = Auth::id();
            $journal_entry->created_at              = $created_at;
            $journal_entry->updated_at              = $updated_at;
            $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_refund_data['date']));
            $journal_entry->save();

            $journal_entry = new JournalEntry;
            $journal_entry->amount                  = $credit_note_amount;
            $journal_entry->debit_credit            = 0;
            $journal_entry->account_name_id         = $credit_note_refund_data['account_id'];
            $journal_entry->jurnal_type             = 12;
            $journal_entry->credit_note_id          = $credit_note->id;
            $journal_entry->credit_note_refunds_id  = $credit_note_refunds_id;
            $journal_entry->contact_id              = $credit_note->customer_id;
            $journal_entry->created_by              = $created_by;
            $journal_entry->updated_by              = Auth::id();
            $journal_entry->created_at              = $created_at;
            $journal_entry->updated_at              = $updated_at;
            $journal_entry->assign_date = date("Y-m-d", strtotime($credit_note_refund_data['date']));
            $journal_entry->save();

            return redirect()
                ->route('credit_note_refund_edit',['id' => $id])
                ->with('alert.status', 'success')
                ->with('alert.message', 'Data Updated Successfully!');
        }
        else
        {
            return redirect()
                ->route('credit_note_refund_edit',['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Data Updated Successfully!');
        }
    }

    public function destroy($id)
    {
        $credit_note_refund = CreditNoteRefund::find($id);

        if($credit_note_refund->delete())
        {
            return redirect()
                ->route('credit_note_show',['id' => $id])
                ->with('alert.status', 'success')
                ->with('alert.message', 'Data Deleted Successfully!');
        }
        else
        {
            return redirect()
                ->route('credit_note_show',['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Data Cannot Delete Successfully!');
        }
    }
}
