<?php

namespace App\Modules\Report\Http\Controllers;

use App\Lib\BalanceSheet;
use App\Lib\CustomerDetailsReport;
use App\Lib\Report;
use App\Lib\sortBydate;
use App\Models\Moneyin\CreditNote;
use App\Models\Moneyin\CreditNotePayment;
use App\Models\Moneyin\CreditNoteRefund;
use App\Modules\Report\Http\Response\GeneralLedgerResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManualJournalRequest;

use App\Models\ManualJournal\Journal;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Contact\Contact;
use App\Models\Contact\ContactCategory;
use App\Models\AccountChart\Account;
use App\Models\AccountChart\AccountType;
use App\Models\AccountChart\ParentAccountType;
use App\Models\Tax;
use Carbon\Carbon;
use DateTime;
use DatePeriod;
use DateInterval;
use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Moneyin\PaymentReceives;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\Branch\Branch;
use App\Models\Inventory\Product;
use App\Models\Inventory\ProductPhase;
use App\Models\Inventory\Item;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ProductPhaseItem;
use App\Models\Inventory\ProductPhaseItemAdd;
use App\Models\Inventory\Stock;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\PaymentMode\PaymentMode;
use Auth;
use DB;
class ReportWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $branch_id=0;
    
    public function index()
    {


     return view('report::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function accountTransactions()
    {
        $accounts = Account::all();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        $begin_time = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
        
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');
        $JournalEntry=$this->checkBranch($JournalEntry);
        $opening_debit =  JournalEntry::select(DB::raw('SUM(amount) as amount'))->whereBetween('assign_date',[$begin_time,$start])->where('debit_credit',1)->get()->sortBy('assign_date');
        $opening_debit=$this->checkBranch($opening_debit);
        $opening_credit =  JournalEntry::select(DB::raw('SUM(amount) as amount'))->whereBetween('assign_date',[$begin_time,$start])->where('debit_credit',0)->get()->sortBy('assign_date');
        $opening_credit=$this->checkBranch($opening_credit);
        $opening_balance = $opening_debit[0]['amount'] - $opening_credit[0]['amount'];


        $OrganizationProfile = OrganizationProfile::find(1);
        $branch=Branch::all();
        return view('report::account_transactions',compact('JournalEntry','start','end','accounts','OrganizationProfile','opening_balance','branch','branch_id'))->with('branch_id',$this->branch_id);
    }


    public function accountTransactionsSearch(Request $request)
    {

        $accounts = Account::all();

        $start = date("Y-m-d",strtotime($request->input('from_date'))).' '.'00:00:00';

        $end = date("Y-m-d",strtotime($request->input('to_date'))).' '.'23:59:59';
        $data = $request->all();


        $OrganizationProfile = OrganizationProfile::find(1);
        
        
        if($request->branch_id ){
            $this->branch_id =  $request->branch_id;
        }
        

        if($data['report_account_id']>0)
        {

            $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->where('account_name_id',$request->report_account_id)->get()->sortBy('assign_date');
            $opening_debit =  JournalEntry::select(DB::raw('SUM(amount) as amount'))->whereBetween('assign_date',[$start,$end])->where('debit_credit',1)->where('account_name_id',$request->report_account_id)->get()->sortBy('assign_date');
            $opening_credit =  JournalEntry::select(DB::raw('SUM(amount) as amount'))->whereBetween('assign_date',[$start,$end])->where('debit_credit',0)->where('account_name_id',$request->report_account_id)->get()->sortBy('assign_date');

            $opening_balance = $opening_debit[0]['amount'] - $opening_credit[0]['amount'];
        }else
        {
            $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');
            $opening_debit =  JournalEntry::select(DB::raw('SUM(amount) as amount'))->whereBetween('assign_date',[$start,$end])->where('debit_credit',1)->get()->sortBy('assign_date');
            $opening_credit =  JournalEntry::select(DB::raw('SUM(amount) as amount'))->whereBetween('assign_date',[$start,$end])->where('debit_credit',0)->get()->sortBy('assign_date');
            $opening_balance = $opening_debit[0]['amount'] - $opening_credit[0]['amount'];
        }
        $JournalEntry=$this->checkBranch($JournalEntry);
        $opening_debit=$this->checkBranch($opening_debit);
        $opening_credit=$this->checkBranch($opening_credit);
        $branch=Branch::all();
        return view('report::account_transactions',compact('JournalEntry','start','end','accounts','OrganizationProfile','opening_balance','branch'))->with('branch_id',$this->branch_id);
    }

    public function accountTransactionsAccountSearch($id)
    {
         $accounts = Account::all();
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        $begin_time = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');

        
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->where('account_name_id',$id)->get()->sortBy('assign_date');
        $JournalEntry=$this->checkBranch($JournalEntry);
        $opening_debit =  JournalEntry::select(DB::raw('SUM(amount) as amount'))->whereBetween('assign_date',[$begin_time,$start])->where('debit_credit',1)->where('account_name_id',$id)->get()->sortBy('assign_date');
        $opening_debit=$this->checkBranch($opening_debit);
        $opening_credit =  JournalEntry::select(DB::raw('SUM(amount) as amount'))->whereBetween('assign_date',[$begin_time,$start])->where('debit_credit',0)->where('account_name_id',$id)->get()->sortBy('assign_date');
        
        $opening_credit=$this->checkBranch($opening_credit);
        $opening_balance = $opening_debit[0]['amount'] - $opening_credit[0]['amount'];

        $OrganizationProfile = OrganizationProfile::find(1);
        $branch=Branch::all();

        return view('report::account_transactions',compact('JournalEntry','start','end','accounts','OrganizationProfile','opening_balance','branch'))->with('branch_id',$this->branch_id);

    }



    public function accountGeneralLedger()
    {

        $accounts = Account::orderby('account_name', 'ASC')->get();
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        $begin_time = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');

        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get();
        $JournalEntry=$this->checkBranch($JournalEntry);
        $OpeningJournalEntry =  JournalEntry::whereDate('assign_date',"<",$start)->get();
        $OpeningJournalEntry=$this->checkBranch($OpeningJournalEntry);
        $branch=Branch::all();


        return view('report::Ajax.account_general_ledger',compact('JournalEntry','start','end','accounts','OrganizationProfile','OpeningJournalEntry','branch'))->with('branch_id',$this->branch_id);

    }


    public function accountGeneralLedgerSearch(Request $request)
    {
        if($request->branch_id ){
            $this->branch_id =  $request->branch_id;
        }
        $OrganizationProfile = OrganizationProfile::find(1);
        $accounts = Account::orderby('account_name', 'ASC')->get();
        $start = date("Y-m-d",strtotime($request->input('from_date')));
        $end = date("Y-m-d",strtotime($request->input('to_date')."+1 day"));
        $current_time = Carbon::now()->toDayDateTimeString();

        $begin_time = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');

        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get();
        $JournalEntry=$this->checkBranch($JournalEntry);
        $OpeningJournalEntry =  JournalEntry::whereBetween('assign_date',[$begin_time,$start])->get();

        $OpeningJournalEntry=$this->checkBranch($OpeningJournalEntry);
        $branch=Branch::all();
        return view('report::Ajax.account_general_ledger',compact('JournalEntry','start','end','accounts','OrganizationProfile','OpeningJournalEntry','branch'))->with('branch_id',$this->branch_id);
    }




    public function accountJournal()
    {
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');
        $JournalEntry=$this->checkBranch($JournalEntry);
        $journal = [];
        $k = 0;
        foreach ($JournalEntry  as $JournalEntryData)
        {

                if($JournalEntryData->jurnal_type == 'invoice') {

                    $i = 0;
                    foreach ($journal as $journalData) {
                        if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->invoice_id) {
                            $i = 1;
                        }else{
                            $i = 2;
                        }
                    }
                    if($i == 0 || $i == 2)
                    {
                        $journal[$k++] = [

                            'journal_type' => $JournalEntryData->jurnal_type,
                            'journal_id' => $JournalEntryData->invoice_id,
                        ];
                    }


                }elseif($JournalEntryData->jurnal_type == "paymentreceive2" || $JournalEntryData->jurnal_type == "paymentreceive1")
                {

                    $i = 0;
                    foreach ($journal as $journalData) {

                        if ($journalData['journal_id'] == $JournalEntryData->payment_receives_id) {
                          $i = 1;
                        }else{
                            $i = 2;
                        }
                    }
                    if($i == 0 || $i == 2)
                    {
                        $journal[$k++] = [

                            'journal_type' => $JournalEntryData->jurnal_type,
                            'journal_id' => $JournalEntryData->payment_receives_id,
                        ];
                    }
                }elseif($JournalEntryData->jurnal_type == "bill")
                {
                    $i = 0;
                    foreach ($journal as $journalData) {
                        if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->bill_id) {
                            $i = 1;
                        }else{
                            $i = 2;
                        }
                    }
                    if($i == 0 || $i == 2)
                    {
                        $journal[$k++] = [

                            'journal_type' => $JournalEntryData->jurnal_type,
                            'journal_id' => $JournalEntryData->bill_id,
                        ];
                    }
                }elseif($JournalEntryData->jurnal_type == "11" || $JournalEntryData->jurnal_type == "12")
                {
                    $i = 0;
                    foreach ($journal as $journalData) {
                        if ($journalData['journal_id'] == $JournalEntryData->credit_note_id) {
                            $i = 1;
                        }else{
                            $i = 2;
                        }
                    }
                    if($i == 0 || $i == 2)
                    {
                        $journal[$k++] = [

                            'journal_type' => $JournalEntryData->jurnal_type,
                            'journal_id' => $JournalEntryData->credit_note_id,
                        ];
                    }
                }elseif($JournalEntryData->jurnal_type == "journal")
                {

                    $i = 0;
                    foreach ($journal as $journalData) {

                        if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->journal_id) {
                            $i = 1;
                        }else{
                            $i = 2;
                        }
                    }
                    if($i == 0 || $i == 2)
                    {
                        $journal[$k++] = [

                            'journal_type' => $JournalEntryData->jurnal_type,
                            'journal_id' => $JournalEntryData->journal_id,
                        ];
                    }

                }elseif($JournalEntryData->jurnal_type == "bank")
                {

                    $i = 0;
                    foreach ($journal as $journalData) {

                        if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->bank_id) {
                            $i = 1;
                        }else{
                            $i = 2;
                        }
                    }
                    if($i == 0 || $i == 2)
                    {
                        $journal[$k++] = [

                            'journal_type' => $JournalEntryData->jurnal_type,
                            'journal_id' => $JournalEntryData->bank_id,
                        ];
                    }

                }

        }
        $branch=Branch::all();
        return view('report::account_journal',compact('JournalEntry','start','end','OrganizationProfile','journal','branch'))->with('branch_id',$this->branch_id);
    }


    public function accountJournalSearch(Request $request)
    {
        if($request->branch_id ){
            $this->branch_id =  $request->branch_id;
        }
        $OrganizationProfile = OrganizationProfile::find(1);
        $start = date("Y-m-d",strtotime($request->input('from_date')));
        $end = date("Y-m-d",strtotime($request->input('to_date')."+1 day"));
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');
        $JournalEntry=$this->checkBranch($JournalEntry);
        $journal = [];
        $k = 0;
        foreach ($JournalEntry  as $JournalEntryData)
        {

            if($JournalEntryData->jurnal_type == 'invoice') {

                $i = 0;
                foreach ($journal as $journalData) {
                    if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->invoice_id) {
                        $i = 1;
                    }else{
                        $i = 2;
                    }
                }
                if($i == 0 || $i == 2)
                {
                    $journal[$k++] = [

                        'journal_type' => $JournalEntryData->jurnal_type,
                        'journal_id' => $JournalEntryData->invoice_id,
                    ];
                }


            }elseif($JournalEntryData->jurnal_type == "paymentreceive2" || $JournalEntryData->jurnal_type == "paymentreceive1")
            {

                $i = 0;
                foreach ($journal as $journalData) {

                    if ($journalData['journal_id'] == $JournalEntryData->	payment_receives_id) {
                        $i = 1;
                    }else{
                        $i = 2;
                    }
                }
                if($i == 0 || $i == 2)
                {
                    $journal[$k++] = [

                        'journal_type' => $JournalEntryData->jurnal_type,
                        'journal_id' => $JournalEntryData->	payment_receives_id,
                    ];
                }
            }
            elseif($JournalEntryData->jurnal_type == "bill")
            {
                $i = 0;
                foreach ($journal as $journalData) {
                    if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->bill_id) {
                        $i = 1;
                    }else{
                        $i = 2;
                    }
                }
                if($i == 0 || $i == 2)
                {
                    $journal[$k++] = [

                        'journal_type' => $JournalEntryData->jurnal_type,
                        'journal_id' => $JournalEntryData->bill_id,
                    ];
                }
            }
            elseif($JournalEntryData->jurnal_type == "11" || $JournalEntryData->jurnal_type == "12")
            {
                $i = 0;
                foreach ($journal as $journalData) {
                    if ($journalData['journal_id'] == $JournalEntryData->credit_note_id) {
                        $i = 1;
                    }else{
                        $i = 2;
                    }
                }
                if($i == 0 || $i == 2)
                {
                    $journal[$k++] = [

                        'journal_type' => $JournalEntryData->jurnal_type,
                        'journal_id' => $JournalEntryData->credit_note_id,
                    ];
                }
            }
            elseif($JournalEntryData->jurnal_type == "journal")
            {

                $i = 0;
                foreach ($journal as $journalData) {

                    if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->journal_id) {
                        $i = 1;
                    }else{
                        $i = 2;
                    }
                }
                if($i == 0 || $i == 2)
                {
                    $journal[$k++] = [

                        'journal_type' => $JournalEntryData->jurnal_type,
                        'journal_id' => $JournalEntryData->journal_id,
                    ];
                }

            }
            elseif($JournalEntryData->jurnal_type == "payment_made")
            {

                $i = 0;
                foreach ($journal as $journalData) {

                    if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->payment_made_id) {
                        $i = 1;
                    }else{
                        $i = 2;
                    }
                }
                if($i == 0 || $i == 2)
                {
                    $journal[$k++] = [

                        'journal_type' => $JournalEntryData->jurnal_type,
                        'journal_id' => $JournalEntryData->payment_made_id,
                    ];
                }

            }
            elseif($JournalEntryData->jurnal_type == "expense")
            {

                $i = 0;
                foreach ($journal as $journalData) {

                    if ($journalData['journal_type'] == $JournalEntryData->jurnal_type && $journalData['journal_id'] == $JournalEntryData->expense_id) {
                        $i = 1;
                    }else{
                        $i = 2;
                    }
                }
                if($i == 0 || $i == 2)
                {
                    $journal[$k++] = [

                        'journal_type' => $JournalEntryData->jurnal_type,
                        'journal_id' => $JournalEntryData->expense_id,
                    ];
                }

            }

        }
        $branch=Branch::all();
        return view('report::account_journal',compact('JournalEntry','start','end','Journal','OrganizationProfile','journal','branch'))->with('branch_id',$this->branch_id);
    }



    public function accountTrialBalance()
    {

        $account = Account::all();
        $accountType = AccountType::all();
        $parentAccountType = ParentAccountType::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');
        $branch=Branch::all();
        $JournalEntry=$this->checkBranch($JournalEntry);
        return view('report::account_trial_balance',compact('JournalEntry','start','end','OrganizationProfile','account','accountType','parentAccountType','branch'))->with('branch_id',$this->branch_id);
    }


    public function accountTrialBalanceSearch(Request $request)
    {
        if($request->branch_id ){
            $this->branch_id =  $request->branch_id;
        }
        $OrganizationProfile = OrganizationProfile::find(1);
        $account = Account::all();
        $accountType = AccountType::all();
        $parentAccountType = ParentAccountType::all();
        $start = date("Y-m-d",strtotime($request->input('from_date')));
        $end = date("Y-m-d",strtotime($request->input('to_date')."+1 day"));
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');
        $JournalEntry=$this->checkBranch($JournalEntry);
        $branch=Branch::all();
        return view('report::account_trial_balance',compact('JournalEntry','start','end','OrganizationProfile','account','accountType','parentAccountType','branch'))->with('branch_id',$this->branch_id);
    }


    public function ProfitLoss()
    {
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-14 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');

        $JournalEntry=$this->checkBranch($JournalEntry);
        $branch=Branch::all();
        return view('report::profit_loss',compact('JournalEntry','start','end','accounts','OrganizationProfile','branch'))->with('branch_id',$this->branch_id);
    }
    public function ProfitAndLoss()
    { 
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = date('d-M-Y',strtotime(date('Y-01-01')));
        $end = date('d-M-Y',strtotime(date('Y-12-31')));

       $operatingincome = Account::where('account_type_id',15)->get();
       $costofgoods = Account::where('account_type_id',18)->get();
       $operatingExpense = Account::where('account_type_id',17)->get();
       $nonoperatingix = Account::whereIn('account_type_id',array(16,19))->get();



        //  dd($JournalEntry);
        return view('report::profitloss.profit_loss',compact('start','end','accounts','OrganizationProfile','operatingincome','costofgoods','operatingExpense','nonoperatingix'))->with('branch_id',$this->branch_id);
    }

    public function BalanceAndSheet()
    {
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
        $end = date('Y-m-d');

        $BalanceSheet=new BalanceSheet();
        $BalanceSheet->setDate($start,$end);

        //retained earnings calculation
        $end = date('Y-m-d',strtotime(date("Y-12-31") . '-1 year')); //modified at 22 january 2018
        $retainedEarnings =  new Report();
        $retainedEarnings->definedate($start,$end);
        $TotalretainedEarnings= $retainedEarnings->netprofit();
        
        //current year net profit calculation
        $start = date('Y-m-d',strtotime(date('Y-01-01')));
        $end = date('Y-m-d');
        $netprofit =  new Report();
        $netprofit->definedate($start,$end);
        $Totalnetprofit= $netprofit->netprofit();

        //assets calculation
        $current_asset=$BalanceSheet->current_asset();
        $cash=$BalanceSheet->cash();
        $others_asset=$BalanceSheet->others_asset();
        $others_current_asset=$BalanceSheet->others_current_asset();
        $bank=$BalanceSheet->bank();
        $stock=$BalanceSheet->stock();
        $FixedAsset=$BalanceSheet->FixedAsset();

        //liability calculation
        $currentLibilities=$BalanceSheet->currentLibilities();
        $longTermLibilities=$BalanceSheet->longTermLibilities();
        
        //equity calculation; let not the function name fool you
        $currentYearEarning=$BalanceSheet->currentYearEarning();
        
        $start = date('d-M-Y',strtotime(date('Y-01-01')));
        $end = date('d-M-Y');
      return view('report::BalanceSheet.index',compact('currentYearEarning','longTermLibilities','currentLibilities','FixedAsset','stock','bank','others_current_asset' ,'others_asset','cash','current_asset','start','end','accounts','OrganizationProfile','Totalnetprofit','TotalretainedEarnings'))->with('branch_id',$this->branch_id);
    }
    public function BalanceAndSheetbyfilter(Request $request)
    {
        $end = $request->to_date;
        $year = date('Y',strtotime($end));
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');

        $BalanceSheet=new BalanceSheet();
        $BalanceSheet->setDate($start,$end);

        //retained earnings calculation
        $end = date('Y-12-31',strtotime($end));
        $end = date("Y-m-d",strtotime($end.'- 1 year'));

        $retainedEarnings =  new Report();
        $retainedEarnings->definedate($start,$end);
        $TotalretainedEarnings= $retainedEarnings->netprofit();
        
        //current year net profit calculation
        $start = date('Y-m-d', strtotime("first day of january " . date($year)));
        $end = $request->to_date;
        $netprofit =  new Report();
        $netprofit->definedate($start,$end);
        $Totalnetprofit= $netprofit->netprofit();

        //assets calculation
        $current_asset=$BalanceSheet->current_asset();
        $cash=$BalanceSheet->cash();
        $others_asset=$BalanceSheet->others_asset();
        $others_current_asset=$BalanceSheet->others_current_asset();
        $bank=$BalanceSheet->bank();
        $stock=$BalanceSheet->stock();
        $FixedAsset=$BalanceSheet->FixedAsset();

        //liability calculation
        $currentLibilities=$BalanceSheet->currentLibilities();
        $longTermLibilities=$BalanceSheet->longTermLibilities();
        
        //equity calculation; let not the function name fool you
        $currentYearEarning=$BalanceSheet->currentYearEarning();
        
        $start = date('d-M-Y',strtotime($start));
        $end =  date('d-M-Y',strtotime($end));
        return view('report::BalanceSheet.index',compact('currentYearEarning','longTermLibilities','currentLibilities','FixedAsset','stock','bank','others_current_asset' ,'others_asset','cash','current_asset','start','end','accounts','OrganizationProfile','Totalnetprofit','TotalretainedEarnings'))->with('branch_id',$this->branch_id);
    }

    public function ProfitAndLossbyfilter(Request $request)
    {
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = $request->from_date?$request->from_date:date('d-M-Y',strtotime(date('Y-01-01')));;
        $end = $request->to_date?$request->to_date:$start;

        $start = date('d-M-Y',strtotime($start));
        $end = date('d-M-Y',strtotime($end));
       $operatingincome = Account::where('account_type_id',15)->get();
       $costofgoods = Account::where('account_type_id',18)->get();
       $operatingExpense = Account::where('account_type_id',17)->get();
       $nonoperatingix = Account::whereIn('account_type_id',array(16,19))->get();



         // dd($request->all());
        return view('report::profitloss.profit_lossbyfilter',compact('start','end','accounts','OrganizationProfile','operatingincome','costofgoods','operatingExpense','nonoperatingix'))->with('branch_id',$this->branch_id);
    }



    public function CashFlowStatement()
    {
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-14 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');
        return view('report::cash_flow_statement',compact('JournalEntry','start','end','accounts','OrganizationProfile'))->with('branch_id',$this->branch_id);
    }



    public function BalanceSheet()
    {
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-14 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        $JournalEntry =  JournalEntry::whereBetween('assign_date',[$start,$end])->get()->sortBy('assign_date');
        // foreach ($JournalEntry as $key ) {

        //     return $JournalEntry->AccountType->id;

        // }
        return view('report::balance_sheet',compact('JournalEntry','start','end','accounts','OrganizationProfile'))->with('branch_id',$this->branch_id);
    }



    public function customer()
    {
        $customerReport = [];
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-14 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->format('Y-m-d');
        $refund_start = (new DateTime($current_time))->modify('-14 day')->format('d-m-Y');
        $refund_end = (new DateTime($current_time))->modify('+1 day')->format('d-m-Y');
        $invoice_start = (new DateTime($current_time))->modify('-14 day')->format('d-m-Y');
        $invoice_end = (new DateTime($current_time))->modify('+1 day')->format('d-m-Y');
        $contacts = Contact::all();
        $condition = "str_to_date(invoice_date, '%d-%m-%Y') between '$start' and '$end'";
        $condition_refund = "str_to_date(credit_note_refunds.date, '%d-%m-%Y') between '$start' and '$end'";
        $condition_payment = "str_to_date(payment_date, '%Y-%m-%d') between '$start' and '$end'";

         foreach ($contacts as $contact)
         {

               $invoice =  Invoice::select('customer_id',DB::raw('SUM(due_amount) as due_amount'),DB::raw('count(*) as total'),DB::raw('SUM(total_amount) as total_sales'))->whereRaw($condition)->where('customer_id',$contact->id)->first();
               $credit_note_amount = CreditNote::where('credit_note_date',">=",$start)->where('credit_note_date',"<=",$end)->where('customer_id',$contact->id)->sum('total_credit_note');
               $credit_refund= CreditNote::join('credit_note_refunds','credit_note_refunds.credit_note_id','=','credit_notes.id')->whereRaw($condition_refund)->where('credit_notes.customer_id',$contact->id)->select('credit_note_refunds.*')->sum('amount');
               $credit_note_payment= CreditNote::join('credit_note_payments','credit_note_payments.credit_note_id','=','credit_notes.id')->where('credit_notes.customer_id',$contact->id)->whereBetween('credit_note_payments.created_at',[$start,$end])->select('credit_note_payments.*')->sum('amount');
               $paymentreceives =  PaymentReceives::select('customer_id', DB::raw('count(*) as total'),DB::raw('SUM(amount) as total_receives'),DB::raw('SUM(excess_payment) as total_excess_payment'))->whereRaw($condition_payment)->where('customer_id',$contact->id)->first();
               if(!empty($paymentreceives->total_excess_payment)||!empty($paymentreceives->total_receives)||!empty($paymentreceives->total)||!empty($invoice->due_amount)||!empty($invoice->total)|| !empty($credit_note_amount)||!empty($credit_refund)||!empty($credit_note_payment))
               {
                   $customerReport[] =[
                       'customer_id'          => $contact->id,
                       'display_name'         => $contact->display_name,
                       'invoices'             => $invoice->total,
                       'total_sales'          => $invoice->total_sales,
                       'total_cr_amount'      => $credit_note_amount,
                       'total_refund'      =>    $credit_refund,
                       'paymentreceives'      => $paymentreceives->total_receives,
                       'total_receives'       => ($paymentreceives->total_receives-$paymentreceives->total_excess_payment)+$credit_note_payment,
                       'total_excess_payment' => $paymentreceives->total_excess_payment,
                       'due'                  => $invoice->due_amount,
                   ];
               }
           }
           $ContactCategory=ContactCategory::all();
          return view('report::customer',compact('customerReport','start','end','accounts','OrganizationProfile','ContactCategory'));
    }

    public function customerCategory($id)
    {
        $customerReport = [];
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-14 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        $refund_start = (new DateTime($current_time))->modify('-14 day')->format('d-m-Y');
        $refund_end = (new DateTime($current_time))->modify('+1 day')->format('d-m-Y');
        $invoice_start = (new DateTime($current_time))->modify('-14 day')->format('d.m.Y');
        $invoice_end = (new DateTime($current_time))->modify('+1 day')->format('d.m.Y');
        $contacts = Contact::where('contact_category_id',$id)->get();


         foreach ($contacts as $contact)
         {

               $invoice =  Invoice::select('customer_id',DB::raw('SUM(due_amount) as due_amount'),DB::raw('count(*) as total'),DB::raw('SUM(total_amount) as total_sales'))->where('invoice_date',">=",$invoice_start)->where('invoice_date',"<=",$invoice_end)->where('customer_id',$contact->id)->first();
               $credit_note_amount = CreditNote::where('credit_note_date',">=",$start)->where('credit_note_date',"<=",$end)->where('customer_id',$contact->id)->sum('total_credit_note');
               $credit_refund= CreditNote::join('credit_note_refunds','credit_note_refunds.credit_note_id','=','credit_notes.id')->where('credit_note_refunds.date',">=",$refund_start)->where('credit_note_refunds.date',"<=",$refund_end)->where('credit_notes.customer_id',$contact->id)->select('credit_note_refunds.*')->sum('amount');
               $credit_note_payment= CreditNote::join('credit_note_payments','credit_note_payments.credit_note_id','=','credit_notes.id')->where('credit_notes.customer_id',$contact->id)->whereBetween('credit_note_payments.created_at',[$start,$end])->select('credit_note_payments.*')->sum('amount');
               $paymentreceives =  PaymentReceives::select('customer_id', DB::raw('count(*) as total'),DB::raw('SUM(amount) as total_receives'),DB::raw('SUM(excess_payment) as total_excess_payment'))->where('payment_date',">=",$start)->where('payment_date',"<=",$end)->where('customer_id',$contact->id)->first();
               if(!empty($paymentreceives->total_excess_payment)||!empty($paymentreceives->total_receives)||!empty($paymentreceives->total)||!empty($invoice->due_amount)||!empty($invoice->total)|| !empty($credit_note_amount)||!empty($credit_refund)||!empty($credit_note_payment))
               {
                   $customerReport[] =[
                       'customer_id'          => $contact->id,
                       'display_name'         => $contact->display_name,
                       'invoices'             => $invoice->total,
                       'total_sales'          => $invoice->total_sales,
                       'total_cr_amount'      => $credit_note_amount,
                       'total_refund'      =>    $credit_refund,
                       'paymentreceives'      => $paymentreceives->total_receives,
                       'total_receives'       => ($paymentreceives->total_receives-$paymentreceives->total_excess_payment)+$credit_note_payment,
                       'total_excess_payment' => $paymentreceives->total_excess_payment,
                       'due'                  => $invoice->due_amount,
                   ];
               }
           }
           $ContactCategory=ContactCategory::all();
          return view('report::customer',compact('customerReport','start','end','accounts','OrganizationProfile','ContactCategory','id'));
    }

    public function customerSearch(Request $request)
    {
        $customerReport = [];
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $start = date("Y-m-d",strtotime($request->input('from_date'))).' '.'00:00:00';
        $end = date("Y-m-d",strtotime($request->input('to_date'))).' '.'23:00:00';
        $refund_start = date("d-m-Y",strtotime($request->input('from_date')));
        $refund_end = date("d-m-Y",strtotime($request->input('from_date')));
        $invoice_start = date("d.m-Y",strtotime($request->input('from_date')));
        $invoice_end = date("d-m-Y",strtotime($request->input('to_date')."+1 day"));
        $condition = "str_to_date(invoice_date, '%d-%m-%Y') between '$start' and '$end'";
        $condition_refund = "str_to_date(credit_note_refunds.date, '%d-%m-%Y') between '$start' and '$end'";
        $condition_payment = "str_to_date(payment_date, '%Y-%m-%d') between '$start' and '$end'";
        if ($request->input('id')) {
            $contacts = Contact::where('contact_category_id',$request->input('id'))->get();
            $id=$request->input('id');
        }
        else{

            $contacts = Contact::all();
            $id='';
        }
        foreach ($contacts as $contact)
        {
            $invoice =  Invoice::select('customer_id',DB::raw('SUM(due_amount) as due_amount'),DB::raw('count(*) as total'),DB::raw('SUM(total_amount) as total_sales'))->whereRaw($condition)->where('customer_id',$contact->id)->first();
            $credit_note_amount = CreditNote::orderBy('id','asc')->where('credit_note_date',">=",$start)->where('credit_note_date',"<=",$end)->where('customer_id',$contact->id)->sum('total_credit_note');
            $credit_refund= CreditNote::join('credit_note_refunds','credit_note_refunds.credit_note_id','=','credit_notes.id')->whereRaw($condition_refund)->where('credit_notes.customer_id',$contact->id)->select('credit_note_refunds.*')->sum('amount');
            $credit_note_payment= CreditNote::join('credit_note_payments','credit_note_payments.credit_note_id','=','credit_notes.id')->where('credit_notes.customer_id',$contact->id)->whereBetween('credit_note_payments.created_at',[$start,$end])->select('credit_note_payments.*')->sum('amount');

            $paymentreceives =  PaymentReceives::select('customer_id', DB::raw('count(*) as total'),DB::raw('SUM(amount) as total_receives'),DB::raw('SUM(excess_payment) as total_excess_payment'))->whereRaw($condition_payment)->where('customer_id',$contact->id)->first();
            if(!empty($paymentreceives->total_excess_payment)||!empty($paymentreceives->total_receives)||!empty($paymentreceives->total)||!empty($invoice->due_amount)||!empty($invoice->total)|| !empty($credit_note_amount)||!empty($credit_refund)||!empty($credit_note_payment))
            {
                $customerReport[] =[
                    'customer_id'          => $contact->id,
                    'display_name'         => $contact->display_name,
                    'invoices'             => $invoice->total,
                    'total_sales'          => $invoice->total_sales,
                    'total_cr_amount'      => $credit_note_amount,
                    'total_refund'      =>    $credit_refund,
                    'paymentreceives'      => $paymentreceives->total_receives,
                    'total_receives'       => ($paymentreceives->total_receives-$paymentreceives->total_excess_payment)+$credit_note_payment,
                    'total_excess_payment' => $paymentreceives->total_excess_payment,
                    'due'                  => $invoice->due_amount,
                ];
            }
        }
        $ContactCategory=ContactCategory::all();
        $date=1;
        return view('report::customer',compact('customerReport','start','end','accounts','OrganizationProfile','ContactCategory','date','id'));
    }

    public function customerCategoryDate($start,$end,$id)
    {
        $customerReport = [];
        $accounts = Account::all();
        $OrganizationProfile = OrganizationProfile::find(1);
        $start = date("Y-m-d",strtotime($start)).' '.'00:00:00';
        $end = date("Y-m-d",strtotime($end)).' '.'23:00:00';


        // return $start.'-----------'.$end;
        $refund_start = date("d-m-Y",strtotime($start));
        $refund_end = date("d-m-Y",strtotime($end));
        $invoice_start = date("d.m-Y",strtotime($start));
        $invoice_end = date("d-m-Y",strtotime($end));
        $contacts = Contact::where('contact_category_id',$id)->get();
        foreach ($contacts as $contact)
        {
            $invoice =  Invoice::select('customer_id',DB::raw('SUM(due_amount) as due_amount'),DB::raw('count(*) as total'),DB::raw('SUM(total_amount) as total_sales'))->where('invoice_date',">=",$invoice_start)->where('invoice_date',"<=",$invoice_end)->where('customer_id',$contact->id)->first();
            $credit_note_amount = CreditNote::where('credit_note_date',">=",$start)->where('credit_note_date',"<=",$end)->where('customer_id',$contact->id)->sum('total_credit_note');
            $credit_refund= CreditNote::join('credit_note_refunds','credit_note_refunds.credit_note_id','=','credit_notes.id')->where('credit_note_refunds.date',">=",$refund_start)->where('credit_note_refunds.date',"<=",$refund_end)->where('credit_notes.customer_id',$contact->id)->select('credit_note_refunds.*')->sum('amount');
            $credit_note_payment= CreditNote::join('credit_note_payments','credit_note_payments.credit_note_id','=','credit_notes.id')->where('credit_notes.customer_id',$contact->id)->whereBetween('credit_note_payments.created_at',[$start,$end])->select('credit_note_payments.*')->sum('amount');
            $paymentreceives =  PaymentReceives::select('customer_id', DB::raw('count(*) as total'),DB::raw('SUM(amount) as total_receives'),DB::raw('SUM(excess_payment) as total_excess_payment'))->where('payment_date',">=",$start)->where('payment_date',"<=",$end)->where('customer_id',$contact->id)->first();
            if(!empty($paymentreceives->total_excess_payment)||!empty($paymentreceives->total_receives)||!empty($paymentreceives->total)||!empty($invoice->due_amount)||!empty($invoice->total)|| !empty($credit_note_amount)||!empty($credit_refund)||!empty($credit_note_payment))
            {
                $customerReport[] =[
                    'customer_id'          => $contact->id,
                    'display_name'         => $contact->display_name,
                    'invoices'             => $invoice->total,
                    'total_sales'          => $invoice->total_sales,
                    'total_cr_amount'      => $credit_note_amount,
                    'total_refund'      =>    $credit_refund,
                    'paymentreceives'      => $paymentreceives->total_receives,
                    'total_receives'       => ($paymentreceives->total_receives-$paymentreceives->total_excess_payment)+$credit_note_payment,
                    'total_excess_payment' => $paymentreceives->total_excess_payment,
                    'due'                  => $invoice->due_amount,
                ];
            }
        }
        $date=1;
        $ContactCategory=ContactCategory::all();
        return view('report::customer',compact('customerReport','start','end','accounts','OrganizationProfile','ContactCategory','id','date'));
    }

    public function customerDetails(Request $request, $id)
    {

        $customer_report = [];
        $accounts = Account::all();
        $contact = Contact::find($id);
        $OrganizationProfile = OrganizationProfile::find(1);
       $current_time = Carbon::now()->toDayDateTimeString();
//
//
        $start = date("Y-m-d",strtotime(Carbon::now()->toDateString()."-14 day")).' '.'00:00:00';
        $end = date("Y-m-d",strtotime(Carbon::now()->toDateString()."+1 day")).' '.'23:59:00';
        $invoice_start = (new DateTime($current_time))->modify('-14 day')->format('d-m-Y');
        $invoice_end = (new DateTime($current_time))->modify('+1 day')->format('d-m-Y');
       // $paymentMode = PaymentMode::all();
        $request->request->add(['from_date' => $invoice_start,'to_date'=>$invoice_end]);
        $this->customerDetailsSearch($request,$id,$customer);
        $customer_report =$customer;

       return view('report::customer_details',compact('customer_report','start','end','accounts','contact','OrganizationProfile'));
    }

    function array_unique_by_key(&$array, $key) {
        $tmp = array();
        $result = array();
        foreach ($array as $value) {
            if (!in_array($value[$key], $tmp)) {
                array_push($tmp, $value[$key]);
                array_push($result, $value);
            }
        }
        return $array = $result;
    }

    public  function _group_by($array, $key) {
       $return = array();
       foreach($array as $val){

             $return[$val[$key]][] = $val;


       }


        $dta = array();
        foreach($return as $item){
            if(count($item)>1){
                $temp ='';
                foreach($item as $value){
                    $temp.= $value['item_name'].', ';

                }

                if(isset($item[0]['item_name'])){
                    $item[0]['item_name'] =trim($temp,', ');
                    $dta[] = $item;
                }

            }else{
                $dta[] = $item;
            }
        }

        $customer_report2 = array();
        foreach ($dta as $item){

            foreach ($item as $value){
                $customer_report2[] = $value;
            }

        }

        return $customer_report2;
       }

    public function customerDetailsSearch(Request $request,$id,&$output=null)
    {


        $customer_report = [];
        $accounts = Account::all();
        $contact = Contact::find($id);
        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = date("Y-m-d",strtotime($request->input('from_date'))).' '.'00:00:00';
        $end = date("Y-m-d",strtotime($request->input('to_date')."+1 day")).' '.'23:59:00';
        $condition_cr = "str_to_date(credit_note_date, '%Y-%m-%d') between '$start' and '$end'";
       // $paymentMode = PaymentMode::all();
        $condition = "str_to_date(invoice_date, '%d-%m-%Y') between '$start' and '$end'";
        $condition_payment = "str_to_date(payment_date, '%Y-%m-%d') between '$start' and '$end'";
        $invoices =  Invoice::whereRaw($condition)->where('customer_id',$id)->get();
        $PaymentReceives = PaymentReceives::where('customer_id',$id)->whereRaw($condition_payment)->get();
        $creditnotes = CreditNote::where('customer_id',$id)->whereRaw($condition_cr)->get();
        $PaymentReceiveEntrysdata = array();

        //final start

         $final = new CustomerDetailsReport();
         $customer_report['final']= $final->generate($start,$end,$id);



        // final end
        foreach ($PaymentReceives as $key => $PaymentReceive)
        {
            $PaymentReceiveEntrysdata[$key] = PaymentReceiveEntryModel::where('payment_receives_id',$PaymentReceive->id)->get();
        }
        $creditnote_payament = CreditNotePayment::join('credit_notes','credit_notes.id','=','credit_note_payments.credit_note_id')
                                                ->where('customer_id',$id)
                                                ->whereBetween('credit_note_payments.created_at',[$start,$end])
                                                ->select(DB::raw('credit_note_payments.*'))
                                                ->groupBy(DB::raw('date(credit_note_payments.created_at)'))->get();
        $creditnote_payament_reports = [];
        foreach ($creditnote_payament as $item)
        {
           $data= $item->join('credit_notes','credit_notes.id','=','credit_note_payments.credit_note_id')
                       ->where('customer_id',$id)
                       ->where('credit_note_payments.created_at',$item->created_at)
                       ->select(DB::raw('credit_note_payments.*'),DB::raw('sum(credit_note_payments.amount) as totals_amount'))
                       ->groupBy('credit_note_id')->get();

              foreach ($data as $value)
              {

                 $p_particulars= $value->where('credit_note_id',$value->credit_note_id)->where('created_at',$value->created_at)->get();
                  $p_item='';
                  foreach ($p_particulars as $p_particular)
                  {
                      $p_item.= "INV-".$p_particular->invoice->invoice_number." - ".$p_particular->amount.","." ";
                  }


                  $creditnote_payament_reports[] = [
                    'id'                     => $value->id,
                    'cn_number'         => $value->creditNote->credit_note_number,
                    'item_name'         =>     "Invoice Payment <br/>"."(<span style='font-size:8px;'>".trim($p_item,', ').")</span>",
                    'type'                   => "creditnote_payaments",
                    'total_recieve_amount'   => $value->totals_amount,

                    'created_at'       => $value->created_at,
                    'payment_date'     => $value->created_at,
                    ];
              }

        }


        $creditnote_refunds_condition = "str_to_date(credit_note_refunds.date, '%d-%m-%Y') between '$start' and '$end'";
        $creditnote_refunds = CreditNoteRefund::join('credit_notes','credit_notes.id','=','credit_note_refunds.credit_note_id')
                                               ->where('customer_id',$id)
                                               ->whereRaw($creditnote_refunds_condition)
                                               ->select('credit_note_refunds.*','credit_note_refunds.date as date')
                                               ->get();


        $begin = new DateTime($start);
        $enddate = new DateTime($end);
        $enddate = $enddate->modify( '+1 day' );
        $interval = new DateInterval('P1D');
        $daterange = new DatePeriod($begin, $interval ,$enddate);

        foreach($daterange as $date)
        {

            foreach ($creditnote_payament_reports as $cr_single)
            {
                if($date->format('Y-m-d') == date('Y-m-d',strtotime($cr_single['created_at'])))
                {
                    $customer_report[] = $cr_single;
                }

            }


            foreach ($invoices as $key => $invoice)
            {
                if($date->format('Y-m-d') == date('Y-m-d',strtotime($invoice->invoice_date)))
                {
                  $item=  $this->getItem($invoice->invoiceEntries);
                    $customer_report[] = [
                    'id'              => $invoice->id,
                    'invoice_number'  => $invoice->invoice_number,
                    'item_name'  =>    $item,
                    'type'            => "invoice",
                    'invoice_date'    => $invoice->invoice_date,
                    'payment_date'    => $invoice->payment_date,
                    'total_amount'    => $invoice->total_amount,
                    'created_at'      => $invoice->created_at,
                    'invoice_date' => $invoice->invoice_date,
                    ];
                }
            }


            foreach ($PaymentReceives as $key => $PaymentReceive)
            {


                    if($date->format('Y-m-d') == date('Y-m-d',strtotime($PaymentReceive->payment_date)))
                    {
                         $particular = '';
                         foreach ($PaymentReceive->PaymentReceiveEntryData as $value){
                           $particular .= "INV-".$value->invoice->invoice_number." - ".$value->amount.', ';
                         }
                        if($particular)
                        {
                            $particular = "<span style='font-size: 8px'>" . trim($particular, ', ') . "</span>";
                            $particular = $particular ? "Invoice Payment<br/>(" . $particular . ")" : '';


                            $customer_report[] = [
                                'id' => $PaymentReceive->id,
                                'type' => "paymentreceiveinvoice",
                                'pr_number' => $PaymentReceive->pr_number,
                                'payment_mode' => $PaymentReceive->payment_mode_id,
                                'payment_date' => $PaymentReceive->payment_date,
                                'amount' => $PaymentReceive->amount - $PaymentReceive->excess_payment,
                                'receive_through' => isset($PaymentReceive->account->account_name) ? $PaymentReceive->account->account_name : '',
                                'created_at' => $PaymentReceive->created_at,
                                'updated_at' => $PaymentReceive->updated_at,
                                'item_name' => $particular,
                            ];
                        }
                    }

            }
            foreach ($PaymentReceives as $key => $PaymentReceive)
            {

                if($PaymentReceive->excess_payment > 0)
                {
                    if($date->format('Y-m-d') == date('Y-m-d',strtotime($PaymentReceive->payment_date)))
                    {
                        $customer_report[] = [
                        'id'                     => $PaymentReceive->id,
                        'type'                   => "paymentreceive",
                        'pr_number' => $PaymentReceive->pr_number,
                        'payment_mode'           => $PaymentReceive->payment_mode_id,
                        'payment_date'           => $PaymentReceive->payment_date,
                        'amount'                 => $PaymentReceive->excess_payment,
                        'receive_through' => isset($PaymentReceive->account->account_name) ? $PaymentReceive->account->account_name : '',
                        'created_at'             => $PaymentReceive->created_at,
                        'updated_at'             => $PaymentReceive->updated_at,
                        ];
                    }
                }
            }

            foreach($creditnotes as $key => $creditnote)
            {

                if($date->format('Y-m-d') == date('Y-m-d',strtotime($creditnote->credit_note_date)))
                    {
                    $item_name = CreditNote::join('credit_note_entries', 'credit_note_entries.credit_note_id', '=', 'credit_notes.id')->join('item', 'credit_note_entries.item_id', '=', 'item.id')->where('credit_note_id', $creditnote->id)->select(DB::raw("GROUP_CONCAT(item_name SEPARATOR ', ') as `item_name`"))->groupBy('credit_note_id')->first();

                    $item_name = implode(',', array_unique(explode(',', isset($item_name->item_name) ? $item_name->item_name : '')));

                    $customer_report[] = [
                        'id' => $creditnote->id,
                        'type' => "creditnote",
                        'cr_number' => $creditnote->credit_note_number,
                        'item_name' => !empty($item_name) ? $item_name : '',
                        'total_credit_amount' => $creditnote->total_credit_note,
                        'due' => $creditnote->available_credit,
                        'created_at' => $creditnote->created_at,
                        'credit_note_date' => $creditnote->credit_note_date,
                    ];
                }

            }

//            foreach($creditnote_payament as $key => $creditnote_payaments)
//            {
//
//                if ($date->format('Y-m-d') == date('Y-m-d',strtotime($creditnote_payaments->credit_note_date)))
//                {
//
//                    $customer_report[] = [
//                        'id' => $creditnote_payaments->id,
//                        'type' => "creditnote_payaments",
//                        'cn_number' => str_pad($creditnote_payaments->creditnote->credit_note_number,6, '0', STR_PAD_LEFT),
//                        'item_name' => 'Credit Note Payment '."<br/>(CN-".str_pad($creditnote_payaments->creditnote->credit_note_number,6, '0', STR_PAD_LEFT).")",
//                        'total_recieve_amount' => $creditnote_payaments->amount,
//                        'due' => $creditnote_payaments->invoice->due_amount,
//                        'created_at' => $creditnote_payaments->created_at,
//                        'credit_note_date' => $creditnote_payaments->credit_note_date,
//                    ];
//                }
//
//            }

            foreach($creditnote_refunds as $key => $creditnote_refund)
            {

                if($date->format('Y-m-d') == date('Y-m-d',strtotime($creditnote_refund->date)))
                {

                    $customer_report[] = [
                        'id' => uniqid(),
                        'type' => "creditnote_refund",
                        'cr_number' => $creditnote_refund->creditNote->credit_note_number,
                        'item_name' => 'Credit Note Refund',
                        'total_refund' => $creditnote_refund->amount,
                        'due' => $creditnote_refund->available_credit,
                        'created_at' => $creditnote_refund->created_at,
                        'date' => $creditnote_refund->date,
                    ];
                }

            }
        }


        $start = date('d-m-Y',strtotime($request->input('from_date')));
        $end = date('d-m-Y',strtotime($request->input('to_date')));

        $output = $customer_report;
        return view('report::customer_details',compact('customer_report','start','end','accounts','contact','OrganizationProfile'));

    }

   public function getItem($entry){
    $result = '';
    foreach ($entry as $value){

        $data= Item::find($value->item_id);
        if(isset($data->item_name)){
            $result.= $data->item_name.', ';
        }

    }
    return trim($result,', ');

   }


    public function item()
    {

        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-14 day')->format('d-m-Y');
        $end = (new DateTime($current_time))->modify('+1 day')->format('d-m-Y');
        $item =  Item::all();


        return view('report::item',compact('item','start','end','OrganizationProfile'));
    }
    public function filter_item(Request $request)
    {

        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($request->input('from_date')))->format('d-m-Y');
        $end = (new DateTime($request->input('to_date')))->format('d-m-Y');
        $item =  Item::all();


        return view('report::item',compact('item','start','end','OrganizationProfile'));
    }


    public function itemDetails($id,$start,$end)
    {
        $item =  Item::all();
        $item_report =  Item::find($id);
        $InvoiceEntry = InvoiceEntry::where('item_id',$id)->get();
        $stock = Stock::where('item_id',$id)->select(DB::raw('sum(total) as mtotal, stock.*'))->groupBy(array('bill_id','credit_note_id'))->get();


        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($start))->format('Y-m-d');
        $end = (new DateTime($end))->format('Y-m-d');

        return view('report::item_details',compact('stock','InvoiceEntry','start','end','item_report','item','OrganizationProfile'));
    }



        // $Product_phase_item_adds_array = [];
        // $Product_phase_item_list_array = [];
        // $i = 0;
        // $j = 0;
        // $OrganizationProfile = OrganizationProfile::find(1);

        // $Product =  Product::find($id);
        // $Product_phases =  Product::find($id)->productPhases;
        // $m = 0;
        // foreach ($Product_phases as $Product_phase) {

        //     $Product_phase_items = ProductPhase::find($Product_phase->id)->productPhaseItems;
        //     $k = 0;

        //     foreach ($Product_phase_items as $Product_phase_item) {

        //         $Product_phase_item_adds = ProductPhaseItem::find($Product_phase_item->id)->productPhaseItemAdds;


        //         if(count($Product_phase_item_adds)>0)
        //         {

        //             $Product_phase_item_adds_array[$i++] = $Product_phase_item_adds;

        //         }


        //         foreach ($Product_phase_item_adds as $Product_phase_item_add) {

        //             $item = ProductPhaseItemAdd::find($Product_phase_item_add->id)->item;

        //             if(count($item)>0)
        //             {

        //                 $Product_phase_item_list_array[$i++] = $item;
        //             }
        //         }
        //     }
        // }


        // $all_items = Item::all();

        // $item_report = [];
        // $n = 0;
        // foreach ($all_items as $all_item) {
        //     $total = 0;
        //     foreach ($Product_phase_item_adds_array as $Product_phase_item_adds_arrays) {

        //         foreach ($Product_phase_item_adds_arrays as $Product_phase_item_adds_arrayss) {
        //             if($all_item->id == $Product_phase_item_adds_arrayss->item_id)
        //             {

        //                 $total = $total+$Product_phase_item_adds_arrayss->total;
        //                 $amount = $all_item->item_sales_rate*$total;
        //                 $item_report[$n] =  [
        //                     'item_id'       => $all_item->id,
        //                     'item_name'     => $all_item->item_name,
        //                     'total'         => $total,
        //                     'amount'        => $amount,
        //                 ];
        //             }
        //        }

        //     }
        //     $n++;
        // }



        // $Products =  Product::all();




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function cashbook()
    {
        $accounts = Account::all();

        $current_time = Carbon::now()->toDayDateTimeString();

        $start = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+1 day')->format('Y-m-d');
        
        /*
        $start = date("Y-m-d",strtotime($request->input('from_date'))).' '.'00:00:00';
        $end = date("Y-m-d",strtotime($request->input('to_date')."+1 day")).' '.'00:00:00';
        */
        
        $begin_time = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
        $account_type = Account::where('account_type_id',4)->get();
        $JournalEntrys = [];

        $total_cash_inhand = 0;
        $total_cash_inhand_debit = 0;
        $total_cash_inhand_credit = 0;
        $total_current_cash_inhand_debit = 0;
        $total_current_cash_inhand_credit = 0;
        foreach ($account_type as $key => $value) {

            $JournalEntrys[] =  JournalEntry::whereBetween('assign_date',[$start,$end])->where('account_name_id',$value->id)->get()->sortBy('assign_date');

            // current cash in hand
            $current_cash_inhand_debit = JournalEntry::select(DB::raw('SUM(amount) as amount'))->whereBetween('assign_date',[$start,$end])->where('account_name_id',$value->id)->where('debit_credit',1)->get()->sortBy('assign_date');

            $current_cash_inhand_credit = JournalEntry::select(DB::raw('SUM(amount) as amount'))->whereBetween('assign_date',[$start,$end])->where('account_name_id',$value->id)->where('debit_credit',0)->get()->sortBy('assign_date');
            $total_current_cash_inhand_debit = $total_current_cash_inhand_debit+$current_cash_inhand_debit[0]['amount'];
            $total_current_cash_inhand_credit = $total_current_cash_inhand_credit+$current_cash_inhand_credit[0]['amount'];
            $current_cash_in_hand = $total_current_cash_inhand_debit-$total_current_cash_inhand_credit;


            // total cash in hand
            //$start = (new DateTime($current_time))->modify('-1 day')->format('Y-m-d'); //$start changes as Opening balance will not include current time
            $cash_inhand_debit = JournalEntry::select(DB::raw('SUM(amount) as cash_inhand'))->whereBetween('assign_date',[$begin_time,$start])->where('account_name_id',$value->id)->where('debit_credit',1)->get()->sortBy('assign_date');
            $cash_inhand_credit = JournalEntry::select(DB::raw('SUM(amount) as cash_inhand'))->whereBetween('assign_date',[$begin_time,$start])->where('account_name_id',$value->id)->where('debit_credit',0)->get()->sortBy('assign_date');

            $total_cash_inhand_debit = $total_cash_inhand_debit+(int)$cash_inhand_debit[0]['cash_inhand'];
            $total_cash_inhand_credit = $total_cash_inhand_credit+(int)$cash_inhand_credit[0]['cash_inhand'];
            $total_cash_inhand = $total_cash_inhand_debit-$total_cash_inhand_credit;
        }
        $cashdata=[];

        foreach ($JournalEntrys as $item)
        {
            foreach ($item as $value){
                $cashdata[] = $value->toArray();
            }

        }
        $sort = new sortBydate();
        $JournalEntrys= $sort->get('\App\Models\ManualJournal\JournalEntry','assign_date','Y-m-d',$cashdata);
        $OrganizationProfile = OrganizationProfile::find(1);
        $start = (new DateTime($current_time))->modify('-0 day')->format('Y-m-d'); //$start changes as it is used in from to display
            $end = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d'); // &end changes as it is used in from to display
        return view('report::cash_book',compact('JournalEntrys','start','end','accounts','OrganizationProfile','total_cash_inhand','current_cash_in_hand','total_current_cash_inhand_debit','total_current_cash_inhand_credit','total_cash_inhand_debit','total_cash_inhand_credit'))->with('branch_id',$this->branch_id);
    }


    public function cashbooksearch(Request $request)
    {
        $accounts = Account::all();

        $current_time = Carbon::now()->toDayDateTimeString();
        $start = date("Y-m-d",strtotime($request->input('from_date'))).' '.'00:00:00';
        $end = date("Y-m-d",strtotime($request->input('to_date')."+0 day")).' '.'23:59:59';

        $begin_time = (new DateTime($current_time))->modify('-999999 day')->format('Y-m-d');
        $account_type = Account::where('account_type_id',4)->get();
      //  $account_type = Account::all();

        $JournalEntrys = [];

        $total_cash_inhand = 0;
        $total_cash_inhand_debit = 0;
        $total_cash_inhand_credit = 0;
        $total_current_cash_inhand_debit = 0;
        $total_current_cash_inhand_credit = 0;
        foreach ($account_type as $key => $value) {

            $JournalEntrys[] =  JournalEntry::whereBetween('assign_date',[$start,$end])->where('account_name_id',$value->id)->get();

            // current cash in hand
            $current_cash_inhand_debit = JournalEntry::select(DB::raw('SUM(amount) as amount'))->whereBetween('assign_date',[$start,$end])->where('account_name_id',$value->id)->where('debit_credit',1)->get()->sortBy('assign_date');

            $current_cash_inhand_credit = JournalEntry::select(DB::raw('SUM(amount) as amount'))->whereBetween('assign_date',[$start,$end])->where('account_name_id',$value->id)->where('debit_credit',0)->get()->sortBy('assign_date');
            $total_current_cash_inhand_debit = $total_current_cash_inhand_debit+$current_cash_inhand_debit[0]['amount'];
            $total_current_cash_inhand_credit = $total_current_cash_inhand_credit+$current_cash_inhand_credit[0]['amount'];
            $current_cash_in_hand = $total_current_cash_inhand_debit-$total_current_cash_inhand_credit;


            // total cash in hand
            //$start = date("Y-m-d",strtotime($request->input('from_date')."-1 day")).' '.'00:00:00'; //$start changes as Opening balance will not include current time
            $start = date("Y-m-d",strtotime($request->input('from_date')."-1 day")).' '.'23:59:59';
            $cash_inhand_debit = JournalEntry::select(DB::raw('SUM(amount) as cash_inhand'))->whereBetween('assign_date',[$begin_time,$start])->where('account_name_id',$value->id)->where('debit_credit',1)->get()->sortBy('assign_date');
            $cash_inhand_credit = JournalEntry::select(DB::raw('SUM(amount) as cash_inhand'))->whereBetween('assign_date',[$begin_time,$start])->where('account_name_id',$value->id)->where('debit_credit',0)->get()->sortBy('assign_date');

            $total_cash_inhand_debit = $total_cash_inhand_debit+(int)$cash_inhand_debit[0]['cash_inhand'];
            $total_cash_inhand_credit = $total_cash_inhand_credit+(int)$cash_inhand_credit[0]['cash_inhand'];
            $total_cash_inhand = $total_cash_inhand_debit-$total_cash_inhand_credit;
        }
        $cashdata=[];

        foreach ($JournalEntrys as $item)
        {
            foreach ($item as $value){
                $cashdata[] = $value->toArray();
            }

        }
        $sort = new sortBydate();
        $JournalEntrys= $sort->get('\App\Models\ManualJournal\JournalEntry','assign_date','Y-m-d',$cashdata);
        $OrganizationProfile = OrganizationProfile::find(1);
        $start = date("Y-m-d",strtotime($request->input('from_date'))).' '.'00:00:00'; //$start changes as it is used in from to display
        $end = date("Y-m-d",strtotime($request->input('to_date')."+0 day")).' '.'00:00:00'; // $end changes as it is used in from to display
        return view('report::cash_book',compact('JournalEntrys','start','end','accounts','OrganizationProfile','total_cash_inhand','current_cash_in_hand','total_current_cash_inhand_debit','total_current_cash_inhand_credit','total_cash_inhand_debit','total_cash_inhand_credit'))->with('branch_id',$this->branch_id);
    }



    public function checkBranch($data)
    {
        if ($this->branch_id==0) {
            $user=Auth::user();
            $this->branch_id=$user->branch_id;
        }
        
        if($this->branch_id!=1 && count($data)>0){
            $new=$data[0]->join('users','users.id','=','journal_entries.created_by')->where('branch_id',$this->branch_id)->get();
            return $new;
        }
        else{
            return $data;
        }

    }
}
