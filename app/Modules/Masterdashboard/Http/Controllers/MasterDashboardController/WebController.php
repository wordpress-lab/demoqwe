<?php

namespace App\Modules\Masterdashboard\Http\Controllers\MasterDashboardController;

use App\Lib\Concatenote;
use App\Models\Bank\Bank;
use App\Models\Deshboard\Reminder;
use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\MoneyOut\Bill;
use App\Models\MedicalSlip\Medicalslip;
use App\Models\Recruit\Recruitorder;
use App\Models\MedicalSlipForm\MedicalSlipForm;
use App\Models\MedicalSlipFormPax\MedicalSlipFormPax;
use App\Models\Mofa\Mofa;
use App\Models\Fitcard\Fit_Card;
use App\Models\PoliceClearance\PoliceClearance;
use App\Models\Visa\Visa;
use App\Models\Fingerprint\Fingerprint;
use App\Models\Training\Training;
use App\Models\Manpower\Manpower;
use App\Models\Completion\Completion;
use App\Models\Flightnew\Submission;
use App\Models\Flightnew\Confirmation;
use App\Models\VisaStamp\VisaStamp;
use Carbon\Carbon;
use DateTime;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;


class WebController extends Controller
{
    public function index()
    {
        $nextdatetime = Carbon::today()->addYear(2);
        $nextreminder  =  Reminder::whereBetween('reminddatetime',array(Carbon::tomorrow(),$nextdatetime))->get();
        $todayreminder  =  Reminder::whereDate('reminddatetime',date('Y-m-d'))->get();
        $today = date('Y-m-d');
        

        //dd($today);
        $total_receivale = Invoice::sum('due_amount');
        $total_invoice= Invoice::where('due_amount','!=',0)->count();
        $total_payable = Bill::sum('due_amount');
        $total_bill = Bill::where('due_amount','!=',0)->count();


        $todayincome =   DB::table('journal_entries') ->join('account', 'journal_entries.account_name_id', '=', 'account.id')->whereDate('journal_entries.assign_date',date('Y-m-d'))->where('journal_entries.debit_credit',1)->where('account.account_type_id',4)->sum('journal_entries.amount');
        $todayexpense =   DB::table('journal_entries') ->join('account', 'journal_entries.account_name_id', '=', 'account.id')->whereDate('journal_entries.assign_date',date('Y-m-d'))->where('journal_entries.debit_credit',0)->where('account.account_type_id',4)->sum('journal_entries.amount');

        $cash_in_hand =   DB::table('journal_entries') ->join('account', 'journal_entries.account_name_id', '=', 'account.id')->where('journal_entries.debit_credit',0)->where('account.account_type_id',4)->sum('journal_entries.amount');

        $total_minus =   DB::table('journal_entries') ->join('account', 'journal_entries.account_name_id', '=', 'account.id')->where('journal_entries.debit_credit',1)->where('account.account_type_id',4)->sum('journal_entries.amount');
        $cash_in_hand = $total_minus-$cash_in_hand;
        $Invoice_condition = "CURDATE() + 0 >= STR_TO_DATE(payment_date, '%d-%m-%Y')+0";
        $overdue_receivable = Invoice::whereRaw($Invoice_condition)->where('due_amount','!=',0)->get();



        $overdue_payable = Bill::where('due_date','<=',date('Y-m-d'))->where('due_amount','!=',0)->get();
        $today_stock = Stock::whereDate('created_at',date('Y-m-d'))->groupBy('item_id')->selectRaw('*, sum(total) as sum')->get();
        $today_out_stock =  InvoiceEntry::whereDate('created_at',date('Y-m-d'))->groupBy('item_id')->selectRaw('*, sum(quantity) as sum')->get();
        $total_deposit = JournalEntry::whereDate('journal_entries.assign_date',date('Y-m-d'))->join('account','journal_entries.account_name_id','=','account.id')->where('account.account_type_id',5)->where('journal_entries.debit_credit',1)->sum('journal_entries.amount');
        $total_withdraw = JournalEntry::whereDate('journal_entries.assign_date',date('Y-m-d'))->join('account','journal_entries.account_name_id','=','account.id')->where('account.account_type_id',5)->where('journal_entries.debit_credit',0)->sum('journal_entries.amount');

        $reorder = [];
        $in_stock = Stock::groupBy('item_id')->selectRaw('*, sum(total) as sum')->get();
        $out_stock =  InvoiceEntry::groupBy('item_id')->selectRaw('*, sum(quantity) as sum')->get();
        $item = Item::all();

        foreach ($item as $value){
            $new_in_stock = $in_stock->where('item_id', $value->id)->first();
            $new_out_stock = $out_stock->where('item_id', $value->id)->first();
            if(isset($new_in_stock) && isset($new_out_stock)){


                $after_minus = $new_in_stock->sum-$new_out_stock->sum;
                if($after_minus){
                    if($after_minus<=$value->reorder_point|| empty($value->reorder_point)){
                        $reorder[$value->id][] =  $after_minus;
                        $reorder[$value->id][] =  $value->item_name;
                    }
                }
            }

        }

        $customer = Recruitorder::whereDate('created_at' , $today)->count();
        $medical_slip = MedicalSlipFormPax::whereDate('created_at' , $today)->count();
        $report_fit = Medicalslip::whereDate('created_at' , $today)->where('status' , 1)->count();
        $report_unfit = Medicalslip::whereDate('created_at' , $today)->where('status' , 0)->count();
        $report_next_visit = Medicalslip::whereDate('created_at' , $today)->whereNotNull('medical_visit_date')->whereNull("status")->count();

        $mofa = Mofa::whereDate('created_at' , $today)->count();
        $fitcard = Fit_Card::whereDate('created_at' , $today)->count();
        $police_clearance = PoliceClearance::whereDate('created_at' , $today)->count();
        $visa_sum =  Visa::sum("numberofVisa");

        $visa_count = Recruitorder::count("registerSerial_id");

        $visa = $visa_sum-$visa_count;
        $stamping_send_date = VisaStamp::whereDate('created_at' , $today)->whereNotNull('send_date')->count();
        $stamping_receive_date = VisaStamp::whereDate('created_at' , $today)->whereNotNull('return_date')->count();
        $finger = Fingerprint::whereDate('created_at' , $today)->count();
        $training = Training::whereDate('created_at' , $today)->count();
        $manpower = Manpower::whereDate('created_at' , $today)->count();
        $completion = Completion::whereDate('created_at' , $today)->count();
        $submission = Submission::whereDate('created_at' , $today)->count();
        $confirmation = Confirmation::whereDate('created_at' , $today)->count();

        $iqamaApproval = Recruitorder::join('arrival_recruit','arrival_recruit.recruitorder_id','recruitingorder.id')
                                        ->leftjoin("iqamaapproval","iqamaapproval.recruitingorder_id",'recruitingorder.id')
                                        ->where(function($query){
                                            $query->whereNotNull('arrival_number');
                                            $query->where('status',1);
                                        })
                                       ->where(function($query){
                                           $query->where("iqamaapproval.apprivalstatus",0);
                                           $query->orwhere("iqamaapproval.apprivalstatus",null);
                                       })
                                        ->select('recruitingorder.*')
                                        ->get();


        $usertype = Auth::user()['type'];
        $stampingAproval = Recruitorder::join('police_clearances','recruitingorder.id','=','police_clearances.paxid')
                                          ->leftjoin('stampingapproval','recruitingorder.id','=','stampingapproval.pax_id')
                                              ->where(function($query){
                                                   $query->where('stampingapproval.status',0);
                                                   $query->Orwhere('stampingapproval.status',null);
                                               })
                                              ->where(function($query){
                                                  $query->where('recruitingorder.status',1);
                                              })
                                          ->select('recruitingorder.*')
                                          ->get();

        $flightSubmission = Recruitorder::join("submission","submission.pax_id","recruitingorder.id")
                                         ->where("submission.ticket_approval",1)
                                         ->get();
        // dd($flightSubmission);
        return view('masterdashboard::index',compact("flightSubmission",'stampingAproval','usertype',"iqamaApproval",'todayreminder','nextreminder','total_receivale','total_invoice','total_payable','total_bill','todayincome','todayexpense','cash_in_hand','total_deposit','overdue_receivable','overdue_payable','today_stock','total_withdraw','today_out_stock','reorder','medical_slip','customer','report_fit','report_unfit' ,'report_next_visit','mofa','fitcard','police_clearance','visa','stamping_send_date','stamping_receive_date','finger','training','manpower','completion','submission','confirmation'));
    }

    public function search($id)
    {
        $recruit = Recruitorder::where('paxid',$id)->first();
        return Response::json($recruit);
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
