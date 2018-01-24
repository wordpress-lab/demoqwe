<?php

namespace App\Modules\Order\Http\Controllers\Order;

use App\Models\Branch\Branch;
use App\Models\Contact\Contact;
use App\Models\Inventory\Item;
use App\Models\Moneyin\Invoice;
use App\Models\Order\Order_file;
use App\Models\Recruit\Recruitorder;
use App\Models\Visa\Visa;
use App\Modules\Order\Http\Requests\order\CreatePostRequest;
use App\Modules\Order\Http\Requests\order\UpdatePostRequest;
use App\Modules\Order\Http\Response\RecruitCustomer;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

class WebController extends Controller
{

    public function download($id=null){
      try{
          if(is_null($id))
          {
             throw new \Exception("This file is not available");
          }
          $file=Order_file::find($id);
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
    public function index(Request $request, $id=null)
    {

       if (is_null($id))
       {
             if (session('branch_id')==1)
             {
                 $completed = Recruitorder::where('status',1)->count();
                 $left = Recruitorder::where('status',0)->count();

                 $branch=Branch::all();
                 if($request->today)
                 {
                     $order = Recruitorder::whereDate('created_at' , date("Y-m-d"))->get();
                 }
                 else
                 {
                     $order = Recruitorder::where('status',1)->get();
                 }

                 return view('order::order.index',compact('branch','id','completed','left'))->with('order',$order);
             }
             else
             {
                 $completed = Recruitorder::where('status',1)->count();
                 $left = Recruitorder::where('status',0)->count();

                 $branch=Branch::where('id',session('branch_id'))->get();
                 $order = Recruitorder::where('status',1)
                     ->join('users','recruitingorder.created_by','=','users.id')
                     ->where('users.branch_id',session('branch_id'))
                     ->select('recruitingorder.*')
                     ->get();
                 return view('order::order.index',compact('branch','id','completed','left'))->with('order',$order);
             }
        }
        else
        {
        if(session('branch_id')==1) {
            $completed = Recruitorder::where('status',1)->count();
            $left = Recruitorder::where('status',0)->count();

            $branch = Branch::all();

                $order = Recruitorder::where('status', 1)
                    ->join('users', 'recruitingorder.created_by', '=', 'users.id')
                    ->where('users.branch_id', $id)
                    ->select('recruitingorder.*')
                    ->get();

           return view('order::order.index',compact('branch','id','completed','left'))->with('order',$order);

       }
       else
       {
                return redirect()->back();
       }
       }
    }

    public function create()
    {
        $customer =  Contact::all();
        $package = Item::all();
        $registerserial = Visa::all();
        $invoice = Invoice::all();
        return view('order::order.create',compact('customer','package','registerserial','invoice'));
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
        'passenger_name' => 'required',
        'gender' => 'required',
        'customer_id' => 'required',
        'issue_date' => 'required',
        'passportNumber' => 'required',
        'visa_type' => 'required',
        'img_url' => 'required'
          ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        if($request->registerSerial_id)
        {
            $order_count = count(Recruitorder::where('registerSerial_id', $request->registerSerial_id)->get());
            $number_visa = Visa::where('id', $request->registerSerial_id)->first();
            if ($number_visa->numberofVisa <= $order_count)
            {
                return back()->withInput()->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, This Visa is not available.');
            }
        }

        $rec=Recruitorder::all();
        foreach ($rec as $value)
        {
            if ($value->paxid==$request->paxid)
            {
                return back()->withInput()->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, This Pax Id is not available.');
            }
        }

      $order =  new Recruitorder();

      $order->customer_id= $request->customer_id;
      $order->package_id=$request->package_id;
      $order->registerSerial_id=$request->registerSerial_id?$request->registerSerial_id:null;
      $order->paxid=$request->paxid;
      $order->passportNumber=$request->passportNumber;
//      $order->passportnumberbn=$request->passportNumberbn;
      $order->placeofissue=$request->placeofissue;
      $order->passportDate=isset($request->order_date)?$request->order_date:"";
      $order->passportissuedate=$request->issue_date;
      $order->salesRate=$request->salesRate;
      $order->order_status=$request->order_status;
      $order->substitued_order=$request->substitued_order;
      $order->passenger_name=$request->passenger_name;
      $order->agent_commission_amount=$request->agent_commission_amount;
      $order->commission_type=$request->commission_type;
      $order->visa_type=$request->visa_type;
      $order->visa_category_id=$request->visa_type==1?3:null;
      $order->remarks=$request->remarks;

      $order->created_by= Auth::id();
      $order->updated_by=Auth::id();
        if($order->save())
        {

            $customer = new RecruitCustomer();
            $customer->store($request,$order);
            if ($request->hasFile('img_url'))
            {
                foreach ($request->img_url as $key => $file) {

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

                    $order_file = new Order_file();
                    $order_file->recruit_order_id = $order->id;
                    $order_file->title = $title;
                    $order_file->img_url = $fileName;
                    $order_file->save();
                }

                if (isset($request->submit)){
                    return Redirect::route('order')->withInput()->with('alert.status', 'success')
                        ->with('alert.message', 'Recruiting Order Created successfully!');
                }else{

                    return Redirect::route('customer_information_edit',$order->paxid)->withInput()->with('alert.status', 'success')
                        ->with('alert.message', 'Recruiting Order Created successfully!');
                }


            } else {


                return back()->withInput()->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be Created.');
            }

        }
    }


    public function edit($id)
    {
        $order = Recruitorder::find($id);


        $customer =  Contact::all();
        $package = Item::all();
        $registerserial = Visa::all();
        $invoice = Invoice::all();
        return view('order::order.edit',compact('customer','package','registerserial','invoice','order'));
    }

    public function update(Request $request, $id)
    {
        try{

            $validator = Validator::make($request->all(), [
                'passenger_name' => 'required',
                'gender' => 'required',
                'customer_id' => 'required',
                'issue_date' => 'required',
                'passportNumber' => 'required',
                'visa_type' => 'required',
            ]);

            if ($validator->fails()) {
                return redirect::back()->withErrors($validator);
            }

            if ($request->registerSerial_id)
            {
                $order_count = count(Recruitorder::where('registerSerial_id', $request->registerSerial_id)->get());
                $number_visa = Visa::where('id', $request->registerSerial_id)->first();
                if ($number_visa->numberofVisa <= $order_count)
                {
                    return back()->withInput()->with('alert.status', 'danger')
                        ->with('alert.message', 'Sorry, This Visa is not available.');
                }
            }

            $order =  Recruitorder::find($id);
            $order->customer_id= $request->customer_id;
            $order->package_id=$request->package_id;
            $order->registerSerial_id=$request->registerSerial_id?$request->registerSerial_id:null;
            $order->paxid=$request->paxid;
            $order->passportNumber=$request->passportNumber;
//            $order->passportNumberbn=$request->passportNumberbn;
            $order->placeofissue=$request->placeofissue;
            $order->passportDate=isset($request->order_date)?$request->order_date:"";
            $order->passportissuedate=$request->issue_date;
            $order->salesRate=$request->salesRate;
            $order->invoice_id=$request->invoice_id? $request->invoice_id:null;
            $order->order_status=$request->order_status?$request->order_status:0;
            $order->substitued_order=$request->substitued_order;
            $order->passenger_name=$request->passenger_name;
            $order->agent_commission_amount=$request->agent_commission_amount;
            $order->commission_type=$request->commission_type;
            $order->visa_type=$request->visa_type;
            $order->visa_category_id=$request->visa_type==1?3:null;
            $order->remarks=$request->remarks;
            $order->updated_by=Auth::id();
            if ($order->save())
            {
                $customer = new RecruitCustomer();
                $customer->store($request,$order);
                if($request->hasFile('img_url'))
                {
                    foreach($request->img_url as $key=>$file)
                    {
                        $index= substr($key, 0, 3 );
                        if ($index =='old')
                        {
                            $fileName = uniqid() . 'st.' . $file->getClientOriginalName();
                            $file->move(public_path('all_image'), $fileName);
                            $id=explode('_',$key)[1];
                            $entry=Order_file::find($id);
                            $image_path = public_path("all_image/$entry->img_url");
                            $entry->title=$request->title[$key];
                            $entry->img_url=$fileName;
                            if ($entry->save())
                            {
                                if(file_exists($image_path))
                                {
                                    unlink($image_path);
                                }
                            }

                        }
                        else
                        {

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
                            $visa_entry = new Order_file();
                            $visa_entry->recruit_order_id = $order->id;
                            $visa_entry->title = $title;
                            $visa_entry->img_url = $fileName;
                            $visa_entry->save();
                        }
                    }

                    return Redirect::route('order')->withInput()->with('alert.status', 'success')
                        ->with('alert.message', 'Recruiting Order Updated successfully!');
                }else{
                  if($request->img_id)
                  {
                      $t=Order_file::whereNotIn('id', $request->img_id)->get();
                      foreach ($t as $value)
                      {
                          $image_path = public_path("all_image/$value->img_url");
                          if ($value->delete())
                          {
                              if(file_exists($image_path))
                              {
                                  unlink($image_path);
                              }
                          }
                      }
                  }
                    return Redirect::route('order')->withInput()->with('alert.status', 'success')
                                                   ->with('alert.message', 'Recruiting Order Updated successfully!');
                }
            }
            else {
                return back()->withInput()->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be Deleted.');
            }

        }catch (\Exception $e){


            return back()->withInput()->with('alert.status','danger')->with('alert.message', 'Sorry, something went wrong! Data cannot be update.');
        }

    }


    public function delete($id)
    {
        $order = Recruitorder::find($id);

        if(!$order->invoice_id)
        {
            $order->delete();

            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Recruiting Order deleted.');
        }else
        {
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'You have an invoice attached with this entry . Please delete invoice first');
        }

    }
	
	public function pdf()
	{
		$pdf = PDF::loadView('order::form.index');
           return $pdf->download('invoice.pdf');
		
	}
    public function archiveIndex(){
        $order = Recruitorder::where('status',0)->get();
        return view('order::order.archive_index')->with('order',$order);
    }

	public function archive($id){

        $order = Recruitorder::find($id);
        $order->status=0;
        $order->save();

        return Redirect::route('order_archive_index')->with('msg','Order sent to Archive');
    }

    public function archiveBack($id){

        $order = Recruitorder::find($id);
        $order->status=1;
        $order->save();

        return Redirect::route('order')->with('msg','Archive sent to Order ');
    }




}
