<?php

namespace App\Modules\Bank\Http\Controllers;
use App\Lib\sortBydate;
use Dompdf\Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Validator;
use App\Lib\BankReport;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;


use App\Models\Bank\Bank;
use App\Models\Bank\BankName;

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

use App\Models\Moneyin\PaymentReceiveEntryModel;
use App\Models\Moneyin\PaymentReceives;
use App\Models\Moneyin\Invoice;
use App\Models\Branch\Branch;
use App\Models\Inventory\Product;
use App\Models\Inventory\ProductPhase;
use App\Models\Inventory\Item;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\ProductPhaseItem;
use App\Models\Inventory\ProductPhaseItemAdd;
use App\Models\Inventory\Stock;
use App\Models\OrganizationProfile\OrganizationProfile;
use DB;
use App\Models\PaymentMode\PaymentMode;

use Illuminate\Support\Facades\Redirect;

class HomeController extends Controller
{
    public function deposit()
    {
       $auth_id = Auth::id();
       $branch_id = session('branch_id');
      $condition = "YEAR(str_to_date(date,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(date,'%Y-%m-%d')) = MONTH(CURDATE())";

       if($branch_id==1)
       {
           $branchs = Branch::orderBy('id','asc')->get();

           $banks = Bank::orderBy('date','desc')
               ->where('type','Deposit')
               ->whereRaw($condition)
               ->get()
               ->toArray();
           $date="date";
           $sort= new sortBydate();
           try{
               $banks= $sort->get('\App\Models\Bank\Bank',$date,'Y-m-d',$banks);
               return view('bank::deposit',compact('banks','branchs'));
           }catch(\Exception $exception){
               return view('bank::deposit',compact('banks','branchs'));
           }
       }
       else
       {
           $branchs = Branch::orderBy('id','asc')->get();

           $banks = Bank::select('bank.*')
               ->where('bank.type','Deposit')
               ->whereRaw($condition)->join('users','users.id','=','bank.created_by')->where('users.branch_id',$branch_id)->get()->toArray();
           $date="date";
           $sort= new sortBydate();
           try{
               $banks= $sort->get('\App\Models\Bank\Bank',$date,'Y-m-d',$banks);
               return view('bank::deposit',compact('banks','branchs'));
           }catch (\Exception $exception){
             return view('bank::deposit',compact('banks','branchs'));
           }

       }

    }
    public function withdraw()
    {
        $auth_id = Auth::id();
        $branch_id = session('branch_id');
        $condition = "YEAR(str_to_date(date,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(date,'%Y-%m-%d')) = MONTH(CURDATE())";

        if($branch_id==1)
        {
            $branchs = Branch::orderBy('id','asc')->get();

            $banks = Bank::orderBy('date','desc')
                ->where('type','Withdrawal')
                ->whereRaw($condition)
                ->get()
                ->toArray();

            $date="date";
            $sort= new sortBydate();
            try{
                $banks= $sort->get('\App\Models\Bank\Bank',$date,'Y-m-d',$banks);
                return view('bank::withdraw',compact('banks','branchs'));
            }catch(\Exception $exception){
                return view('bank::withdraw',compact('banks','branchs'));
            }
        }
        else
        {
            $branchs = Branch::orderBy('id','asc')->get();

            $banks = Bank::select('bank.*')
                ->where('bank.type','Withdrawal')
                ->whereRaw($condition)->join('users','users.id','=','bank.created_by')->where('users.branch_id',$branch_id)->get()->toArray();
            $date="date";
            $sort= new sortBydate();
            try{
                $banks= $sort->get('\App\Models\Bank\Bank',$date,'Y-m-d',$banks);
                return view('bank::withdraw',compact('banks','branchs'));
            }catch (\Exception $exception){
                return view('bank::withdraw',compact('banks','branchs'));
            }

        }

    }


    public function searchDeposit(Request $request)
    {
         $branchs = Branch::orderBy('id','asc')->get();
         if(session('branch_id')==1)
         {
             $branch_id =  $request->branch_id?$request->branch_id:session('branch_id');
         }
         else
         {
             $branch_id = session('branch_id');
         }
         $from_date =  date('Y-m-d',strtotime($request->from_date));
         $to_date =  date('Y-m-d',strtotime($request->to_date));
         $condition = "str_to_date(date, '%Y-%m-%d') between '$from_date' and '$to_date'";
        if($branch_id==1){
            $banks = Bank::select('bank.*')
                ->whereRaw($condition)
                ->get()->toArray();

        }else{
            $banks = Bank::select('bank.*')
                ->whereRaw($condition)
                ->join('users','users.id','=','bank.created_by')
                ->where('branch_id',$branch_id)
                ->get()->toArray();

        }
         $date="date";
         $sort= new sortBydate();
        try{
            $banks= $sort->get('\App\Models\Bank\Bank',$date,'Y-m-d',$banks);
            return view('bank::deposit',compact('banks','branchs','branch_id','from_date','to_date'));
        }catch(\Exception $exception){

            return view('bank::deposit',compact('banks','branchs','branch_id','from_date','to_date'));
        }
    }

    public function searchWithdraw(Request $request)
    {
        $branchs = Branch::orderBy('id','asc')->get();
        if(session('branch_id')==1)
        {
            $branch_id =  $request->branch_id?$request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id = session('branch_id');
        }

        $from_date =  date('Y-m-d',strtotime($request->from_date));
        $to_date =  date('Y-m-d',strtotime($request->to_date));
        $condition = "str_to_date(date, '%Y-%m-%d') between '$from_date' and '$to_date'";

        if($branch_id==1){
            $banks = Bank::select('bank.*')
                ->whereRaw($condition)
                ->get()
                ->toArray();
        }else{
            $banks = Bank::select('bank.*')
                ->whereRaw($condition)
                ->join('users','users.id','=','bank.created_by')
                ->where('branch_id',$branch_id)
                ->get()
                ->toArray();
        }
        $date="date";
        $sort= new sortBydate();
        try{
            $banks= $sort->get('\App\Models\Bank\Bank',$date,'Y-m-d',$banks);
            return view('bank::withdraw',compact('banks','branchs','branch_id','from_date','to_date'));
        }catch(\Exception $exception){

            return view('bank::withdraw',compact('banks','branchs','branch_id','from_date','to_date'));
        }
    }


    public function create($id)
    {
        $bank_names = Contact::where('contact_category_id',5)->get();
        $accounts = Account::where('account_type_id',5)->get();
        $payment_mode = Account::whereIn('account_type_id',[4,5])->get();
        return view('bank::create', compact('bank_names','accounts','payment_mode','id'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
     	$this->validate($request, [
	            'type'           => 'required',
	            'bank_name_id'   => 'required',
	            'particulars'    => 'required',
	            'date'           => 'required',
	            'total_amount'   => 'required|numeric',
	            'payment_mode'   => 'required',

        	]);

        DB::beginTransaction();
        try{

              $bankacc = explode('/',$data['bank_name_id']);
              $contact = Contact::find(!empty($bankacc[0])?$bankacc[0]:null);
              $contact = isset($contact->display_name)?$contact->display_name:"no_name";
               $bank = new Bank;
               if(isset($request->invoice_show))
               {
                   $bank->invoice_show         = 1;
               }else
               {
                   $bank->invoice_show         = 0;
               }

               $bank->type                 = $data['type'];
               $bank->contact_id           = $bankacc[0];
               $bank->particulars          = $data['particulars'];
               $bank->date                 =  date('Y-m-d',strtotime($data['date']));
               $bank->cheque_number        = $data['cheque_number'];
               $bank->total_amount         = $data['total_amount'];
               $bank->notes                = $data['notes'];
               $bank->payment_mode_id      = $data['payment_mode'];
               $bank->account_id           = $bankacc[1];
               $bank->created_by           = Auth::id();
               $bank->updated_by           = Auth::id();
               $bank->bank_account_number  = isset($data['bank_account_number'])?$data['bank_account_number']:Null;
            if($request->hasFile('file1')){


                $file = $request->file('file1');

                if ($bank->file_url) {
                    $delete_path = public_path($bank->file_url);
                    if(file_exists($delete_path)){
                        $delete = unlink($delete_path);
                    }

                }

                $file_name = $file->getClientOriginalName();
                $without_extention = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention = $file->getClientOriginalExtension();
                $num = rand(1, 500);
                $new_file_name = "Bank-".$bank->type."-".$num.'_'.$contact.'.'.$file_extention;
                $success = $file->move('uploads/bank', $new_file_name);
                if ($success){
                    $bank->file_url = 'uploads/bank/' . $new_file_name;

                   }
               }

               if($bank->save())
               {

                   $bank = Bank::orderBy('created_at', 'desc')->first();

                   $journal_entry = new JournalEntry;
                   $journal_entry->amount              = $data['total_amount'];
                   $journal_entry->contact_id           = $bankacc[0];
                   $journal_entry->assign_date           = date('Y-m-d',strtotime($data['date']));
                   $journal_entry->debit_credit        = $data['type']=='Deposit'?1:0;
                   $journal_entry->account_name_id     = $bankacc[1];
                   $journal_entry->jurnal_type         = 'bank';
                   $journal_entry->bank_id             = $bank->id;
                   $journal_entry->created_by          = 1;
                   $journal_entry->updated_by          = 1;
                   $journal_entry->save();

                   $journal_entry = new JournalEntry;
                   $journal_entry->amount              = $data['total_amount'];
                   $journal_entry->contact_id           = $bankacc[0];
                   $journal_entry->assign_date           = date('Y-m-d',strtotime($data['date']));
                   $journal_entry->debit_credit        = $data['type']=='Deposit'?0:1;
                   $journal_entry->account_name_id     = $data['payment_mode'];
                   $journal_entry->jurnal_type         = 'bank';
                   $journal_entry->bank_id             = $bank->id;
                   $journal_entry->created_by          = 1;
                   $journal_entry->updated_by          = 1;

                  if($journal_entry->save()){
                      DB::commit();
                      if ($request->type=='Deposit'){
                          return redirect()
                              ->route('bank_deposit')
                              ->with('alert.status', 'success')
                              ->with('alert.message', 'Bank updated successfully!');
                      }
                      if ($request->type=='Withdrawal'){
                          return redirect()
                              ->route('bank_withdraw')
                              ->with('alert.status', 'success')
                              ->with('alert.message', 'Bank updated successfully!');
                      }
                  }else{

                      if ($request->type=='Deposit'){
                          return redirect()
                              ->route('bank_deposit')
                              ->with('alert.status', 'danger')
                              ->with('alert.message', 'Something went to wrong! Please Insert Data Again.!');
                      }
                      if ($request->type=='Withdrawal'){
                          return redirect()
                              ->route('bank_withdraw')
                              ->with('alert.status', 'danger')
                              ->with('alert.message', 'Something went to wrong! Please Insert Data Again.!');
                      }
                  }

               }

               else
               {

                   DB::rollBack();
                   if ($request->type=='Deposit'){
                       return redirect()
                           ->route('bank_deposit')
                           ->with('alert.status', 'danger')
                           ->with('alert.message', 'Something went to wrong! Please Insert Data Again.!');
                   }
                   if ($request->type=='Withdrawal'){
                       return redirect()
                           ->route('bank_withdraw')
                           ->with('alert.status', 'danger')
                           ->with('alert.message', 'Something went to wrong! Please Insert Data Again.!');
                   }

               }
           } catch (\Exception $exception){
              DB::rollBack();
            if($exception instanceof \Illuminate\Database\QueryException )
            {

                if (\App::environment('development', 'local'))
                {
                    $msg = $exception->getMessage();
                }

                if(isset($exception->errorInfo[0]) && isset($exception->errorInfo[1]) && count($exception->errorInfo)==3)
                {
                    if(isset($exception->errorInfo[0]) && isset($exception->errorInfo[1]) && isset($exception->errorInfo[2]) && $exception->errorInfo[0]=="42000" && $exception->errorInfo[1]=="1142")
                    {
                        $msg = explode("@",$exception->errorInfo[2])[0];
                    }

                    if ($exception->getCode() == "42000")
                    {
                        return back()
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'You not allowed at this moment'." ".$msg);
                    }

                }
            }
               return redirect()
                   ->back()
                   ->with('alert.status', 'danger')
                   ->with('alert.message', 'Something went to wrong! Please Insert Data Again.');
           }

        
    }

    public function show($id)
    {

       
        $bank_names = Contact::where('contact_category_id',5)->get();
        $bank = Bank::find($id);
        $payment_mode = Account::where('id',$bank->payment_mode_id)->first();
        $accounts = Account::where('id',$bank->account_id)->first();


        return view('bank::show', compact('bank','payment_mode','accounts','bank_names'));
    }
    public function showupload(Request $request,$id=null){
        $Bank = Bank::find($id);
        $validator = Validator::make($request->all(), [
            'file1' => 'required|max:10240',

        ]);
        $contact = isset($Bank->contact->display_name)?$Bank->contact->display_name:'no_name';
        if($request->hasFile('file1')) {
            $file = $request->file('file1');

            if ($Bank->file_url) {
                $delete_path = public_path($Bank->file_url);
                if(file_exists($delete_path)){
                    $delete = unlink($delete_path);
                }

            }

            $file_name = $file->getClientOriginalName();
            $without_extention = substr($file_name, 0, strrpos($file_name, "."));
            $file_extention = $file->getClientOriginalExtension();
            $num = rand(1, 500);
            $new_file_name = "Bank-".$Bank->type."-".$num.'_'.$contact.'.'.$file_extention;

            $success = $file->move('uploads/bank', $new_file_name);

            if ($success) {
                $Bank->file_url = 'uploads/bank/' . $new_file_name;
                //$Bank->file_name = $new_file_name;

                $Bank->save();
                return response("success");
            }else{
                return response("success");
            }
        }else{
            return response("file not found");
        }

    }
    public function edit($id)
    {
        $bank_names = Contact::where('contact_category_id',5)->get();
        $accounts = Account::where('account_type_id',5)->get();
        $payment_mode = Account::whereIn('account_type_id',[4,5])->get();
        $bank = Bank::find($id);
        return view('bank::edit', compact('bank','bank_names','payment_mode','accounts'));
    }

    public function update(Request $request, $id)
    {
            $this->validate($request, [
                'type'           => 'required',
                'bank_name_id'   => 'required',
                'particulars'    => 'required',
                'date'           => 'required',

                'total_amount'   => 'required|numeric',

                'payment_mode'   => 'required',
                'account'        => 'required',
            ]);
        DB::beginTransaction();
          try{

              $data = $request->all();
              $bankacc = explode('/',$data['bank_name_id']);
              $bank = Bank::find($id);
              $contact = Contact::find(!empty($bankacc[0])?$bankacc[0]:null);
              $contact = isset($contact->display_name)?$contact->display_name:"no_name";
              if(isset($request->invoice_show))
              {
                  $bank->invoice_show         = 1;
              }else
              {
                  $bank->invoice_show         = 0;
              }

              if($request->hasFile('file1'))
              {


                  $file = $request->file('file1');

                  if ($bank->file_url) {
                      $delete_path = public_path($bank->file_url);
                      if(file_exists($delete_path)){
                          $delete = unlink($delete_path);
                      }

                  }

                  $file_name = $file->getClientOriginalName();
                  $without_extention = substr($file_name, 0, strrpos($file_name, "."));
                  $file_extention = $file->getClientOriginalExtension();
                  $num = rand(1, 500);
                  $new_file_name = "Bank-".$bank->type."-".$num.'_'.$contact.'.'.$file_extention;
                  $success = $file->move('uploads/bank', $new_file_name);
                  if ($success){
                      $bank->file_url = 'uploads/bank/' . $new_file_name;

                  }
              }

              $bank->type                 = $data['type'];
              $bank->contact_id           = $bankacc[0];
              $bank->particulars          = $data['particulars'];
              $bank->date                 =   date('Y-m-d',strtotime($data['date']));
              $bank->cheque_number        = $data['cheque_number'];
              $bank->total_amount         = $data['total_amount'];
              $bank->notes                = $data['notes'];
              $bank->payment_mode_id      = $data['payment_mode'];
              $bank->account_id           = $bankacc[1];
              $bank->updated_by           = Auth::id();
              $bank->bank_account_number  = isset($data['bank_account_number'])?$data['bank_account_number']:Null;

              if($bank->update())
              {
                  //Update Time 
                  $created = JournalEntry::where('bank_id',$id)->first();

                  $created_by = $created->created_by;
                  $created_at = $created->created_at->toDateTimeString();
                  $updated_at = \Carbon\Carbon::now()->toDateTimeString();

                  JournalEntry::where('bank_id',$id)->delete();
                  $journal_entry = new JournalEntry;
                  $journal_entry->amount              = $data['total_amount'];
                  $journal_entry->contact_id           = $bankacc[0];
                  $journal_entry->assign_date           = date('Y-m-d',strtotime($data['date']));
                  $journal_entry->debit_credit        =  $data['type']=='Deposit'?1:0;
                  $journal_entry->account_name_id     = $bankacc[1];
                  $journal_entry->jurnal_type         = 'bank';
                  $journal_entry->bank_id             = $bank->id;
                  $journal_entry->created_by          = $created_by;
                  $journal_entry->updated_by          = Auth::id();
                  $journal_entry->created_at          = $created_at;
                  $journal_entry->updated_at          = $updated_at;
                  $journal_entry->save();

                  $journal_entry = new JournalEntry;
                  $journal_entry->amount              = $data['total_amount'];
                  $journal_entry->contact_id           = $bankacc[0];
                  $journal_entry->assign_date           = date('Y-m-d',strtotime($data['date']));
                  $journal_entry->debit_credit        =  $data['type']=='Deposit'?0:1;
                  $journal_entry->account_name_id     = $data['payment_mode'];
                  $journal_entry->jurnal_type         = 'bank';
                  $journal_entry->bank_id             = $bank->id;
                  $journal_entry->created_by          = $created_by;
                  $journal_entry->updated_by          = Auth::id();
                  $journal_entry->created_at          = $created_at;
                  $journal_entry->updated_at          = $updated_at;

                  if($journal_entry->save()){
                      DB::commit();
                      if ($request->type=='Deposit'){
                          return redirect()
                              ->route('bank_deposit')
                              ->with('alert.status', 'success')
                              ->with('alert.message', 'Bank updated successfully!');
                      }
                      if ($request->type=='Withdrawal'){
                          return redirect()
                              ->route('bank_withdraw')
                              ->with('alert.status', 'success')
                              ->with('alert.message', 'Bank updated successfully!');
                      }
                  }else{

                      DB::rollBack();
                      return redirect()
                          ->route('bank_edit', ['id' => $id])
                          ->with('alert.status', 'danger')
                          ->with('alert.message', 'Something went to wrong! please check your input field!!!');
                  }

              }

              else
              {
                  DB::rollBack();
                  return redirect()
                      ->route('bank_edit', ['id' => $id])
                      ->with('alert.status', 'danger')
                      ->with('alert.message', 'Something went to wrong! please check your input field!!!');
              }
        }catch(\Exception $exception){
              //dd($exception->getMessage());
              DB::rollBack();
              if($exception instanceof \Illuminate\Database\QueryException )
              {

                  if (\App::environment('development', 'local'))
                  {
                      $msg = $exception->getMessage();
                  }

                  if(isset($exception->errorInfo[0]) && isset($exception->errorInfo[1]) && count($exception->errorInfo)==3)
                  {
                      if(isset($exception->errorInfo[0]) && isset($exception->errorInfo[1]) && isset($exception->errorInfo[2]) && $exception->errorInfo[0]=="42000" && $exception->errorInfo[1]=="1142")
                      {
                          $msg = explode("@",$exception->errorInfo[2])[0];
                      }

                      if ($exception->getCode() == "42000")
                      {
                          return back()
                              ->with('alert.status', 'danger')
                              ->with('alert.message', 'You not allowed at this moment'.". ".$msg);
                      }

                  }
              }
              return redirect()
                  ->route('bank_edit', ['id' => $id])
                  ->with('alert.status', 'danger')
                  ->with('alert.message', 'Something went to wrong! please check your input field!!!');
          }


    }

    public function destroy($id)
    {


        $bank = Bank::find($id);
        if ($bank->file_url) {
                $delete_path = public_path($bank->file_url);
                if(file_exists($delete_path)){
                    $delete = unlink($delete_path);
                }
        }
        if($bank->delete())
        {
            if($bank->type=="Withdrawal") {
            return redirect()
                ->route('bank_withdraw')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Bank Transaction deleted successfully!!!');
            }else{
            return redirect()
                ->route('bank_deposit')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Bank Transaction deleted successfully!!!');    
            }
        }

    }




    // report -----------

    public function report(Request $request)
    {

        $OrganizationProfile = OrganizationProfile::find(1);
        $current_time = Carbon::now()->toDayDateTimeString();
        $start = (new DateTime($current_time))->modify('-30 day')->format('Y-m-d');
        $end = (new DateTime($current_time))->modify('+0 day')->format('Y-m-d');
        if($request->todaydeposit)
        {
            //masterdashboard
            $bank = JournalEntry::whereDate('journal_entries.assign_date',date('Y-m-d'))->join('account','journal_entries.account_name_id','=','account.id')->where('account.account_type_id',5)->where('journal_entries.debit_credit',1)->get();
        }
        elseif ($request->todaywithdraw)
        {
            //masterdashboard
            $bank = JournalEntry::whereDate('journal_entries.assign_date',date('Y-m-d'))->join('account','journal_entries.account_name_id','=','account.id')->where('account.account_type_id',5)->where('journal_entries.debit_credit',0)->get();
        }
        else
        {
            $bank = JournalEntry::join('contact', 'journal_entries.account_name_id', '=', 'contact.account_id')->where('contact.contact_category_id',5)->groupBy('journal_entries.account_name_id')->get()->sortBy('assign_date');
        }
        return view('bank::bank_report',compact('OrganizationProfile','start','end','bank'));

    }

    public function bankreportfilter(Request $request)
    {

        $this->validate($request, [
            'from_date'           => 'required',
            'to_date'   => 'required',

        ]);
        $OrganizationProfile = OrganizationProfile::find(1);
        $start = $request->from_date;
        $end = $request->to_date;
        $bank= JournalEntry::join('contact', 'journal_entries.account_name_id', '=', 'contact.account_id')->where('contact.contact_category_id',5)->groupBy('journal_entries.account_name_id')->get()->sortBy('assign_date');


        return view('bank::bank_report',compact('OrganizationProfile','start','end','bank'));

    }


    public function reportDetails($id,$start=null,$end=null)
    {
           try{
          $OrganizationProfile = OrganizationProfile::find(1);
          $current_time = Carbon::now()->toDayDateTimeString();
          $start = $start;
          $end = date('Y-m-d', strtotime($end . ' +1 day'));
          $bank= JournalEntry::where('account_name_id',$id)
              ->with("income","bank","paymentReceive","creditNoteRefund","expense","paymentMade","SalesCommission","journal")
              ->whereBetween('assign_date',array($start,$end))
              ->orderBy('assign_date','asc')
              ->get();
          $bank_name = Contact::where('account_id',$id)->first();
          $end = date('Y-m-d', strtotime($end . ' -1 day'));
          return view('bank::report_details',compact('OrganizationProfile','start','end','bank_report','bank','bank_name','id'));
      }catch (\Exception $e){
          return back();
      }
    }

    public function reportDetailsbyfilter($id,$start=null,$end=null)
    {
      try{

          $OrganizationProfile = OrganizationProfile::find(1);
          $current_time = Carbon::now()->toDayDateTimeString();
          $start = $start;
          $end =$end;
          $bank= JournalEntry::where('contact_id',$id)->whereBetween('assign_date',array($start,$end))->get()->sortBy('assign_date');
          $bank_name =  Contact::find($id);
          return view('bank::report_details',compact('OrganizationProfile','start','end','bank_report','bank','bank_name'));
      }catch (\Exception $e){
          return back();
      }

    }

    public function processfilterForm(Request $request, $id){
        try{
            $start  = $request->from_date ;
            $end = $request->to_date;
            $id=  $id;
            return Redirect::to('bank/report'.'/'.$id.'/'.$start.'/'.$end) ;
        }catch(\Exception $e)
        {
           return back();
        }

    }
}
