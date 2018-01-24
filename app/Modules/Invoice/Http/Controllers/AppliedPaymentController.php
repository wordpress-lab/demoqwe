<?php

namespace App\Modules\Invoice\Http\Controllers;

use App\Models\Moneyin\CreditNote;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Moneyin\ExcessPayment;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\Moneyin\Invoice;

class AppliedPaymentController extends Controller
{
    public function deleteCredit($id)
    {
        //return $id;
        $credit_note_payment = CreditNotePayment::find($id);

        $invoice_id = CreditNotePayment::find($id)->invoice->id;
        $amount = CreditNotePayment::find($id)->amount;
        $this->updateDueAmountInInvoiceAfterCreditNotePaymentDeleteFromInvoice($invoice_id, $amount);

        $credit_note_id = CreditNotePayment::find($id)->credit_note_id;
        $credit_note = CreditNote::find($credit_note_id);
        $credit_note->available_credit = $credit_note['available_credit'] + $amount;
        if($credit_note->update())
        {
            if($credit_note_payment->delete())
            {
                return redirect()
                    ->route('invoice_show', ['url' => $invoice_id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Credit not deleted successfully!');
            }
        }
    }


    public function updateDueAmountInInvoiceAfterCreditNotePaymentDeleteFromInvoice($invoice_id, $amount)
    {
        $invoice = Invoice::find($invoice_id);
        $invoice->due_amount = $invoice['due_amount'] + $amount;
        $invoice->update();
    }

    
    public function deleteExcess($id)
    {
        $credit_note_payment = ExcessPayment::find($id);
        $invoice_id = ExcessPayment::find($id)->invoice->id;
        if($credit_note_payment->delete())
        {
            return redirect()
                ->route('invoice_show', ['url' => $invoice_id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Credit not deleted successfully!');
        }
    }
}
