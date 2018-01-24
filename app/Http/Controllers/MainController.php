<?php

namespace App\Http\Controllers;

use App\Models\Moneyin\CreditNotePayment;
use App\Models\Moneyin\ExcessPayment;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\OrganizationProfile\OrganizationProfile;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function index()
    {
        return redirect('dashboard');
    }

    public function test($id)
    {
        $invoice = Invoice::find($id);
        $payment_receive_entries = PaymentReceiveEntryModel::where('invoice_id', $id)->get();
        $credit_receive_entries = CreditNotePayment::where('invoice_id', $id)->get();
        $excess_receive_entries = ExcessPayment::where('invoice_id', $id)->get();
        $invoices = Invoice::all();
        $invoice_entries = InvoiceEntry::where('invoice_id', $id)->get();
        $sub_total = 0;
        $OrganizationProfile = OrganizationProfile::find(1);
        foreach ($invoice_entries as $invoice_entry)
        {
            $sub_total = $sub_total + $invoice_entry->amount;
        }

        $pdf = PDF::loadView('test',compact('invoice', 'invoice_entries', 'sub_total','invoices','payment_receive_entries','credit_receive_entries','excess_receive_entries','OrganizationProfile'));
        return $pdf->stream();



    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
