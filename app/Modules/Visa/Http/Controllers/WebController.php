<?php

namespace App\Modules\Visa\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\Company\Company;
use App\Models\Contact\Contact;
use App\Models\MoneyOut\Bill;
use App\Models\Visa\Visa;
use App\Models\Visa\Visa_Entry_File;
use App\Models\Recruit\Recruitorder;
use App\Modules\Visa\Http\Requests\CreatePostRequest;
use App\Modules\Visa\Http\Requests\UpdatePostRequest;

use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class WebController extends Controller
  {

    public function Visa_Entry_File($id)
    {
        try{
            if(is_null($id))
            {
                throw new Exception("This file is not available");
            }
            $file = Visa_Entry_File::find($id);
            if(!$file)
            {
                throw new Exception("This file is not available");
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
        }catch (Exception $exception){

            $msg=  $exception->getMessage();
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "Sorry, $msg.");
        }
    }
       public function index(Request $request,$id=null)
        {
          $total_visa = Visa::sum('numberofVisa');
          $assigned_visa = Recruitorder::whereNotNull('registerSerial_id')
                                        ->count();

          $left = $total_visa - $assigned_visa;

          if(is_null($id))
           {
               if (session('branch_id')==1){

                   $branch=Branch::all();


                  $visa = Visa::all();

                   foreach($visa as $all)
                   {
                       $recruit = Recruitorder::where('registerSerial_id' , $all->id)->count('id');
                       $all->left_visa = ($all->numberofVisa - $recruit);

                   }



                   if($request->today)
                   {

                       $visa = $visa->filter(function ($value, $key) {
                           return $value->left_visa !=0;
                       });

                       $visa->all();

                   }
                   return view('visa::visa.index', compact('visa','branch','id','total_visa','assigned_visa','left'));
               }
               else {

                   $branch=Branch::where('id',session('branch_id'))->get();
                   $visa = Visa::join('users','visaentrys.created_by','=','users.id')
                       ->where('users.branch_id',session('branch_id'))
                       ->select('visaentrys.*')
                       ->get();
                    
                    foreach($visa as $all){
                      $recruit = Recruitorder::where('registerSerial_id' , $all->id)->count('id');
                      $all->left_visa = ($all->numberofVisa - $recruit);
                     }
                   return view('visa::visa.index', compact('visa','branch','id','total_visa','assigned_visa','left'));
               }
           }
           else {

               $branch=Branch::all();
               $visa = Visa::join('users','visaentrys.created_by','=','users.id')
                   ->where('users.branch_id',$id)
                   ->select('visaentrys.*')
                   ->get();

                foreach($visa as $all)
                {
                    $recruit = Recruitorder::where('registerSerial_id' , $all->id)->count('id');
                    $all->left_visa = ($all->numberofVisa - $recruit);
                }

               return view('visa::visa.index', compact('visa','branch','id','total_visa','assigned_visa','left'));
           }
        }

      public function create()
      {
            $contact = Contact::all();
            $company = Company::all();
            $bill = Bill::all();

            return view('visa::visa.create')->with(array('contact'=>$contact,'company'=>$company,'bill'=>$bill));
      }
      public function leftvisa($request)
      {

          if($request->okala_cancellation>$request->numberofvisa)
          {

              throw new Exception();
          }
          return true;
      }
      public function store(CreatePostRequest $request)
      {

         try
         {
             $cancel = !empty($request->okala_cancellation)?$request->okala_cancellation:0;

             $this->leftvisa($request);
             $visa =  new Visa();
             $visa->date = $request->visa_date;
             $visa->local_Reference=$request->local_ref;
             $visa->visaNumber=$request->visa_number;
             $visa->visaIssuedate=$request->issue_date;
             $visa->company_id=$request->company_name;
             $visa->numberofVisa = $request->numberofvisa - floor($cancel);
             $visa->okala_cancellation=floor($request->okala_cancellation);
             $visa->destination=$request->destination;
             $visa->registerSerial=$request->registerSerial;
             $visa->idNum=$request->flag_num;
             $visa->purchaseRate=$request->purchaseRate;
             $visa->iqamaNumber= $request->iqamaNumber?$request->iqamaNumber:Null;
             $visa->iqamaSector=$request->iqamaSector?$request->iqamaSector:Null;
             $visa->visaType=$request->visaType?$request->visaType:Null;
             $visa->expire_date = $request->expire_date;
             $visa->created_by= Auth::id();
             $visa->updated_by=Auth::id();


             if($visa->save())
             {


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

                        $fileName=uniqid().$file->getClientOriginalName();
                        $file->move(public_path('all_image'), $fileName);

                        $visa_entry=new Visa_Entry_File();
                        $visa_entry->visaentrys_id=$visa->id;
                        $visa_entry->title=$title;
                        $visa_entry->img_url=$fileName;
                        $visa_entry->save();
                    }


                     return Redirect::route('visa')->withInput()->with('alert.status', 'success')
                         ->with('alert.message', 'Visa  added successfully!');
                 }

             }else{

                throw new Exception();
            }
            }catch(\Exception $e){



             return back()->withInput()->with('alert.status', 'danger')
                 ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
         }

       }


    public function edit($id)
    {

        $visa = Visa::find($id);
        $contact = Contact::all();
        $company = Company::all();

        $recruit = Recruitorder::where('registerSerial_id' , $id)->count('id');
        // by raj
        $visa->left_visa = ($visa->numberofVisa - $recruit);
        return view('visa::visa.edit')->with(array('contact'=>$contact,'company'=>$company,'visa'=>$visa));

    }

    public function update(UpdatePostRequest $request,$id)
    {


        try{
            $visa = Visa::find($id);
            $old_okala_cancal = empty($request->old_cancel_okala)?0:$request->old_cancel_okala;
            $okala_cancellation=empty($request->okala_cancellation)?0:$request->okala_cancellation;

            $visa->date                 = $request->visa_date;
            $visa->local_Reference      = $request->local_ref;
            $visa->visaNumber           = $request->visa_number;
            $visa->visaIssuedate        = $request->issue_date;
            $visa->company_id           = $request->company_name;

            $visa->okala_cancellation   = floor($okala_cancellation)+$old_okala_cancal;
            $visa->numberofVisa         = $request->numberofvisa - floor($okala_cancellation);
            $visa->destination          = $request->destination;
            $visa->registerSerial       = $request->registerSerial;
            $visa->idNum                = $request->flag_num;
            $visa->purchaseRate         = $request->purchaseRate;
            $visa->iqamaNumber          = $request->iqamaNumber?$request->iqamaNumber:Null;
            $visa->iqamaSector          = $request->iqamaSector?$request->iqamaSector:Null;
            $visa->visaType             = $request->visaType?$request->visaType:Null;
            $visa->expire_date          = $request->expire_date;
            $visa->updated_by           = Auth::id();
            if ($visa->save())
            {
                if($request->hasFile('img_url'))
                {
                    foreach ($request->img_url as $key=>$file)
                    {
                       $index= substr($key, 0, 3 );
                        if ($index =='old')
                        {
                            $fileName = uniqid() . 'st.' . $file->getClientOriginalName();
                            $file->move(public_path('all_image'), $fileName);

                            $id=explode('_',$key)[1];
                            $entry=Visa_Entry_File::find($id);
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

                            $fileName = uniqid().$file->getClientOriginalName();
                            $file->move(public_path('all_image'), $fileName);

                            $visa_entry = new Visa_Entry_File();
                            $visa_entry->visaentrys_id = $visa->id;
                            $visa_entry->title = $title;
                            $visa_entry->img_url = $fileName;
                            $visa_entry->save();
                        }
                    }
                    return Redirect::route('visa')->withInput()->with('alert.status', 'success')
                        ->with('alert.message', 'Visa  updated successfully!');
                }
                else
               {
                     if(is_array($request->img_id))
                     {
                         $t=Visa_Entry_File::whereNotIn('id',$request->img_id)->get();
                         foreach ($t as $value)
                         {
                             $image_path = public_path("all_image/$value->img_url");
                             if($value->delete())
                             {
                                 if(file_exists($image_path))
                                 {
                                     unlink($image_path);
                                 }
                             }
                         }
                     }
             return Redirect::route('visa')->withInput()->with('alert.status','success')->with('alert.message', 'Visa  updated successfully!');
                }
            }
            else
            {
            throw new Exception();
            }
          }catch (Exception $e){

            return back()->withInput()->with('alert.status','danger')->with('alert.message', 'Sorry, something went wrong! Data cannot be update.');
         }

    }
    public function delete($id =null)
      {
         try{
           $visa = Visa::find($id);
           $Recruitorder=Recruitorder::where('registerSerial_id',$id)->first();
           if($Recruitorder){
               return back()->withInput()->with('alert.status', 'danger')
                   ->with('alert.message', 'You have order attached with this visa');
           }
           if(!$visa->bill_id)
             {
                 if ( $visa->delete()){
                     $t=Visa_Entry_File::where('visaentrys_id',$id)->get();
                     foreach ($t as $value){

                         $image_path = public_path("all_image/$value->img_url");

                         if ( $value->delete()){
                             if(file_exists($image_path))
                             {
                                 unlink($image_path);
                             }
                         }
                     }

                 return back()->withInput()->with('alert.status', 'danger')
                     ->with('alert.message', 'Visa deleted.');
                  }

             }else
             {
                 return back()->withInput()->with('alert.status', 'alert')
                              ->with('alert.message', 'You have a bill attached with this entry . Please delete bill first');
             }
          }catch (Exception $e)
           {
                 return back()->withInput()->with('alert.status', 'alert')
                              ->with('alert.message', 'You have a bill attached with this entry . Please delete bill first');
           }
       }

      public function contact(){

        $contact = Contact::all();
        return response($contact);
      }

      public function pdf($id){

          echo base64_decode($id);
      }

  }


