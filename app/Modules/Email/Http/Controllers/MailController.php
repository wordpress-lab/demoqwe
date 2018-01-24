<?php

namespace App\Modules\Email\Http\Controllers;

use App\Models\AccountChart\Account;
use App\Models\Email\Email;
use App\Models\Inventory\Item;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\CreditNoteEntry;
use App\Models\Moneyin\CreditNotePayment;
use App\MOdels\Moneyin\Estimate;
use App\MOdels\Moneyin\Estimate_Entry;
use App\Models\Moneyin\ExcessPayment;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Moneyin\PaymentReceives;
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\BillEntry;
use App\Models\MoneyOut\Expense;
use App\Models\MoneyOut\PaymentMade;
use App\Models\MoneyOut\PaymentMadeEntry;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Setting\SalesComission;
use App\Models\Tax;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class MailController extends Controller
{
    public function mailView($id){

        $invoice=Invoice::find($id);
        return view('email::invoice.mailView',compact('invoice'));
    }

    public function mailSend(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'email_address' => 'required',
            'subject' => 'required',
            'details' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $invoice = Invoice::find($id);
        $payment_receive_entries = PaymentReceiveEntryModel::where('invoice_id', $id)->get();
        $credit_receive_entries = CreditNotePayment::where('invoice_id', $id)->get();
        $excess_receive_entries = ExcessPayment::where('invoice_id', $id)->get();
        $invoices = Invoice::all();
        $invoice_entries = InvoiceEntry::where('invoice_id', $id)->get();
        $sub_total = 0;
        $OrganizationProfile = OrganizationProfile::first();
        foreach ($invoice_entries as $invoice_entry)
        {
            $sub_total = $sub_total + $invoice_entry->amount;
        }

        $pdf = PDF::loadView('email::invoice.pdf',compact('invoice', 'invoice_entries', 'sub_total','invoices','payment_receive_entries','credit_receive_entries','excess_receive_entries','OrganizationProfile'));
        $path=uniqid().'.pdf';
        $filename = public_path('path/'.$path);
        $pdf->save($filename);

        config(['mail.from.name' => $OrganizationProfile->display_name]);

        $email=new Email();
        $email->to=$request->email_address;
        $email->subject=$request->subject;
        $email->details=$request->details;
        $email->file=$path;
        $email->created_by=Auth::user()->id;
        $email->updated_by=Auth::user()->id;
        $email->save();

        Mail::send('email::invoice.email',array('email'=>$email,'logo'=>$OrganizationProfile),function($messeg) use ($pdf){

            $messeg->to(Input::get('email_address'))->subject(Input::get('subject'));
            $messeg->attachData($pdf->output(), "Invoice.pdf");

        });

        return redirect()->back()->with('msg','Email sent successfully.Pleas Check your Email');
    }

    public function paymentReceiveMailView($id){

        $payment=PaymentReceives::find($id);

        return view('email::paymentreceive.paymentMailView',compact('payment'));
    }

    public function paymentMailSend(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'email_address' => 'required',
            'subject' => 'required',
            'details' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }
        $paymentreceives = PaymentReceives::all();
        $paymentreceive = PaymentReceives::find($id);
        $invoice = Invoice::all();
        $OrganizationProfile = OrganizationProfile::first();

        $pdf = PDF::loadView('email::paymentreceive.pdf', compact('paymentreceives', 'invoice', 'paymentreceive', 'OrganizationProfile'));
        $path = uniqid() . '.pdf';
        $filename = public_path('path/' . $path);
        $pdf->save($filename);
        config(['mail.from.name' => $OrganizationProfile->display_name]);
        $email = new Email();
        $email->to = $request->email_address;
        $email->subject = $request->subject;
        $email->details = $request->details;
        $email->file = $path;
        $email->created_by = Auth::user()->id;
        $email->updated_by = Auth::user()->id;
        $email->save();

        Mail::send('email::paymentreceive.email', array('email' => $email,'logo'=>$OrganizationProfile), function ($messeg) use ($pdf) {

            $messeg->to(Input::get('email_address'))->subject(Input::get('subject'));

            $messeg->attachData($pdf->output(), "Payment_receive.pdf");

        });

        return redirect()->back()->with('msg', 'Email sent successfully.Pleas Check your Email');
    }

    public function creditNoteMailView($id){

        $credit=CreditNote::find($id);
        return view('email::credit_note.creditMailView',compact('credit'));
    }

  public function creditMailSend(Request $request,$id){

      $credit_note = CreditNote::find($id);
      $invoices = Invoice::all();
      $items = Item::all();
      $taxes = Tax::all();
      $credit_notes = CreditNote::with('createdBy', 'updatedBy', 'customer', 'creditNotePayments')->take(8)->get();
      $credit_note_entries = CreditNoteEntry::where('credit_note_id', $id)->get();
      $sub_total = 0;
      $OrganizationProfile = OrganizationProfile::first();
      foreach ($credit_note_entries as $credit_note_entry)
      {
          $sub_total = $sub_total + $credit_note_entry->amount;
      }

      $pdf = PDF::loadView('email::credit_note.pdf',compact('credit_note', 'invoices', 'credit_notes', 'OrganizationProfile', 'credit_note', 'sub_total','credit_note_entries'));
      $path=uniqid().'.pdf';
      $filename = public_path('path/'.$path);
      $pdf->save($filename);
      config(['mail.from.name' => $OrganizationProfile->display_name]);
      $email=new Email();
      $email->to=$request->email_address;
      $email->subject=$request->subject;
      $email->details=$request->details;
      $email->file=$path;
      $email->created_by=Auth::user()->id;
      $email->updated_by=Auth::user()->id;
      $email->save();

      Mail::send('email::credit_note.email',array('email'=>$email,'logo'=>$OrganizationProfile),function($messeg) use ($pdf){

          $messeg->to(Input::get('email_address'))->subject(Input::get('subject'));

          $messeg->attachData($pdf->output(), "Credit_note.pdf");

      });

      return redirect()->back()->with('msg','Email sent successfully.Pleas Check your Email');
  }

    public function expenceMailView($id){

        $expence=Expense::find($id);

        return view('email::expence.creditMailView',compact('expence'));
    }

    public function expenceMailSend(Request $request,$id){

        $expense = Expense::find($id);
        $expenses = Expense::all();
        $OrganizationProfile = OrganizationProfile::first();

        $pdf = PDF::loadView('email::expence.pdf',compact('OrganizationProfile','expense', 'expenses'));
        $path=uniqid().'.pdf';
        $filename = public_path('path/'.$path);
        $pdf->save($filename);
        config(['mail.from.name' => $OrganizationProfile->display_name]);
        $email=new Email();
        $email->to=$request->email_address;
        $email->subject=$request->subject;
        $email->details=$request->details;
        $email->file=$path;
        $email->created_by=Auth::user()->id;
        $email->updated_by=Auth::user()->id;
        $email->save();

        Mail::send('email::expence.email',array('email'=>$email,'logo'=>$OrganizationProfile),function($messeg) use ($pdf){

            $messeg->to(Input::get('email_address'))->subject(Input::get('subject'));
            $messeg->attachData($pdf->output(), "Expence.pdf");

        });

        return redirect()->back()->with('msg','Email sent successfully.Pleas Check your Email');
    }

    public function billMailView($id){

        $bill=Bill::find($id);
        return view('email::bill.billMailView',compact('bill'));
    }

    public function billMailSend(Request $request,$id){

        $bill = Bill::find($id);
        $bills = Bill::all();
        $bill_entries = BillEntry::where('bill_id',$id)->get();
        $payment_made_entries = PaymentMadeEntry::where('bill_id', $id)->get();
        $OrganizationProfile = OrganizationProfile::first();
        $sub_total = 0;
        foreach ($bill_entries as $bill_entry)
        {
            $sub_total = $sub_total + $bill_entry->amount;
        }

        $pdf = PDF::loadView('email::bill.pdf',compact('OrganizationProfile','bill', 'bills', 'bill_entries','sub_total', 'payment_made_entries'));
        $path=uniqid().'.pdf';
        $filename = public_path('path/'.$path);
        $pdf->save($filename);
        config(['mail.from.name' => $OrganizationProfile->display_name]);
        $email=new Email();
        $email->to=$request->email_address;
        $email->subject=$request->subject;
        $email->details=$request->details;
        $email->file=$path;
        $email->created_by=Auth::user()->id;
        $email->updated_by=Auth::user()->id;
        $email->save();

        Mail::send('email::bill.email',array('email'=>$email,'logo'=>$OrganizationProfile),function($messeg) use ($pdf){

            $messeg->to(Input::get('email_address'))->subject(Input::get('subject'));
            $messeg->attachData($pdf->output(), "Bill.pdf");

        });

        return redirect()->back()->with('msg','Email sent successfully.Pleas Check your Email');
    }

    public function paymentMadeMailView($id){

        $payment=PaymentMade::find($id);
        return view('email::paymentmade.paymentMailView',compact('payment'));
    }



    public function paymentMadeMailSend(Request $request,$id){

        $payment_made = PaymentMade::find($id);
        $payment_mades = PaymentMade::all();
        $payment_made_entries = PaymentMadeEntry::where('payment_made_id', $id)->get();
        $OrganizationProfile = OrganizationProfile::first();

        $pdf = PDF::loadView('email::paymentmade.pdf',compact('OrganizationProfile','payment_made','payment_mades','payment_made_entries'));
        $path=uniqid().'.pdf';
        $filename = public_path('path/'.$path);
        $pdf->save($filename);
        config(['mail.from.name' => $OrganizationProfile->display_name]);
        $email=new Email();
        $email->to=$request->email_address;
        $email->subject=$request->subject;
        $email->details=$request->details;
        $email->file=$path;
        $email->created_by=Auth::user()->id;
        $email->updated_by=Auth::user()->id;
        $email->save();

        Mail::send('email::paymentmade.email',array('email'=>$email,'logo'=>$OrganizationProfile),function($messeg) use ($pdf){

            $messeg->to(Input::get('email_address'))->subject(Input::get('subject'));
            $messeg->attachData($pdf->output(), "Paymentmade.pdf");

        });

        return redirect()->back()->with('msg','Email sent successfully.Pleas Check your Email');

    }

    public function commissionMailView($id){

        $commission=SalesComission::find($id);
        return view('email::commission.commissionMailView',compact('commission'));
    }

    public function commissionMailSend(Request $request,$id){

        try{
            $recent=SalesComission::orderBy("id", "desc")->take(10)->get();
            $OrganizationProfile = OrganizationProfile::first();
            $salescommission = SalesComission::find($id);
            $commision= 0;
            $account = Account::where('account_type_id',4)->get();
            $payable = Invoice::where('agents_id',$salescommission->agents_id)->where('commission_type',1)->sum('agentcommissionAmount');
            $totalpayable = Invoice::where('agents_id',$salescommission->agents_id)->where('commission_type',0)->get();
            foreach ($totalpayable as $item)
            {
                $percent = ($item->total_amount/100)*$item->agentcommissionAmount;
                $commision = $commision+$percent;
            }
            $totalpayable = $payable + $commision;
            $com_amount = SalesComission::where('agents_id',$salescommission->agents_id)->sum('amount');
            $balance = $totalpayable-$com_amount;

            $pdf = PDF::loadView('email::commission.pdf',compact('salescommission','account','totalpayable','com_amount','balance','recent','OrganizationProfile'));
            $path=uniqid().'.pdf';
            $filename = public_path('path/'.$path);
            $pdf->save($filename);
            config(['mail.from.name' => $OrganizationProfile->display_name]);
            $email=new Email();
            $email->to=$request->email_address;
            $email->subject=$request->subject;
            $email->details=$request->details;
            $email->file=$path;
            $email->created_by=Auth::user()->id;
            $email->updated_by=Auth::user()->id;
            $email->save();

            Mail::send('email::commission.email',array('email'=>$email,'logo'=>$OrganizationProfile),function($messeg) use ($pdf){

                $messeg->to(Input::get('email_address'))->subject(Input::get('subject'));

                $messeg->attachData($pdf->output(), "Commission.pdf");

            });

            return redirect()->back()->with('msg','Email sent successfully.Pleas Check your Email');

        }catch (\Illuminate\Database\QueryException $ex){
            return back()->with('alert.status', 'warning')
                ->with('alert.message', 'Sales Commission not found!');
        }
    }

    public function estimateMailView($id){

        $estimate=Estimate::find($id);
        return view('email::estimate.estimateMailView',compact('estimate'));
    }


    public function estimateMailSend(Request $request,$id){

        $OrganizationProfile = OrganizationProfile::first();
        $estimate_entry =  Estimate_Entry::where('estimate_id',$id)->get();
        $estimate =  Estimate::find($id);
        $pdf = PDF::loadView('email::estimate.pdf',compact('OrganizationProfile','estimate_entry','estimate'));
        $path=uniqid().'.pdf';
        $filename = public_path('path/'.$path);
        $pdf->save($filename);

        config(['mail.from.name' => $OrganizationProfile->display_name]);
        $email=new Email();
        $email->to=$request->email_address;
        $email->subject=$request->subject;
        $email->details=$request->details;
        $email->file=$path;
        $email->created_by=Auth::user()->id;
        $email->updated_by=Auth::user()->id;
        $email->save();

        Mail::send('email::estimate.email',array('email'=>$email,'logo'=>$OrganizationProfile),function($messeg) use ($pdf){

            $messeg->to(Input::get('email_address'))->subject(Input::get('subject'));
            $messeg->attachData($pdf->output(), "Estimate.pdf");

        });

        return redirect()->back()->with('msg','Email sent successfully.Pleas Check your Email');

    }


    public function pdf($id){

        $invoice = Invoice::find($id);
        $payment_receive_entries = PaymentReceiveEntryModel::where('invoice_id', $id)->get();
        $credit_receive_entries = CreditNotePayment::where('invoice_id', $id)->get();
        $excess_receive_entries = ExcessPayment::where('invoice_id', $id)->get();
        $invoices = Invoice::all();
        $invoice_entries = InvoiceEntry::where('invoice_id', $id)->get();
        $sub_total = 0;
        $OrganizationProfile = OrganizationProfile::first();
        foreach ($invoice_entries as $invoice_entry)
        {
            $sub_total = $sub_total + $invoice_entry->amount;
        }

        $pdf = PDF::loadView('email::invoice.pdf',compact('invoice', 'invoice_entries', 'sub_total','invoices','payment_receive_entries','credit_receive_entries','excess_receive_entries','OrganizationProfile'));
        return $pdf->stream('Invoice.pdf');


    }
}
