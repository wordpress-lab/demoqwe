<?php

namespace App\Modules\Estimate\Http\Controllers;

use App\Lib\sortBydate;
use App\Models\Branch\Branch;
use App\Models\Contact\Contact;
use App\Models\Moneyin\Estimate;
use App\Models\Moneyin\Estimate_Entry;
use App\Models\Moneyin\Invoice;
use App\Models\OrganizationProfile\OrganizationProfile;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EstimateWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $auth_id = Auth::id();
        $estimate= [];
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $condition = "YEAR(str_to_date(date,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(date,'%Y-%m-%d')) = MONTH(CURDATE())";
        if($branch_id==1)
        {
            $estimate = Estimate::whereRaw($condition)->get()->toArray();
        }
        else
        {
           $estimate = Estimate::select(DB::raw('estimates.*'))->whereRaw($condition)->join('users','users.id','=','estimates.created_by')->where('users.branch_id',$branch_id)->get()->toArray();
        }
        $date="date";
        $sort= new sortBydate();
        try{
            $estimate= $sort->get('\App\Models\Moneyin\Estimate',$date,'Y-m-d',$estimate);
            return view('estimate::estimate.index',compact('estimate','branchs'));
        }catch (\Exception $exception){
            return view('estimate::estimate.index',compact('estimate','branchs'));
        }


    }
    public function search(Request $request)
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
            $estimate = Estimate::select(DB::raw('estimates.*'))->orderBy('date','desc')->whereRaw($condition)->get()->toArray();

        }else{
            $estimate = Estimate::select(DB::raw('estimates.*'))->orderBy('estimates.date','desc')->whereRaw($condition)->join('users','users.id','=','estimates.created_by')->where('branch_id',$branch_id)->get()->toArray();

        }
        $date="date";
        $sort= new sortBydate();
        try {
           $estimate = $sort->get('\App\Models\Moneyin\Estimate', $date, 'Y-m-d', $estimate);
           return view('estimate::estimate.index', compact('estimate', 'branchs','branch_id','from_date','to_date'));
        }catch(\Exception $exception){

           return view('estimate::estimate.index',compact('estimate','branchs','branch_id','from_date','to_date'));
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pdf($id)
    {
        $OrganizationProfile = OrganizationProfile::find(1);
        $estimate_entry =  Estimate_Entry::where('estimate_id',$id)->get();
        $estimate =  Estimate::find($id);
        $pdf = PDF::loadView('estimate::estimate.pdf',compact('OrganizationProfile','estimate_entry','estimate'));
        return $pdf->stream();


    }

    public function Toprint($id)
    {
        $OrganizationProfile = OrganizationProfile::find(1);
        $estimate_entry =  Estimate_Entry::where('estimate_id',$id)->get();
        $estimate =  Estimate::find($id);

        $pdf = PDF::loadView('estimate::estimate.print',compact('OrganizationProfile','estimate_entry','estimate'));
        return $pdf->stream();;


    }


    public function create()
    {
        $number_new =new \stdClass();$number_new->id=1;
        $number=  Estimate::orderBy('id', 'desc')->first();
        $estimate_number = $number?$number:$number_new;

        $customer = Contact::whereIn('contact_category_id',array(1,2))->get();
        return view('estimate::estimate.create',compact('customer','estimate_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       DB::beginTransaction();
        $this->validate($request, [
            'customer_id'    => 'required',
            'date' => 'required',

            'item_id.*'      => 'required',
            'quantity.*'     => 'required',
            'rate.*'         => 'required',
            'tax_id.*'       => 'required',
            'amount.*'       => 'required',
            'account_id'     => 'required',
        ]);
       try{
           $data = $request->except('_token');


           $user_id = Auth::user()->id;
           $estimate =  new Estimate();
           $estimate->estimate_number = $request->estimate_number;
           $estimate->customer_id = $request->customer_id;
           $estimate->date = date("Y-m-d",strtotime($request->date));
           $estimate->ref = $request->ref;
           $estimate->attn = $request->attn;
           $estimate->attn_designation = $request->attn_designation;
           $estimate->subject = $request->subject;
           $estimate->heading = $request->heading;
           $estimate->table_head = $request->table_head;
           $estimate->terms_conditions = $request->terms_conditions;
           $estimate->left_notation = $request->left_notation;
           $estimate->right_notation = $request->right_notation;
           $estimate->shipping_charge = $request->shipping_charge;
           $estimate->adjustment = $request->adjustment;
           $estimate->total_amount = $request->total_amount;
           $estimate->tax_total = $request->tax_total;
           $estimate->due_amount = $request->total_amount;
           $estimate->created_by = $user_id;
           $estimate->updated_by = $user_id;
           $estimate->save();

           $i = 0;
           foreach ($data['item_id'] as $account)
           {
               if(!$data['discount'][$i])
               {
                   $estimate_entry[] = [
                       'quantity'          => $data['quantity'][$i],
                       'rate'              => $data['rate'][$i],
                       'amount'            => $data['amount'][$i],
                       'discount'          => 0,
                       'item_id'           => $data['item_id'][$i],
                       'estimate_id'        => $estimate->id,
                       'tax_id'            => $data['tax_id'][$i],
                       'account_id'        => $data['account_id'][$i],
                       'created_by'        => $user_id,
                       'updated_by'        => $user_id,
                       'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                       'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                   ];
               }
               else
               {
                   $estimate_entry[] = [
                       'quantity'          => $data['quantity'][$i],
                       'rate'              => $data['rate'][$i],
                       'amount'            => $data['amount'][$i],
                       'discount'          => $data['discount'][$i],
                       'item_id'           => $data['item_id'][$i],
                       'estimate_id'        =>  $estimate->id,
                       'tax_id'            => $data['tax_id'][$i],
                       'account_id'        => $data['account_id'][$i],
                       'created_by'        => $user_id,
                       'updated_by'        => $user_id,
                       'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                       'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                   ];
               }


               $i++;
           }

          if(DB::table('estimate_entries')->insert($estimate_entry)){
              DB::commit();
             return redirect()
               ->route('estimate')
               ->with('alert.status', 'success')
               ->with('alert.message', 'estimate added successfully!');
          }else{
              DB::rollback();
              return redirect()
                  ->route('estimate')
                  ->with('alert.status', 'danger')
                  ->with('alert.message', 'estimate add failed!');
          }



       }
       catch (Exception $e)
       {
           DB::rollback();
           return redirect()
               ->route('estimate')
               ->with('alert.status', 'danger')
               ->with('alert.message', 'estimate add failed!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {


        $customer = Contact::whereIn('contact_category_id',array(1,2))->get();
        $estimate = Estimate::find($id);
        $estimate_entry =  Estimate_Entry::where('estimate_id',$id)->get();
        return view('estimate::estimate.edit',compact('customer','estimate','estimate_entry'));
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
        $this->validate($request, [
            'customer_id'    => 'required',
            'date' => 'required',

            'item_id.*'      => 'required',
            'quantity.*'     => 'required',
            'rate.*'         => 'required',
            'tax_id.*'       => 'required',
            'amount.*'       => 'required',
            'account_id'     => 'required',
        ]);
        try{
            $data = $request->except('_token');


            $user_id = Auth::user()->id;
            $estimate =   Estimate::find($id);
            $estimate->estimate_number = $request->estimate_number;
            $estimate->customer_id = $request->customer_id;
            $estimate->date = date("Y-m-d",strtotime($request->date));
            $estimate->ref = $request->ref;
            $estimate->attn = $request->attn;
            $estimate->attn_designation = $request->attn_designation;
            $estimate->subject = $request->subject;
            $estimate->heading = $request->heading;
            $estimate->table_head = $request->table_head;
            $estimate->terms_conditions = $request->terms_conditions;
            $estimate->left_notation = $request->left_notation;
            $estimate->right_notation = $request->right_notation;
            $estimate->shipping_charge = $request->shipping_charge;
            $estimate->adjustment = $request->adjustment;
            $estimate->total_amount = $request->total_amount;
            $estimate->tax_total = $request->tax_total;
            $estimate->due_amount = $request->total_amount;
            $estimate->created_by = $user_id;
            $estimate->updated_by = $user_id;
            $estimate->save();

            $i = 0;
            foreach ($data['item_id'] as $account)
            {
                if(!$data['discount'][$i])
                {
                    $estimate_entry[] = [
                        'quantity'          => $data['quantity'][$i],
                        'rate'              => $data['rate'][$i],
                        'amount'            => $data['amount'][$i],
                        'discount'          => 0,
                        'item_id'           => $data['item_id'][$i],
                        'estimate_id'        => $estimate->id,
                        'tax_id'            => $data['tax_id'][$i],
                        'account_id'        => $data['account_id'][$i],
                        'created_by'        => $user_id,
                        'updated_by'        => $user_id,
                        'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    ];
                }
                else
                {
                    $estimate_entry[] = [
                        'quantity'          => $data['quantity'][$i],
                        'rate'              => $data['rate'][$i],
                        'amount'            => $data['amount'][$i],
                        'discount'          => $data['discount'][$i],
                        'item_id'           => $data['item_id'][$i],
                        'estimate_id'        =>  $estimate->id,
                        'tax_id'            => $data['tax_id'][$i],
                        'account_id'        => $data['account_id'][$i],
                        'created_by'        => $user_id,
                        'updated_by'        => $user_id,
                        'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    ];
                }


                $i++;
            }
            Estimate_Entry::where('estimate_id',$id)->delete();
            if(DB::table('estimate_entries')->insert($estimate_entry)){
                DB::commit();
                return redirect()
                    ->route('estimate')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Estimate Updated successfully!');
            }else{
                DB::rollback();
                return redirect()
                    ->route('estimate')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Estimate Update failed!');
            }



        }
        catch (Exception $e)
        {
            DB::rollback();
            return redirect()
                ->route('estimate')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Estimate Update failed!');
        }
    }

    public function invoice($id)
    {
        DB::beginTransaction();
        try {
            $number_new = new \stdClass();
            $number_new->invoice_number = 1;
            $number = Invoice::orderBy('id', 'desc')->first();
            $invoice_number = $number ? $number : $number_new;
            $user_id = Auth::user()->id;


            $estimate = Estimate::find($id);

            $new_invoice = new Invoice();

            $new_invoice->invoice_number = ++$invoice_number->invoice_number;
            $new_invoice->invoice_date = date('d-m-Y');
            $new_invoice->payment_date = date('d-m-Y');
            $new_invoice->tax_total = $estimate->tax_total;
            $new_invoice->shipping_charge = $estimate->shipping_charge;
            $new_invoice->adjustment = $estimate->adjustment;
            $new_invoice->total_amount = $estimate->total_amount;
            $new_invoice->due_amount = $estimate->due_amount;
            $new_invoice->customer_id = $estimate->customer_id;
            $new_invoice->customer_id = $estimate->customer_id;
            $new_invoice->created_by = $user_id;
            $new_invoice->updated_by = $user_id;

            if ($new_invoice->save()) {

                $estimate_entry = Estimate_Entry::where('estimate_id', $id)->get(['quantity', 'amount', 'discount', 'rate', 'item_id', 'tax_id', 'account_id']);

                foreach ($estimate_entry as $value) {
                    $invoice_entry[] = [
                        'quantity' => $value->quantity,
                        'rate' => $value->rate,
                        'amount' => $value->amount,
                        'discount' => $value->discount,
                        'item_id' => $value->item_id,
                        'invoice_id' => $new_invoice->id,
                        'tax_id' => $value->tax_id,
                        'account_id' => $value->account_id,
                        'created_by' => $user_id,
                        'updated_by' => $user_id,
                        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
                    ];
                }

                if (DB::table('invoice_entries')->insert($invoice_entry)) {
                    Estimate::find($id)->delete();
                    Estimate_Entry::where('estimate_id',$id)->delete();
                    DB::commit();

                    return redirect()
                        ->route('invoice')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'invoices Converted successfully!');
                } else {
                    DB::rollback();
                    return redirect()
                        ->route('invoice')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'invoices Convert failed!');
                }
            }
        }catch (Exception $exception){
            DB::rollback();
            return redirect()
                ->route('invoice')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'invoices Convert failed!');
        }

    }
    public function invoice_store(Request $request,$id)
    {

        DB::beginTransaction();
        $this->validate($request, [
            'customer_id'    => 'required',
            'date' => 'required',

            'item_id.*'      => 'required',
            'quantity.*'     => 'required',
            'rate.*'         => 'required',
            'tax_id.*'       => 'required',
            'amount.*'       => 'required',
            'account_id'     => 'required',
        ]);
        try{
            $data = $request->except('_token');


            $user_id = Auth::user()->id;
            $estimate =   Estimate::find($id);
            $estimate->estimate_number = $request->estimate_number;
            $estimate->customer_id = $request->customer_id;
            $estimate->date = $request->date;
            $estimate->ref = $request->ref;
            $estimate->attn = $request->attn;
            $estimate->attn_designation = $request->attn_designation;
            $estimate->subject = $request->subject;
            $estimate->heading = $request->heading;
            $estimate->table_head = $request->table_head;
            $estimate->terms_conditions = $request->terms_conditions;
            $estimate->left_notation = $request->left_notation;
            $estimate->right_notation = $request->right_notation;
            $estimate->shipping_charge = $request->shipping_charge;
            $estimate->adjustment = $request->adjustment;
            $estimate->total_amount = $request->total_amount;
            $estimate->tax_total = $request->tax_total;
            $estimate->due_amount = $request->total_amount;
            $estimate->created_by = $user_id;
            $estimate->updated_by = $user_id;

            $estimate->save();

            $i = 0;
            foreach ($data['item_id'] as $account)
            {
                if(!$data['discount'][$i])
                {
                    $estimate_entry[] = [
                        'quantity'          => $data['quantity'][$i],
                        'rate'              => $data['rate'][$i],
                        'amount'            => $data['amount'][$i],
                        'discount'          => 0,
                        'item_id'           => $data['item_id'][$i],
                        'estimate_id'        => $estimate->id,
                        'tax_id'            => $data['tax_id'][$i],
                        'account_id'        => $data['account_id'][$i],
                        'created_by'        => $user_id,
                        'updated_by'        => $user_id,
                        'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    ];
                }
                else
                {
                    $estimate_entry[] = [
                        'quantity'          => $data['quantity'][$i],
                        'rate'              => $data['rate'][$i],
                        'amount'            => $data['amount'][$i],
                        'discount'          => $data['discount'][$i],
                        'item_id'           => $data['item_id'][$i],
                        'estimate_id'        =>  $estimate->id,
                        'tax_id'            => $data['tax_id'][$i],
                        'account_id'        => $data['account_id'][$i],
                        'created_by'        => $user_id,
                        'updated_by'        => $user_id,
                        'created_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'        => \Carbon\Carbon::now()->toDateTimeString(),
                    ];
                }


                $i++;
            }
            Estimate_Entry::where('estimate_id',$id)->delete();
            if(DB::table('estimate_entries')->insert($estimate_entry)){
                DB::commit();
                return redirect()
                    ->route('estimate')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Estimate Updated successfully!');
            }else{
                DB::rollback();
                return redirect()
                    ->route('estimate')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Estimate Update failed!');
            }



        }
        catch (Exception $e)
        {
            DB::rollback();
            return redirect()
                ->route('estimate')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Estimate Update failed!');
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

           Estimate::find($id)->delete();
           Estimate_Entry::where('estimate_id',$id)->delete();

            return redirect()
                ->route('estimate')
                ->with('alert.status', 'success')
                ->with('alert.message', 'estimate deleted!');

        }catch (\Exception $e){
            return redirect()
                ->route('estimate')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'estimate Not deleted!');
        }
    }
}
