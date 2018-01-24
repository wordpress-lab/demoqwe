<?php

namespace App\Modules\Flightnew\Http\Controllers;

use App\Models\Inventory\Item;
use App\Models\MoneyOut\BillEntry;
use App\Modules\Flightnew\Http\Responce\ConfirmationResponce;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\Http\Requests;
use App\Http\Controllers\Controller;

//Models
use App\Models\Branch\Branch;
use App\Models\Flightnew\Confirmation;
use App\Models\Flightnew\ConfirmationFile;
use App\Models\Recruit\Recruitorder;
use App\Models\Contact\Contact;
use App\Models\Flightnew\Submission;
use App\Models\Moneyin\Invoice;
use Auth;

class ConfirmationController extends Controller
{
    public function confirmation_file_download($id)
    {
        try{
            if(is_null($id))
            {
                throw new \Exception("This file is not available");
            }
            $file = ConfirmationFile::find($id);
            if(!$file)
            {
                throw new \Exception("This file is not available");
            }
            $path = public_path("all_image/".$file->img_url);
            $mime = mime_content_type($path);
            if($mime=="application/msword")
            {
                return Response::download($path);
            }

            return Response::make(file_get_contents($path), 200, [
                'Content-Type' => $mime,
                'Content-Disposition' => 'inline; filename="'.$file->img_url.'"'
            ]);
        }catch (\Exception $exception){

            $msg=  $exception->getMessage();
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "Sorry, $msg.");
        }
    }
    public function index(Request $request,$id=null)
    {
        $completed = Confirmation::whereNotNull('date_of_flight')
                                            ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'confirmations.pax_id')
                                            ->where('recruitingorder.status' , 1)
                                            ->count();

        $left_temp = Recruitorder::where('status' , 1)->count();

        $left = $left_temp - $completed;

        if(isset($request->all)){
            $count = $request->id;
            if(is_null($id))
            {
                if(session('branch_id')==1)
                {
                    $branch=Branch::all();
                    if($request->today)
                    {
                        $recruit = Recruitorder::join("confirmations","confirmations.pax_id","recruitingorder.id")
                                                 ->whereDate('confirmations.created_at' , date("Y-m-d"))
                                                 ->get();
                    }
                    else
                    {
                        $recruit = Recruitorder::where('status' , 1)
                            ->where('registerSerial_id' , '!=' , Null)
                            ->get();
                    }

                    return view('flightnew::confirmation.index',compact('id','branch','recruit','completed','left','count'));
                }
                else
                {

                    $branch=Branch::where('id',session('branch_id'))->get();
                    $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                        ->where('users.branch_id',session('branch_id'))
                        ->where('recruitingorder.status',1)
                        ->where('recruitingorder.registerSerial_id' , '!=' , Null)
                        ->select('recruitingorder.*')
                        ->get();
                    return view('flightnew::confirmation.index',compact('id','branch','recruit','completed','left','count'));
                }
            }
            else
            {

                $branch=Branch::all();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->where('users.branch_id',$id)
                    ->where('recruitingorder.status',1)
                    ->where('recruitingorder.registerSerial_id' , '!=' , Null)
                    ->select('recruitingorder.*')
                    ->get();
                return view('flightnew::confirmation.index',compact('id','branch','recruit','completed','left','count'));

            }
        }
        else{
            if(is_null($id))
            {
                if(session('branch_id')==1)
                {
                    $branch=Branch::all();
                    if($request->today)
                    {
                        $recruit = Recruitorder::join("confirmations","confirmations.pax_id","recruitingorder.id")
                                                ->leftjoin('arrival_recruit','arrival_recruit.recruitorder_id','recruitingorder.id')
                                                ->leftjoin('submission','submission.pax_id','recruitingorder.id')
                                                ->whereNotNull('submission.expected_flight_date')
                                                ->whereNull('arrival_recruit.arrival_number')
                                                ->whereDate('confirmations.created_at' , date("Y-m-d"))
                                                ->select('recruitingorder.*')
                                                ->get();
                    }
                    else
                    {
                        $recruit = Recruitorder::leftjoin('arrival_recruit','arrival_recruit.recruitorder_id','recruitingorder.id')
                            ->leftjoin('submission','submission.pax_id','recruitingorder.id')
                            ->whereNotNull('submission.expected_flight_date')
                            ->whereNull('arrival_recruit.arrival_number')
                            ->where('status' , 1)
                            ->where('registerSerial_id' , '!=' , Null)
                            ->select('recruitingorder.*')
                            ->get();
                    }
                    $count = count($recruit);
                    return view('flightnew::confirmation.index',compact('id','branch','recruit','completed','left','count'));
                }
                else
                {

                    $branch=Branch::where('id',session('branch_id'))->get();
                    $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                        ->leftjoin('arrival_recruit','arrival_recruit.recruitorder_id','recruitingorder.id')
                        ->leftjoin('submission','submission.pax_id','recruitingorder.id')
                        ->whereNotNull('submission.expected_flight_date')
                        ->whereNull('arrival_recruit.arrival_number')
                        ->where('users.branch_id',session('branch_id'))
                        ->where('recruitingorder.status',1)
                        ->where('recruitingorder.registerSerial_id' , '!=' , Null)
                        ->select('recruitingorder.*')
                        ->get();
                    $count = count($recruit);
                    return view('flightnew::confirmation.index',compact('id','branch','recruit','completed','left','count'));
                }
            }
            else
            {

                $branch=Branch::all();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->leftjoin('arrival_recruit','arrival_recruit.recruitorder_id','recruitingorder.id')
                    ->leftjoin('submission','submission.pax_id','recruitingorder.id')
                    ->whereNotNull('submission.expected_flight_date')
                    ->whereNull('arrival_recruit.arrival_number')
                    ->where('users.branch_id',$id)
                    ->where('recruitingorder.status',1)
                    ->where('recruitingorder.registerSerial_id' , '!=' , Null)
                    ->select('recruitingorder.*')
                    ->get();
                $count = count($recruit);
                return view('flightnew::confirmation.index',compact('id','branch','recruit','completed','left','count'));

            }
        }
        
    }

    public function create($id)
    {
        $item=Item::all();
        $submission = Submission::where('pax_id' , $id)->first();
        if(($submission == Null) || ($submission->owner_approval == 0)){
            return back()->with(['alert.message' => 'Can\'t create because of the submission module owner approval not set' , 'alert.status' => 'danger']);
        }
        $order=Recruitorder::find($id);
        $contact = Contact::all();
        
        return view('flightnew::confirmation.create',compact('order' , 'contact','item'));
    }

    public function store(Request $request,$id)
    {
        $validator = Validator::make($request->all(), [
            'vendor_name' => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect::back()->withErrors($validator);
        }

        $date = date('Y-m-d', strtotime($request->date_of_flight));

        if(empty($request->date_of_flight)){
           $date = Null; 
        }

        $recruit = Recruitorder::find($id);

        if($recruit->invoice){
            $invoice = Invoice::find($recruit->invoice['id']);

            if($request->e_ticket_number != Null){
                $invoice->payment_date = ($date!=null)?date('d-m-Y', strtotime($date)):' ';
                $invoice->update();
            }
        }
        
        $result=new Confirmation();
        $result->flight_number              = $request->flight_number;
        $result->date_of_flight             = $date;
        $result->departure_time             = $request->departure_time;
        $result->arrival_time               = $request->arrival_time;
        $result->e_ticket_number            = $request->e_ticket_number;
        $result->vendor_name                = $request->vendor_name;
        $result->comment                    = $request->comment;
        $result->pax_id                     = $id;
        $result->created_by                 = Auth::user()->id;
        $result->updated_by                 = Auth::user()->id;

        if($result->save())
        {

                $ResponseConfirm=new ConfirmationResponce();
                $new_bill= $ResponseConfirm->MakeBill($request,$id);
                $result->bill_id = $new_bill['id'];
                if($new_bill)
                {
                    $ResponseConfirm->BillJournalEntry($new_bill);
                }

            if ($request->hasFile('img_url'))
            {
                    foreach ($request->img_url as $key=>$file)
                    {

                        if(is_array($request->title[$key])){
                            $tit=array_keys($request->title[$key])[0];
                            $title= $request->title[$key][$tit];
                        }else{
                            $title= $request->title[$key] ;
                        }

                        if(is_array($request->img_url[$key])){
                            $amou=array_keys($request->img_url[$key])[0];
                            $file= $request->img_url[$key][$amou];
                        }else{
                            $file= $request->img_url[$key] ;
                        }

                        $fileName=uniqid(). '.' .$file->getClientOriginalName();
                        $file->move(public_path('all_image'), $fileName);
                        $cnfirm=new ConfirmationFile();
                        $cnfirm->confirmation_id=$result->id;
                        $cnfirm->title=$title;
                        $cnfirm->img_url=$fileName;
                        $cnfirm->save();

                    }

                     return Redirect::route('confirmation')->withInput()->with('alert.status', 'success')
                                                                        ->with('alert.message', 'Confirmation added successfully!');
                 }
        }
        else
        {
                 return back()->withInput()->with('alert.status', 'danger')
                                           ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
        }
    }


    public function edit($id)
    {
        $item2=Item::all();
        $recruit=Recruitorder::find($id);
        $order=Recruitorder::all();
        $finger=Confirmation::all();
        $confirm=Confirmation::where('pax_id',$id)->first();

        $bill_rate=BillEntry::where('bill_id',$confirm->bill_id)->first();
        //dd($bill_rate->bill['id']);
        $item=Item::where('id',$bill_rate['item_id'])->first();

        $contact = Contact::all();
        foreach ($finger as $value){
            if ($value->pax_id==$recruit->id){
                return view('flightnew::confirmation.edit',compact('finger','order','recruit' ,'contact','item','bill_rate','item','item2'));
            }
        }

        return Redirect::route('confirmation_create',$id);
    }

    public function update(Request $request, $id)
    {
        $paxid=$request->paxid;

        $validator = Validator::make($request->all(), [
            'vendor_name' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $date = date('Y-m-d', strtotime($request->date_of_flight));

        if(empty($request->date_of_flight)){
           $date = Null; 
        }

        $recruit = Recruitorder::find($paxid);

        if($recruit->invoice){
            $invoice = Invoice::find($recruit->invoice['id']);

            if($request->e_ticket_number != Null){
                $invoice->payment_date = ($date!=null)?date('d-m-Y', strtotime($date)):' ';
                $invoice->update();
            }
        }
        
        $result=Confirmation::find($id);

        if ($result->bill_id==null) {

            $result->flight_number = $request->flight_number;
            $result->date_of_flight = $date;
            $result->departure_time = $request->departure_time;
            $result->arrival_time = $request->arrival_time;
            $result->e_ticket_number = $request->e_ticket_number;
            $result->vendor_name = $request->vendor_name;
            $result->comment = $request->comment;
            $result->updated_by = Auth::user()->id;
            $result->update();

            if ($result) {

                $ResponseConfirm = new ConfirmationResponce();
                $new_bill = $ResponseConfirm->MakeBill($request, $paxid);
                $result->bill_id = $new_bill['id'];
                if ($new_bill) {
                    $ResponseConfirm->BillJournalEntry($new_bill);
                }
            }

        }else{

            $result->flight_number = $request->flight_number;
            $result->date_of_flight = $date;
            $result->departure_time = $request->departure_time;
            $result->arrival_time = $request->arrival_time;
            $result->e_ticket_number = $request->e_ticket_number;
            $result->vendor_name = $request->vendor_name;
            $result->comment = $request->comment;
            $result->updated_by = Auth::user()->id;
            $result->update();
        }

        if($result)
        {
            if ($request->hasFile('img_url'))
                {
                    foreach ($request->img_url as $key=>$file)
                    {
                       $index= substr($key, 0, 3 );
                        if ($index =='old')
                        {
                            $fileName = uniqid() . 'st.' . $file->getClientOriginalName();
                            $file->move(public_path('all_image'), $fileName);

                            $id=explode('_',$key)[1];
                            $entry=ConfirmationFile::find($id);
                            $image_path = public_path("all_image/$entry->img_url");
                            $entry->title=$request->title[$key];
                            $entry->img_url=$fileName;

                               if ($entry->save()){

                                   if(file_exists($image_path))
                                   {
                                       unlink($image_path);
                                   }
                                }

                        }else{

                            if (is_array($request->title[$key])) {
                                $tit = array_keys($request->title[$key])[0];
                                $title = $request->title[$key][$tit];
                            } else {
                                $title = $request->title[$key];
                            }

                            if (is_array($request->img_url[$key])) {
                                $amou = array_keys($request->img_url[$key])[0];
                                $file = $request->img_url[$key][$amou];
                            } else {
                                $file = $request->img_url[$key];
                            }

                            $fileName = uniqid() . '.' . $file->getClientOriginalName();
                            $file->move(public_path('all_image'), $fileName);

                            $visa_entry = new ConfirmationFile();
                            $visa_entry->confirmation_id = $result->id;
                            $visa_entry->title = $title;
                            $visa_entry->img_url = $fileName;
                            $visa_entry->save();
                        }
                    }

                    return Redirect::route('confirmation')->withInput()->with('alert.status', 'success')
                        ->with('alert.message', 'Confirmation added successfully!');
                }else{
                    if($request->img_id){
                     $t=ConfirmationFile::whereNotIn('id', $request->img_id)->get();

                      foreach ($t as $value){

                         $image_path = public_path("all_image/$value->img_url");

                       if ( $value->delete()){
                           if(file_exists($image_path))
                           {
                               unlink($image_path);
                           }
                       }
                    }
                    return Redirect::route('confirmation')->withInput()->with('alert.status','success')->with('alert.message', 'Confirmation updated successfully!');
                }
                else{
                    return back()->withInput()->with('alert.status','danger')->with('alert.message', 'Sorry, something went wrong! Data cannot be update.');
                }
            }
        }

        else {
                return back()->withInput()->with('alert.status','danger')->with('alert.message', 'Sorry, something went wrong! Data cannot be update.');
            }
    }

    public function destroy($id)
    {
        //
    }
}
