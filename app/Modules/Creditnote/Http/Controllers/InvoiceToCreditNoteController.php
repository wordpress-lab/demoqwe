<?php

namespace App\Modules\Creditnote\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use DB;

use App\Models\Contact\Contact;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\ManualJournal\JournalEntry;

use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;

class InvoiceToCreditNoteController extends Controller
{
    public function createCreditNote($id)
    {
        $customers = Contact::all();
        $credit_note = Invoice::find($id);
        $credit_note_number = 0001;
        $invoice_id = $id;
        return view('creditnote::creditnote.invoice_to_credit', compact('customers', 'credit_note_number', 'credit_note', 'invoice_id'));
    }

    public function storeCreditNote(Request $request, $invoice_id)
    {
        $data = $request->all();
        $this->createCreaditNote($data, $invoice_id);

        $credit_note_id = CreditNote::all()->last()->id;
        $invoice_amount = Invoice::find($invoice_id)->due_amount;
        if($data['total'] >= $invoice_amount)
        {
            $credit_amount = $invoice_amount;
        }
        else
        {
            $credit_amount = $data['total'];
        }

        $this->useCredit($data, $credit_amount, $invoice_id, $credit_note_id);

        return redirect()
            ->route('invoice')
            ->with('alert.status', 'success')
            ->with('alert.message', 'Credit applied successfully!');
    }

    public function createCreaditNote($data, $invoice_id)
    {
        $user_id = Auth::user()->id;

        $invoice_amount = Invoice::find($invoice_id)->due_amount;
        if($data['total'] >= $invoice_amount)
        {
            $total_credit = $data['total'] - $invoice_amount;
        }
        else
        {
            $total_credit = 0;
        }


        $credit_note_data = $data;

        $credit_note = new CreditNote;
        $credit_note->customer_id = $credit_note_data['customer_id'];
        $credit_note->credit_note_number = $credit_note_data['credit_note_number'];
        $credit_note->reference = $credit_note_data['reference'];
        $credit_note->credit_note_date = date('Y-m-d',strtotime($credit_note_data['credit_note_date']));
        $credit_note->shiping_charge = $credit_note_data['shipping_charge'];
        $credit_note->adjustment = $credit_note_data['adjustment'];
        $credit_note->total_credit_note = $data['total'];
        $credit_note->available_credit = $total_credit;
        $credit_note->customer_note = $credit_note_data['customer_note'];
        $credit_note->terms_and_condition = $credit_note_data['terms_and_condition'];
        $credit_note->created_by = $user_id;
        $credit_note->updated_by = $user_id;

        if ($credit_note->save()) {
            $credit_note_entries_array = [];

            $item_id = $credit_note_data['item_id'];
            //$description = $credit_note_data['description'];
            $account_id = $credit_note_data['account_id'];
            $quantity = $credit_note_data['quantity'];
            $rate = $credit_note_data['rate'];
            $discount = $credit_note_data['discount'];
            $tax_id = $credit_note_data['tax_id'];
            $amount = $credit_note_data['amount'];

            // return $account_id;

            $length = count($item_id);

            $credit_note_id = CreditNote::all()->last()->id;

            for ($i = 0; $i < $length; $i++) {
                $credit_note_entries_array[] = [
                    'item_id' => $item_id[$i],
                    //'description' => $description[$i],
                    'account_id' => $account_id[$i],
                    'quantity' => $quantity[$i],
                    'rate' => $rate[$i],
                    'discount' => $discount[$i],
                    'tax_id' => $tax_id[$i],
                    'amount' => $amount[$i],
                    'credit_note_id' => $credit_note_id,
                    'created_by' => $user_id,
                    'updated_by' => $user_id,
                    'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
                ];
            }

            $save = DB::table('credit_note_entries')->insert($credit_note_entries_array);

            if ($save) {
                $length = count($credit_note_data['discount']);
                $discount = $credit_note_data['discount'];
                $rate = $credit_note_data['rate'];
                $quantity = $credit_note_data['quantity'];
                $total_amount = 0;
                $total_discount = 0;

                for ($i = 0; $i < $length; $i++) {
                    $current_amount = $quantity[$i] * $rate[$i];
                    $total_amount = $total_amount + $current_amount;
                    $total_discount = $total_discount + ($discount[$i] * $rate[$i]) / 100;
                }

                $journal_entry = new JournalEntry;
                $journal_entry->amount = $credit_note_data['total'];
                $journal_entry->debit_credit = 0;
                $journal_entry->account_name_id = 5;
                $journal_entry->jurnal_type = 11;
                $journal_entry->credit_note_id = $credit_note_id;
                $journal_entry->contact_id = $credit_note_data['customer_id'];
                $journal_entry->created_by = $user_id;
                $journal_entry->updated_by = $user_id;
                $journal_entry->assign_date      = date('Y-m-d',strtotime($data['credit_note_date']));
                $journal_entry->save();

                if($credit_note_data['tax_total']>0)
                {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = $credit_note_data['tax_total'];
                    $journal_entry->debit_credit = 0;
                    $journal_entry->account_name_id = 9;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date      = date('Y-m-d',strtotime($data['credit_note_date']));
                    $journal_entry->save();
                }

                if($total_discount > 0)
                {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = $total_discount;
                    $journal_entry->debit_credit = 0;
                    $journal_entry->account_name_id = 21;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date      = date('Y-m-d',strtotime($data['credit_note_date']));
                    $journal_entry->save();
                }


                if ($credit_note_data['shipping_charge'] > 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = $credit_note_data['shipping_charge'];
                    $journal_entry->debit_credit = 1;
                    $journal_entry->account_name_id = 20;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date      = date('Y-m-d',strtotime($data['credit_note_date']));
                    $journal_entry->save();
                }

                if ($credit_note_data['adjustment'] > 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = abs($credit_note_data['adjustment']);
                    $journal_entry->debit_credit = 0;
                    $journal_entry->account_name_id = 18;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date      = date('Y-m-d',strtotime($data['credit_note_date']));
                    $journal_entry->save();
                }
                else if ($credit_note_data['adjustment'] < 0) {
                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = abs($credit_note_data['adjustment']);
                    $journal_entry->debit_credit = 1;
                    $journal_entry->account_name_id = 18;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date      = date('Y-m-d',strtotime($data['credit_note_date']));
                    $journal_entry->save();
                }

                $length = count($credit_note_data['discount']);
                $rate = $credit_note_data['rate'];
                $quantity = $credit_note_data['quantity'];
                $account_id = $credit_note_data['account_id'];
                $current_amount = 0;

                for ($i = 0; $i < $length; $i++) {
                    $current_amount = $quantity[$i] * $rate[$i];
                    $current_account_id = $account_id[$i];

                    $journal_entry = new JournalEntry;
                    $journal_entry->amount = $current_amount;
                    $journal_entry->debit_credit = 1;
                    $journal_entry->account_name_id = $current_account_id;
                    $journal_entry->jurnal_type = 11;
                    $journal_entry->credit_note_id = $credit_note_id;
                    $journal_entry->contact_id = $credit_note_data['customer_id'];
                    $journal_entry->created_by = $user_id;
                    $journal_entry->updated_by = $user_id;
                    $journal_entry->assign_date      = date('Y-m-d',strtotime($data['credit_note_date']));
                    $journal_entry->save();
                }

                $helper = new \App\Lib\Helpers;
                $helper->updateItemAfterCreatingCreditNote($credit_note_data, $credit_note_id, $user_id);

            }

        }
    }


    public function useCredit($data, $credit_amount, $invoice_id, $credit_note_id)
    {

        $invoice = Invoice::find($invoice_id);
        $invoice->due_amount = $invoice['due_amount'] - $credit_amount;
        $invoice->update();


        $user_id = Auth::user()->id;

        $credit_note_payment = new CreditNotePayment;
        $credit_note_payment->amount = $credit_amount;
        $credit_note_payment->invoice_id = $invoice_id;
        $credit_note_payment->credit_note_id = $credit_note_id;
        $credit_note_payment->created_by = $user_id;
        $credit_note_payment->updated_by = $user_id;

        $credit_note_payment->save();

    }
}
