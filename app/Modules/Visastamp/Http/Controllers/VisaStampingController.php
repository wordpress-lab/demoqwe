<?php

namespace App\Modules\Visastamp\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Inventory\Stock;
use App\Models\ManualJournal\JournalEntry;
use App\Models\Moneyin\Invoice;
use App\Models\Moneyin\InvoiceEntry;
use App\Models\MoneyOut\Bill;
use App\Models\MoneyOut\BillEntry;
use App\Models\Visa\Visa;
use App\Models\VisaStamp\VisaStamp;
use App\Models\Recruit\Recruitorder;
use App\Models\StampingApproval\StampingApproval;
use App\Modules\Visastamp\Http\Response\VisaStampClass;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use App\Models\Musaned\Musaned;
use RecursiveArrayIterator;
use RecursiveIteratorIterator;
use Symfony\Component\CssSelector\Node\NegationNode;


class VisaStampingController extends Controller
{
    public function visa_stamp_download($id)
    {
        try{
            if(is_null($id))
            {
                throw new \Exception("This file is not available");
            }
            $file = VisaStamp::find($id);
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

        $total_sent = VisaStamp::whereNotNull('send_date')
                        ->whereNull('return_date')
                        ->orwhere('return_date',"")
                        ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'visastamping.pax_id')
                        ->where('recruitingorder.status' , 1)
                        ->count();

        $total_returned = VisaStamp::whereNotNull('send_date')
                        ->whereNotNull('return_date')
                        ->where('return_date',"!=","")
                        ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'visastamping.pax_id')
                        ->where('recruitingorder.status' , 1)
                        ->count();
                        

        $left_temp = Recruitorder::where('status' , 1)->count();

        $left = $left_temp - $total_sent - $total_returned;

        if(isset($request->all)){
            $count = $request->id;
            if(is_null($id))
            {
                if (session('branch_id')==1){

                    $branch=Branch::all();
                    if($request->sendtoday)
                    {
                        $recruit = Recruitorder::join('visastamping','recruitingorder.id','=','visastamping.pax_id')
                                                ->whereDate('visastamping.created_at' , date("Y-m-d"))
                                                ->whereNotNull('visastamping.send_date')
                                                ->where("visastamping.send_date","!="," ")
                                                ->select('recruitingorder.*')
                                                ->get();

                    }
                    elseif($request->receivetoday)
                    {
                        $recruit = Recruitorder::join('visastamping','recruitingorder.id','=','visastamping.pax_id')
                                               ->whereDate('visastamping.created_at' , date("Y-m-d"))
                                               ->whereNotNull('visastamping.return_date')
                                               ->where("visastamping.return_date","!="," ")
                                               ->select('recruitingorder.*')
                                               ->get();
                    }else{
                        $recruit = Recruitorder::join('stampingapproval','recruitingorder.id','=','stampingapproval.pax_id')
                                                ->where('recruitingorder.status',1)
                                                ->where('stampingapproval.status',1)
                                                ->select('recruitingorder.*')
                                                ->get();
                    }


                    return view('visastamp::index',compact('id','branch','recruit','total_sent','total_returned','left','count'));
                }
                else {

                    $branch=Branch::where('id',session('branch_id'))->get();
                    $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                        //->join('stampingapproval','recruitingorder.id','=','stampingapproval.pax_id')
                        ->where('users.branch_id',session('branch_id'))
                        ->select('recruitingorder.*')
                        ->get();
                    return view('visastamp::index',compact('id','branch','recruit','total_sent','total_returned','left','count'));
                }
            }
            else {

                $branch=Branch::all();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->join('stampingapproval','recruitingorder.id','=','stampingapproval.pax_id')
                    ->where('users.branch_id',$id)
                    ->select('recruitingorder.*')
                    ->get();
                return view('visastamp::index',compact('id','branch','recruit','total_sent','total_returned','left','count'));

            }
        }
        else{
            if(is_null($id))
            {
                if (session('branch_id')==1){

                    $branch=Branch::all();
                    if($request->sendtoday)
                    {
                        $recruit = Recruitorder::join('visastamping','recruitingorder.id','=','visastamping.pax_id')
                                                ->leftjoin('fingerprint','fingerprint.paxid','recruitingorder.id')
                                                ->where('fingerprint.bmet_status','!=',1)
                                                ->orWhereNull('fingerprint.bmet_status')
                                                ->whereDate('visastamping.created_at' , date("Y-m-d"))
                                                ->whereNotNull('visastamping.send_date')
                                                ->where("visastamping.send_date","!="," ")
                                                ->select('recruitingorder.*')
                                                ->get();

                    }
                    elseif($request->receivetoday)
                    {
                        $recruit = Recruitorder::join('visastamping','recruitingorder.id','=','visastamping.pax_id')
                                               ->leftjoin('fingerprint','fingerprint.paxid','recruitingorder.id')
                                               ->where('fingerprint.bmet_status','!=',1)
                                               ->orWhereNull('fingerprint.bmet_status')
                                               ->whereDate('visastamping.created_at' , date("Y-m-d"))
                                               ->whereNotNull('visastamping.return_date')
                                               ->where("visastamping.return_date","!="," ")
                                               ->select('recruitingorder.*')
                                               ->get();
                    }else{
                        $recruit = Recruitorder::join('stampingapproval','recruitingorder.id','=','stampingapproval.pax_id')
                                                ->leftjoin('fingerprint','fingerprint.paxid','recruitingorder.id')
                                                ->where('fingerprint.bmet_status','!=',1)
                                                ->orWhereNull('fingerprint.bmet_status')
                                                ->where('recruitingorder.status',1)
                                                ->where('stampingapproval.status',1)
                                                ->select('recruitingorder.*')
                                                ->get();
                    }

                    $count = count($recruit);
                    return view('visastamp::index',compact('id','branch','recruit','total_sent','total_returned','left','count'));
                }
                else {

                    $branch=Branch::where('id',session('branch_id'))->get();
                    $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                        ->leftjoin('fingerprint','fingerprint.paxid','recruitingorder.id')
                        ->where('fingerprint.bmet_status','!=',1)
                        ->orWhereNull('fingerprint.bmet_status')
                        //->join('stampingapproval','recruitingorder.id','=','stampingapproval.pax_id')
                        ->where('users.branch_id',session('branch_id'))
                        ->select('recruitingorder.*')
                        ->get();
                    $count = count($recruit);
                    return view('visastamp::index',compact('id','branch','recruit','total_sent','total_returned','left','count'));
                }
            }
            else {

                $branch=Branch::all();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->leftjoin('stampingapproval','recruitingorder.id','=','stampingapproval.pax_id')
                    ->leftjoin('fingerprint','fingerprint.paxid','recruitingorder.id')
                    ->where('fingerprint.bmet_status','!=',1)
                    ->orWhereNull('fingerprint.bmet_status')
                    ->where('users.branch_id',$id)
                    ->select('recruitingorder.*')
                    ->get();
                $count = count($recruit);
                return view('visastamp::index',compact('id','branch','recruit','total_sent','total_returned','left','count'));

            }
        }
        
    }


    public function create()
    {

        $recruit = Recruitorder::leftjoin("stampingapproval","stampingapproval.pax_id","recruitingorder.id")
                                   ->where("stampingapproval.status",1)
                                   ->where("recruitingorder.status",1)
                                   ->select("recruitingorder.*")
                                   ->get();
        $visa = Visa::all();
        $entry=Recruitorder::rightjoin('visaentrys','recruitingorder.registerSerial_id','=','visaentrys.id')
                                    ->select(DB::raw('visaentrys.numberofVisa-count(recruitingorder.registerSerial_id) as totalserial,visaentrys.*'))
                                    ->groupBy('recruitingorder.registerSerial_id')
                                    ->orderBy('visaentrys.id','ASC')
                                    ->get();



        return view('visastamp::create',compact('visa','recruit','entry'));

    }

    public function recruitJson()
    {
        $entry=Recruitorder::rightjoin('visaentrys','recruitingorder.registerSerial_id','=','visaentrys.id')
                            ->select(DB::raw('visaentrys.numberofVisa-count(recruitingorder.registerSerial_id) as totalserial,visaentrys.*'))
                            ->groupBy('recruitingorder.registerSerial_id')
                            ->orderBy('visaentrys.id','ASC')
                            ->get();
        return response()->json($entry);
    }

    public function recruitDetailsJson($id)
    {
        $stamp = StampingApproval::where('pax_id',$id)->first();

        return Response::json($stamp);
    }

    public function register_serial_flat($value=[]){

        $data=[];

        if (is_array($value)){
           $pre_item = new RecursiveIteratorIterator(new RecursiveArrayIterator($value));
            foreach ($pre_item as $item){

                $visa=explode('/',$item);

                $data[$visa[1]]=$visa[0];
            }
            return $data;
        }
        return null;
    }

    public function register_serial_flate_id($value=[]){

        $data=[];

        if (is_array($value)){
            $pre_item = new RecursiveIteratorIterator(new RecursiveArrayIterator($value));
            foreach ($pre_item as $item){
                $data[]=explode('/',$item)[0];
            }
            return $data;
        }
        return null;
    }

    public function visaValidate($registerSerial){

        $new = $this->register_serial_flate_id($registerSerial);
        $old= $this->register_serial_flat($registerSerial);
        $count=array_count_values($new);
        foreach ($count as $id=>$value)
        {
            $data = array_search($id,$old);

            if ($data)
            {
                $refind=$data-$value;
                if ($refind<0)
                {
                    return false;
                }
            }
        }

        return true;
    }


    public function store(Request $request)
    {

       $result = $this->visaValidate($request->registerSerial_id);
        if($result){
           if($request->type == 1)
           {
                $validator = Validator::make($request->all(), [
                    'pax_id.*' => 'required',
                ]);
            }
            elseif($request->type == 2)
            {
                $validator = Validator::make($request->all(), [
                    'pax_id.*' => 'required'
                ]);
            }
           else
            {
               return Redirect::route('visastamp_create')->with('error','E-application Number Needed');
            }

            if($validator->fails())
            {
                return Redirect::route('visastamp_create')->withErrors($validator)->withInput();
            }

            $ResponseVisa = new VisaStampClass();
            $input = Input::all();
            $paxIds = $input['pax_id'];

            if($request->hasFile('img_url'))
            {

                foreach ($paxIds as $key => $paxId)
                {
                    if (is_array($request->pax_id[$key])) {
                        $pax = array_keys($request->pax_id[$key])[0];
                        $pax_id = $request->pax_id[$key][$pax];
                    } else {
                        $pax_id = $request->pax_id[$key];
                    }

                    if (is_array($request->registerSerial_id[$key])) {
                        $serial = array_keys($request->registerSerial_id[$key])[0];
                        $serial_id = $request->registerSerial_id[$key][$serial];
                    } else {
                        $serial_id = $request->registerSerial_id[$key];
                    }

                    if (is_array($request->eapplication_no[$key])) {
                        $tit = array_keys($request->eapplication_no[$key])[0];
                        $title = $request->eapplication_no[$key][$tit];
                    } else {
                        $title = $request->eapplication_no[$key];
                    }

                    if (is_array($request->img_url[$key])) {
                        $amou = array_keys($request->img_url[$key])[0];
                        $file = $request->img_url[$key][$amou];
                    } else {
                        $file = $request->img_url[$key];
                    }

                    $visa = VisaStamp::where('pax_id', $pax_id)->first();
                    $recruit_order=Recruitorder::where('id',$pax_id)->first();


                    if (empty($visa)) {

                        $fileName = uniqid() . '.' . $file->getClientOriginalName();
                        $file->move(public_path('all_image'), $fileName);

                        $visastamp = new VisaStamp();
                        $visastamp->pax_id = $pax_id;
                        $visastamp->send_date = $request->type == 1 ? $input['send_date'] : '';
                        $visastamp->return_date = $request->type == 2 ? $input['return_date'] : '';
                        $visastamp->comment = $request->comment;
                        $visastamp->eapplication_no = $title;
                        $visastamp->img_url = $fileName;
                        $visastamp->created_by = Auth::user()->id;
                        $visastamp->updated_by = Auth::user()->id;
                        $visastamp->save();


                        $recruit=Recruitorder::where('id',$pax_id)->first();
                        $recruit->registerSerial_id=$serial_id;
                        $recruit->save();

                        if ($visastamp && $request->return_date && $request->generate==1 && ($recruit_order->invoice_id==null || $recruit_order->bill_id==null)){

                            $ResponseVisa->invoiceBillCreate($request,$pax_id);
                        }
                    }
                    elseif($request->return_date && $request->generate==1 && ($recruit_order->invoice_id==null || $recruit_order->bill_id==null)){

                        if (is_array($request->pax_id[$key])) {
                            $pax = array_keys($request->pax_id[$key])[0];
                            $pax_id = $request->pax_id[$key][$pax];
                        } else {
                            $pax_id = $request->pax_id[$key];
                        }

                        if (is_array($request->registerSerial_id[$key])) {
                            $serial = array_keys($request->registerSerial_id[$key])[0];
                            $serial_id = $request->registerSerial_id[$key][$serial];
                        } else {
                            $serial_id = $request->registerSerial_id[$key];
                        }

                        if (is_array($request->eapplication_no[$key])) {
                            $tit = array_keys($request->eapplication_no[$key])[0];
                            $title = $request->eapplication_no[$key][$tit];
                        } else {
                            $title = $request->eapplication_no[$key];
                        }


                        $visa->return_date = $request->type == 2 ? $input['return_date'] : '';
                        $visa->comment = $request->comment;
                        $visa->eapplication_no = $title;
                        $visa->updated_by = Auth::user()->id;
                        $visa->update();

                        $recruit=Recruitorder::where('id',$pax_id)->first();
                        $recruit->registerSerial_id=$serial_id;
                        $recruit->save();

                        $ResponseVisa->invoiceBillCreate($request,$pax_id);

                    }

                    else {

                        if (is_array($request->pax_id[$key])) {
                            $pax = array_keys($request->pax_id[$key])[0];
                            $pax_id = $request->pax_id[$key][$pax];
                        } else {
                            $pax_id = $request->pax_id[$key];
                        }

                        if (is_array($request->registerSerial_id[$key])) {
                            $serial = array_keys($request->registerSerial_id[$key])[0];
                            $serial_id = $request->registerSerial_id[$key][$serial];
                        } else {
                            $serial_id = $request->registerSerial_id[$key];
                        }

                        if (is_array($request->eapplication_no[$key])) {
                            $tit = array_keys($request->eapplication_no[$key])[0];
                            $title = $request->eapplication_no[$key][$tit];
                        } else {
                            $title = $request->eapplication_no[$key];
                        }

                        if (is_array($request->img_url[$key])) {
                            $amou = array_keys($request->img_url[$key])[0];
                            $file = $request->img_url[$key][$amou];
                        } else {
                            $file = $request->img_url[$key];
                        }

                        $fileName = uniqid().$file->getClientOriginalName();
                        $file->move(public_path('all_image'), $fileName);

                        $visa->send_date = $request->type == 1 ? $input['send_date'] : '';
                        $visa->return_date = $request->type == 2 ? $input['return_date'] : '';
                        $visa->comment = $request->comment;
                        $visa->eapplication_no = $title;
                        $visa->img_url = $fileName;
                        $visa->updated_by = Auth::user()->id;
                        $visa->update();

                        $recruit=Recruitorder::where('id',$pax_id)->first();
                        $recruit->registerSerial_id=$serial_id;
                        $recruit->save();
                    }
                }

                return Redirect::route('visastamp')->withInput()->with('alert.status', 'success')
                    ->with('alert.message', 'Visa Stamp Created Successfully!');
            }else{

                foreach ($paxIds as $key => $paxId) {

                    if (is_array($request->pax_id[$key])) {
                        $pax = array_keys($request->pax_id[$key])[0];
                        $pax_id = $request->pax_id[$key][$pax];
                    } else {
                        $pax_id = $request->pax_id[$key];
                    }

                    if (is_array($request->registerSerial_id[$key])) {
                        $serial = array_keys($request->registerSerial_id[$key])[0];
                        $serial_id = $request->registerSerial_id[$key][$serial];
                    } else {
                        $serial_id = $request->registerSerial_id[$key];
                    }

                    if (is_array($request->eapplication_no[$key])) {
                        $tit = array_keys($request->eapplication_no[$key])[0];
                        $title = $request->eapplication_no[$key][$tit];
                    } else {
                        $title = $request->eapplication_no[$key];
                    }

                    $visa = VisaStamp::where('pax_id', $pax_id)->first();
                    $recruit_order=Recruitorder::where('id',$pax_id)->first();
                    //dd($recruit_order);


                    if (empty($visa)) {

                        $visastamp = new VisaStamp();
                        $visastamp->pax_id = $pax_id;
                        $visastamp->send_date = $request->type == 1 ? $input['send_date'] : '';
                        $visastamp->return_date = $request->type == 2 ? $input['return_date'] : '';
                        $visastamp->comment = $request->comment;
                        $visastamp->eapplication_no = $title;
                        $visastamp->created_by = Auth::user()->id;
                        $visastamp->updated_by = Auth::user()->id;
                        $visastamp->save();

                        $recruit=Recruitorder::where('id',$pax_id)->first();
                        $recruit->registerSerial_id=$serial_id;
                        $recruit->save();

                        if ($visastamp && $request->return_date && $request->generate==1 && ($recruit_order->invoice_id==null || $recruit_order->bill_id==null)){

                            $ResponseVisa->invoiceBillCreate($request,$pax_id);
                        }

                    }

                    elseif ($request->return_date && $request->generate==1 && ($recruit_order->invoice_id==null || $recruit_order->bill_id==null)){

                        if (is_array($request->pax_id[$key])) {
                            $pax = array_keys($request->pax_id[$key])[0];
                            $pax_id = $request->pax_id[$key][$pax];
                        } else {
                            $pax_id = $request->pax_id[$key];
                        }

                        if (is_array($request->registerSerial_id[$key])) {
                            $serial = array_keys($request->registerSerial_id[$key])[0];
                            $serial_id = $request->registerSerial_id[$key][$serial];
                        } else {
                            $serial_id = $request->registerSerial_id[$key];
                        }

                        if (is_array($request->eapplication_no[$key])) {
                            $tit = array_keys($request->eapplication_no[$key])[0];
                            $title = $request->eapplication_no[$key][$tit];
                        } else {
                            $title = $request->eapplication_no[$key];
                        }


                        $visa->return_date = $request->type == 2 ? $input['return_date'] : '';
                        $visa->comment = $request->comment;
                        $visa->eapplication_no = $title;
                        $visa->updated_by = Auth::user()->id;
                        $visa->update();

                        $recruit=Recruitorder::where('id',$pax_id)->first();
                        $recruit->registerSerial_id=$serial_id;
                        $recruit->save();

                        $ResponseVisa->invoiceBillCreate($request,$pax_id);

                    }

                    else {

                        if (is_array($request->pax_id[$key])) {
                            $pax = array_keys($request->pax_id[$key])[0];
                            $pax_id = $request->pax_id[$key][$pax];
                        } else {
                            $pax_id = $request->pax_id[$key];
                        }

                        if (is_array($request->registerSerial_id[$key])) {
                            $serial = array_keys($request->registerSerial_id[$key])[0];
                            $serial_id = $request->registerSerial_id[$key][$serial];
                        } else {
                            $serial_id = $request->registerSerial_id[$key];
                        }

                        if (is_array($request->eapplication_no[$key])) {
                            $tit = array_keys($request->eapplication_no[$key])[0];
                            $title = $request->eapplication_no[$key][$tit];
                        } else {
                            $title = $request->eapplication_no[$key];
                        }

                        $visa->send_date = $request->type == 1 ? $input['send_date'] : '';
                        $visa->return_date = $request->type == 2 ? $input['return_date'] : '';
                        $visa->comment = $request->comment;
                        $visa->eapplication_no = $title;
                        $visa->updated_by = Auth::user()->id;
                        $visa->update();

                        $recruit=Recruitorder::where('id',$pax_id)->first();
                        $recruit->registerSerial_id=$serial_id;
                        $recruit->save();

                    }
                }

                return Redirect::route('visastamp')->withInput()->with('alert.status', 'success')
                    ->with('alert.message', 'Visa Stamp Created Successfully!');
            }
        }
        else{

            return Redirect::route('visastamp_create')->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Visa Stamp Not Available!');
        }

    }


    public function edit($id)
    {
        $visa=VisaStamp::find($id);
        $recruit=Recruitorder::find($id);
        $order=Recruitorder::all();

        $entry=Recruitorder::rightjoin('visaentrys','recruitingorder.registerSerial_id','=','visaentrys.id')
            ->select(DB::raw('visaentrys.numberofVisa-count(recruitingorder.registerSerial_id) as totalserial,visaentrys.*'))
            ->groupBy('recruitingorder.registerSerial_id')
            ->orderBy('visaentrys.id','ASC')
            ->get();

        return view('visastamp::edit',compact('visa','recruit','order','entry'));
    }

    public function update(Request $request, $id)
    {
        $ResponseVisa = new VisaStampClass();
         $value=$request->registerSerial_id;
         $data=explode('/',$value[0])[0];

        $result = $this->visaValidate($request->registerSerial_id);

        if ($result) {

            if ($request->type == 1) {
                $validator = Validator::make($request->all(), [
                    'pax_id.*' => 'required'
                ]);
            }elseif ($request->type == 2) {
                $validator = Validator::make($request->all(), [
                    'pax_id.*' => 'required'
                ]);
            }
             else {
                return Redirect::route('visastamp_edit')->with('error','E-application Number Needed');
            }

            if ($validator->fails()) {
                return redirect::back()->withErrors($validator);
            }


            if ($request->hasFile('img_url')) {

                $recruit=Recruitorder::where('id',$request->pax_id)->first();
                $recruit->registerSerial_id=$data;
                $recruit->save();

                $fileName = uniqid().$request->img_url->getClientOriginalName();
                $request->img_url->move(public_path('all_image'), $fileName);

             if ($request->send_date){
                 $stamp = VisaStamp::find($id);
                 $stamp->pax_id = $request->pax_id;
                 $stamp->send_date = $request->send_date;
                 $stamp->comment = $request->comment;
                 $stamp->eapplication_no = $request->eapplication_no;
                 $stamp->img_url = $fileName;
                 $stamp->created_by = Auth::user()->id;
                 $stamp->updated_by = Auth::user()->id;
                 $stamp->update();
             }

                if ($request->return_date && $request->generate==1 && ($recruit->invoice_id==null || $recruit->bill_id==null))
                {
                    $ResponseVisa->invoiceBillCreate($request,$request->pax_id);

                    $stamp = VisaStamp::find($id);
                    $stamp->return_date = $request->return_date;
                    $stamp->save();

                }

                return Redirect::route('visastamp')->withInput()->with('alert.status', 'success')
                    ->with('alert.message', 'Visa Stamp Updated successfully!');
            } else {

                //dd($request->all());

                $visastamp = VisaStamp::find($id);

                if ($visastamp->img_url == null){
                    return redirect()->back()->withInput()->with('alert.status', 'danger')
                        ->with('alert.message', 'Image Field Required!');
                }
                if ($visastamp->img_url != null) {
                    $recruit = Recruitorder::where('id', $request->pax_id)->first();
                    $recruit->registerSerial_id = $data;
                    $recruit->save();

                    if ($request->send_date) {

                        $stamp = VisaStamp::find($id);
                        $stamp->pax_id = $request->pax_id;
                        $stamp->send_date = $request->send_date;
                        $stamp->comment = $request->comment;

                        $stamp->eapplication_no = $request->eapplication_no;
                        $stamp->created_by = Auth::user()->id;
                        $stamp->updated_by = Auth::user()->id;
                        $stamp->save();


                    }

                    if ($request->return_date && $request->generate==1 && ($recruit->invoice_id==null || $recruit->bill_id==null))
                    {
                        $ResponseVisa->invoiceBillCreate($request,$request->pax_id);

                        $stamp = VisaStamp::find($id);
                        $stamp->return_date = $request->return_date;
                        $stamp->save();
                    }

                    if ($request->return_date)
                    {

                        $stamp = VisaStamp::find($id);
                        $stamp->return_date = $request->return_date;
                        $stamp->save();
                    }

                    return Redirect::route('visastamp')->withInput()->with('alert.status', 'success')
                        ->with('alert.message', 'Visa Stamp Updated successfully!');
                }else{
                    return Redirect::route('visastamp_edit',$id)->withInput()->with('alert.status', 'danger')
                        ->with('alert.message', 'Image Field Required!');
                }
            }
        }else{

            return Redirect::route('visastamp_edit',$id)->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Visa Stamp Not Available');
        }

 }


    public function delete($id)
    {
        $stamp=VisaStamp::find($id);
        $stamp->delete();
        return redirect()->back()->with('delete','Visa Stamp Deleted Successfully');


    }
}
