<?php

namespace App\Modules\Customer\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\Contact\Contact;
use App\Models\Document\Category;
use App\Models\Document\Document;
use App\Models\Fingerprint\Fingerprint;
use App\Models\Flight\Flight;
use App\Models\Manpower\Manpower;
use App\Models\MedicalSlip\Medicalslip;
use App\Models\Mofa\Mofa;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Musaned\Musaned;
use App\Models\Okala\Okala;
use App\Models\Recruit\Recruitorder;
use App\Models\VisaStamp\VisaStamp;
use App\Models\Recruit\RecruiteExpensePax;
use App\Models\Setting\SalesComission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class WebController extends Controller
{

    public function index($id=null)
    {


        if (is_null($id))
        {
            if (session('branch_id')==1){
                $branch=Branch::all();
                $recruit = Recruitorder::where('status',1)->get();
                return view('customer::index',compact('id','branch','recruit'));
            }
            else {
                $branch=Branch::where('id',session('branch_id'))->get();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->where('users.branch_id',session('branch_id'))
                    ->where('status',1)
                    ->select('recruitingorder.*')
                    ->get();
                return view('customer::index',compact('id','branch','recruit'));
            }
        }
        else {

            $branch=Branch::all();
            $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                ->where('users.branch_id',$id)
                ->where('status',1)
                ->select('recruitingorder.*')
                ->get();
            return view('customer::index',compact('id','branch','recruit'));

        }
    }

     public function update($id)
    {


       $cust=Recruitorder::where('paxid',$id)->first();
       return view('customer::update',compact('cust','id'));
    }

    public function document($id)
    {

        $recruit=Recruitorder::where('paxid',$id)->first();

       // $document=Document::where('pax_id',$Rorder->id)->get();
        return view('customer::document',compact('document','id','recruit'));
    }

    public function order($id)
    {

        $order=Recruitorder::where('paxid',$id)->get();
        return view('customer::order',compact('order','id'));
    }
    public function okala($id)
    {

        $recruit=Recruitorder::where('paxid',$id)->first();
        return view('customer::okala',compact('okala','id','recruit'));
    }

    public function gamca($id)
    {

        $recruit=Recruitorder::join('medical_slip_form_pax','recruitingorder.id','=','medical_slip_form_pax.recruit_id')
            ->join('medical_slip_form','medical_slip_form_pax.medicalslip_id','=','medical_slip_form.id')
            ->select(DB::raw('recruitingorder.paxid ,medical_slip_form.dateOfApplication,medical_slip_form_pax.medicalslip_id'))
            ->where('recruitingorder.paxid',$id)->first();

        return view('customer::gamca',compact('medical','id','recruit'));
    }

    public function mofa($id)
    {

        $recruit=Recruitorder::where('paxid',$id)->first();
        return view('customer::mofa',compact('mofa','id','recruit'));
    }
    public function musaned($id)
    {

        $recruit=Recruitorder::where('paxid',$id)->first();
        return view('customer::musaned',compact('musa','id','recruit'));
    }

    public function stamping($id)
    {

        $recruit=Recruitorder::where('paxid',$id)->first();
        return view('customer::stamping',compact('stamp','id','recruit'));
    }

    public function finger($id)
    {

        $recruit=Recruitorder::where('paxid',$id)->first();
        return view('customer::finger',compact('finger','id','recruit'));
    }
    public function manpower($id){


        $recruit=Recruitorder::where('paxid',$id)->first();
        return view('customer::manpower',compact('mpower','id','recruit'));
    }

    public function report($id)
    {

        $recruit=Recruitorder::where('paxid',$id)->first();
        return view('customer::report',compact('flight','id','recruit'));
    }

    public function fitCard($id)
    {

        $recruit=Recruitorder::where('paxid',$id)->first();
        return view('customer::fitcard',compact('flight','id','recruit'));
    }
    public function training($id)
    {

        $recruit=Recruitorder::where('paxid',$id)->first();
        return view('customer::training',compact('flight','id','recruit'));
    }
    public function completion($id)
    {

        $recruit=Recruitorder::where('paxid',$id)->first();
        return view('customer::completion',compact('flight','id','recruit'));
    }
    public function submission($id)
    {

        $recruit=Recruitorder::where('paxid',$id)->first();
        return view('customer::submission',compact('flight','id','recruit'));
    }

    public function confirmation($id)
    {

        $recruit=Recruitorder::where('paxid',$id)->first();
        return view('customer::confirmation',compact('flight','id','recruit'));
    }

    public function policeClearance($id)
    {

        $recruit=Recruitorder::where('paxid',$id)->first();
        return view('customer::police_clearance',compact('flight','id','recruit'));
    }

    public function customerDeshboard($id)
    {
        $Rorder=Recruitorder::where('paxid',$id)->first();

        $expense_temp = RecruiteExpensePax::where('paxid' , $Rorder->id)
                                    ->join('recruiteexpense' , 'recruiteexpense.id' , 'recruiteexpensepax.recruitExpenseid')
                                    ->join('expense' , 'expense.id' , 'recruiteexpense.expense_id')
                                    ->sum('expense.amount');
        $sales_temp = RecruiteExpensePax::where('paxid' , $Rorder->id)
                                    ->join('recruiteexpense' , 'recruiteexpense.id' , 'recruiteexpensepax.recruitExpenseid')
                                    ->join('salescommisions' , 'salescommisions.id' , 'recruiteexpense.sales_commission_id')
                                    ->sum('salescommisions.amount');

        $expense = $expense_temp + $sales_temp;
        
        $payment_entry= PaymentReceiveEntryModel::where('invoice_id',$Rorder->invoice_id)->get();
        $totalamount = Invoice::find($Rorder->invoice_id);
        $recruit_order=Recruitorder::where('paxid',$id)->first();
        return view('customer::dashboard',compact('flight','id','recruit_order','totalamount','payment_entry','expense'));
    }
    public function customerAgent($id)
    {

        $recruit_order=Recruitorder::where('paxid',$id)->first();
        $contact=Contact::where('id',$recruit_order->customer_id)->first();
        if ($contact){

            return Redirect::route('contact_view',$contact->id);
        }else{
            return redirect()->back();
        }
    }
}
