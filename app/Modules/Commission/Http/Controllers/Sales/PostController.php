<?php

namespace App\Modules\Commission\Http\Controllers\Sales;

use App\Lib\sortBydate;
use App\Models\AccountChart\Account;
use App\Models\Branch\Branch;
use App\Models\Contact\Agent;
use App\Models\Contact\Contact;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\Invoice;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Setting\SalesComission;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\Flysystem\Exception;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $date = "date";
        $sort = new sortBydate();
        $auth_id = Auth::id();
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $condition = "YEAR(str_to_date(date,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(date,'%Y-%m-%d')) = MONTH(CURDATE())";
        if($branch_id==1)
        {
            $salesCom = SalesComission::orderBy('date', 'desc')->whereRaw($condition)->get()->toArray();
          try{
              $salesCom = $sort->get('\App\Models\Setting\SalesComission', $date, 'Y-m-d', $salesCom);
              return view('commission::Sales.index', compact('salesCom', 'branchs'));
          }catch(\Exception $exception){

              return view('commission::Sales.index', compact('salesCom', 'branchs'));
          }
        }
        else
        {
            $salesCom = SalesComission::select(DB::raw('salescommisions.*'))->orderBy('date', 'desc')->whereRaw($condition)
                                        ->join('users','users.id','=','salescommisions.created_by')
                                        ->where('users.branch_id',$branch_id)
                                        ->get()
                                        ->toArray();
            try{
                $salesCom = $sort->get('\App\Models\Setting\SalesComission', $date, 'Y-m-d', $salesCom);
                return view('commission::Sales.index', compact('salesCom', 'branchs'));
            }catch(\Exception $exception){
                return view('commission::Sales.index', compact('salesCom', 'branchs'));
            }
        }
    }
    public function search(Request $request)
    {
        $branchs = Branch::orderBy('id','asc')->get();
        $branch_id =  $request->branch_id;
        $date="date";
        $sort= new sortBydate();
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
            $salesCom = SalesComission::select(DB::raw('salescommisions.*'))->orderBy('date','desc') ->whereRaw($condition)->get()->toArray();

        }else{
            $salesCom = SalesComission::select(DB::raw('salescommisions.*'))->orderBy('date','desc') ->whereRaw($condition)->join('users','users.id','=','salescommisions.created_by')->where('branch_id',$branch_id)->get()->toArray();

        }
        try{

            $salesCom= $sort->get('\App\Models\Setting\SalesComission',$date,'Y-m-d',$salesCom);
            return view('commission::Sales.index',compact('salesCom','branchs','branch_id','from_date','to_date'));
        }catch(\Exception $exception){
            return view('commission::Sales.index',compact('salesCom','branchs','branch_id','from_date','to_date'));
        }

    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {

       $number  = new \stdClass();
       $number->id = 1;
       $number_new=DB::table('salescommisions')->latest('id')->first();
       $number = $number_new?$number_new->id:$number->id;
       $scnumber = decbin(++$number);

        $commision= 0;
        $account = Account::whereIn('account_type_id',[4,5])->get();

        $payable = Invoice::where('agents_id',$id)->where('commission_type',2)->sum('agentcommissionAmount');
        $totalpayable = Invoice::where('agents_id',$id)->where('commission_type',1)->get();
        foreach ($totalpayable as $item)
        {
          $percent = ($item->total_amount/100)*$item->agentcommissionAmount;
          $commision = $commision+$percent;
        }
        $totalpayable = $payable + $commision;

        $com_amount = SalesComission::where('agents_id',$id)->sum('amount');
        $agent  = Contact::find($id);
        return view('commission::Sales.create',compact('agent','account','totalpayable','com_amount','scnumber'));
    }

    public function agent()
    {
        $agent  = Contact::all();
        return view('commission::Sales.agent',compact('agent'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$agents_id)
    {
        DB::beginTransaction();

       try{
           $number  = new \stdClass();
           $number->id = 1;
           $number_new=DB::table('salescommisions')->max('scNumber');

           $number = $number_new?++$number_new:$number->id;
           $scnumber = $number;
           $comission = new SalesComission();
           $comission->agents_id = $agents_id;
           $comission->date = date("Y-m-d",strtotime($request->date));
           $comission->scNumber = $scnumber;
           $comission->bank_info = $request->bankinfo;
           $comission->show = $request->show?"on":null;
           $comission->amount = $request->amount;
           $comission->PersonalNote = $request->PersonalNote;
           $comission->CustomerNote = $request->CustomerNote;
           $comission->paid_through_id = $request->account;
           $comission->created_by = Auth::id();
           $comission->updated_by  = Auth::id();

           if($comission->save())
           {


               //$journal = JournalEntry::where('account_name_id',$comission->paid_through_id)->where('agent_id',$comission->agents_id)->first();

                   $newjournal= new JournalEntry();
                   $newjournal->debit_credit =0;
                   $newjournal->amount =$comission->amount;
                   $newjournal->account_name_id =$comission->paid_through_id;
                   $newjournal->jurnal_type ="sales_commission";
                   $newjournal->salesComission_id =$comission->id;
                   $newjournal->agent_id =$comission->agents_id;
                   $newjournal->created_by = Auth::id();
                   $newjournal->updated_by  = Auth::id();
                   $newjournal->assign_date      = date('Y-m-d',strtotime($request->date));
                   $newjournal->save();

                   $newjournal2= new JournalEntry();
                   $newjournal2->debit_credit =1;
                   $newjournal2->amount =$comission->amount;
                   $newjournal2->account_name_id =11;
                   $newjournal2->jurnal_type ="sales_commission";
                   $newjournal2->salesComission_id =$comission->id;
                   $newjournal2->agent_id =$comission->agents_id;
                   $newjournal2->created_by = Auth::id();
                   $newjournal2->updated_by  = Auth::id();
                   $newjournal2->assign_date      = date('Y-m-d',strtotime($request->date));
                   $newjournal2->save();
               DB::commit();
               return redirect()
                   ->route('sales_commission')
                   ->with('alert.status', 'success')
                   ->with('alert.message', 'Sales Commission added!');

           }
           else
           {
               DB::rollback();
               return redirect()
                   ->route('sales_commission')
                   ->with('alert.status', 'warning')
                   ->with('alert.message', 'Sales Commission failed!');
           }


       }
       catch(\Illuminate\Database\QueryException $e)
       {
           DB::rollback();
           return redirect()
               ->route('sales_commission')
               ->with('alert.status', 'warning')
               ->with('alert.message', 'Sales Commission failed!');
       }


    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       try{
           $recent=SalesComission::orderBy("date", "desc")->get()->toArray();

           $date="date";
           $sort= new sortBydate();
           $recent= $sort->get('\App\Models\Setting\SalesComission',$date,'Y-m-d',$recent);
           $OrganizationProfile = OrganizationProfile::find(1);
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
           return view('commission::Sales.show',compact('salescommission','account','totalpayable','com_amount','balance','recent','OrganizationProfile'));
       }catch (\Illuminate\Database\QueryException $ex){
           return back()->with('alert.status', 'warning')
               ->with('alert.message', 'Sales Commission not found!');
       }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try {
            $salescommission = SalesComission::find($id);
            $commision = 0;
            $account = Account::whereIn('account_type_id', [4,5])->get();
            $payable = Invoice::where('agents_id', $salescommission->agents_id)->where('commission_type', 2)->sum('agentcommissionAmount');
            $totalpayable = Invoice::where('agents_id', $salescommission->agents_id)->where('commission_type', 1)->get();
            foreach ($totalpayable as $item) {
                $percent = ($item->total_amount / 100) * $item->agentcommissionAmount;
                $commision = $commision + $percent;
            }
            $totalpayable = $payable + $commision;
            $com_amount = SalesComission::where('agents_id', $salescommission->agents_id)->sum('amount');
            $balance = $totalpayable - $com_amount;
            return view('commission::Sales.edit', compact('salescommission', 'account', 'totalpayable', 'com_amount', 'balance'));
        }
        catch(\Illuminate\Database\QueryException $ex)
        {
            return back()->with('alert.status', 'warning')->with('alert.message', 'Sales Commission not found!');
        }
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        DB::beginTransaction();
        try{

            $comission = SalesComission::find($id);
            $comission->date = date("Y-m-d",strtotime($request->date));
            $comission->bank_info = $request->bankinfo;
            $comission->show = $request->show?"on":null;
            $comission->amount = $request->amount;
            $comission->PersonalNote = $request->PersonalNote;
            $comission->CustomerNote = $request->CustomerNote;
            $comission->paid_through_id = $request->account;
            $comission->updated_by  = Auth::id();
            $comission->save();


            $journal = JournalEntry::where('salesComission_id',$comission->id)->where('agent_id',$comission->agents_id)->get();

            if($journal->count()==2)
            {
                $journal_without_eleven = $journal->filter(function ($value, $key) {
                    return $value->account_name_id!= 11;
                });
                $journal_only_eleven = $journal->filter(function ($value, $key) {
                    return $value->account_name_id==11;
                });

                $journal_only_eleven=  $journal_only_eleven->first();
                $journal_without_eleven = $journal_without_eleven->first();


                $newjournal=  JournalEntry::find($journal_only_eleven->id);

                $newjournal->amount =$comission->amount;
                $newjournal->account_name_id =11;

                $newjournal->updated_by  = Auth::id();
                $newjournal->assign_date      = date('Y-m-d',strtotime($request->date));
                $newjournal->save();

                $newjournal=  JournalEntry::find($journal_without_eleven->id);

                $newjournal->amount =$comission->amount;
                $newjournal->account_name_id =$comission->paid_through_id;
                $newjournal->assign_date    = date('Y-m-d',strtotime($request->date));
                $newjournal->updated_by  = Auth::id();
                $newjournal->save();

            }






            DB::commit();
            return redirect()
                ->route('sales_commission')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Sales Commission Updated successfully!');
        }catch (\Illuminate\Database\QueryException $e){
            DB::rollback();
            return redirect()
                ->route('sales_commission')
                ->with('alert.status', 'warning')
                ->with('alert.message', 'Sales Commission update failed!');
        }


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      try{
           $comission= SalesComission::find($id);

           $journal = JournalEntry::where('salesComission_id',$comission->id)->where('agent_id',$comission->agents_id)->delete();
           if($comission->delete())
           {
              return redirect()
                  ->route('sales_commission')
                  ->with('alert.status', 'danger')
                  ->with('alert.message', 'Sales Commission deleted successfully!');
           }else
           {
               throw new \Exception();
           }
         }catch (\Exception $e){

          return redirect()
              ->route('sales_commission')
              ->with('alert.status', 'warning')
              ->with('alert.message', 'Sales Commission no deleted!');
          }


    }
}
