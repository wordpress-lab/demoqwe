<?php

namespace App\Modules\Fingerprint\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\Fingerprint\Fingerprint;
use App\Models\Recruit\Recruitorder;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\Fingerprint\FingerPrintFile;
use App\Models\VisaStamp\VisaStamp;
use DB;

class FingerprintController extends Controller
{
    public function fingerprint_file_download($id)
    {
        try{
            if(is_null($id))
            {
                throw new \Exception("This file is not available");
            }
            $file = FingerPrintFile::find($id);
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
        $completed = Fingerprint::where('bmet_status', 1)
                                            ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'fingerprint.paxid')
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
                        $recruit = Recruitorder::join("fingerprint","fingerprint.paxid","recruitingorder.id")
                                                 ->whereDate('fingerprint.created_at' , date("Y-m-d"))
                                                 ->get();
                    }
                    else
                    {

                        $recruit = Recruitorder::where('status' , 1)
                                                 ->where('registerSerial_id' , '!=' , Null)
                                                 ->get();
                                                 
                    }

                    return view('fingerprint::fingerprint.index',compact('id','branch','recruit','completed','left','count'));
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
                        return view('fingerprint::fingerprint.index',compact('id','branch','recruit','completed','left','count'));
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
                return view('fingerprint::fingerprint.index',compact('id','branch','recruit','completed','left','count'));

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
                        $recruit = Recruitorder::join("fingerprint","fingerprint.paxid","recruitingorder.id")
                                                ->leftjoin('trainings','trainings.paxid','recruitingorder.id')
                                                ->whereNull('trainings.number')
                                                ->whereDate('fingerprint.created_at' , date("Y-m-d"))
                                                ->get();
                    }
                    else
                    {

                        $recruit = Recruitorder::leftjoin('trainings','trainings.paxid','recruitingorder.id')
                                                ->whereNull('trainings.number')
                                                ->where('status' , 1)
                                                ->where('registerSerial_id' , '!=' , Null)
                                                ->select('recruitingorder.*')
                                                ->get();
                    }
                    $count = count($recruit);
                    return view('fingerprint::fingerprint.index',compact('id','branch','recruit','completed','left','count'));
                }
                else
                {

                        $branch=Branch::where('id',session('branch_id'))->get();
                        $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                                                ->leftjoin('trainings','trainings.paxid','recruitingorder.id')
                                                ->whereNull('trainings.number')
                                                ->where('users.branch_id',session('branch_id'))
                                                ->where('recruitingorder.status',1)
                                                ->where('recruitingorder.registerSerial_id' , '!=' , Null)
                                                ->select('recruitingorder.*')
                                                ->get();
                                                
                        $count = count($recruit);                
                        return view('fingerprint::fingerprint.index',compact('id','branch','recruit','completed','left','count'));
                }
            }
            else
            {

                $branch=Branch::all();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->leftjoin('trainings','trainings.paxid','recruitingorder.id')
                    ->whereNull('trainings.number')
                    ->where('users.branch_id',$id)
                    ->where('recruitingorder.status',1)
                    ->where('recruitingorder.registerSerial_id' , '!=' , Null)
                    ->select('recruitingorder.*')
                    ->get();
                $count = count($recruit);
                return view('fingerprint::fingerprint.index',compact('id','branch','recruit','completed','left','count'));

            }
        }
        
    }

    public function create($id)
    {
        $order=Recruitorder::find($id);
        $visa = VisaStamp::where('pax_id' , $id)->first();
        if(($visa == Null) || ($visa->return_date == Null ))
        {
            return back()->with(['alert.message' => 'Visa stamping return date does not exists' , 'alert.status' => 'danger']);
        }
        return view('fingerprint::fingerprint.create',compact('order'));
    }

    public function store(Request $request,$id){

        $date = date('Y-m-d', strtotime($request->date));
        
        $result=new Fingerprint();
        $result->date                       = $date;
        $result->number                     = $request->number;
        $result->bmet_status                = $request->bmet_status;
        $result->comment                    = $request->comment;
        $result->paxid                      = $id;
        $result->created_by                 = Auth::user()->id;
        $result->updated_by                 = Auth::user()->id;

        if($result->save()){

            if ($request->hasFile('img_url')){
                    foreach ($request->img_url as $key=>$file){

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

                        $visa_entry=new FingerPrintFile();
                        $visa_entry->fingerprint_id=$result->id;
                        $visa_entry->title=$title;
                        $visa_entry->img_url=$fileName;
                        $visa_entry->save();
                    }


                     return Redirect::route('fingerprint_index')->withInput()->with('alert.status', 'success')
                         ->with('alert.message', 'Finger Print  added successfully!');
                 }
        }

        else{
                 return back()->withInput()->with('alert.status', 'danger')
                     ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }

        //return Redirect::route('fingerprint_index')->with('create','Finger print Created');

    }

    public function edit($id)
    {
        $recruit=Recruitorder::find($id);
        $order=Recruitorder::all();
        $finger=Fingerprint::all();
        foreach ($finger as $value){
            if ($value->paxid==$recruit->id){
                return view('fingerprint::fingerprint.edit',compact('finger','order','recruit'));
            }
        }

        return Redirect::route('fingerprint_create',$id);

    }

    public function update(Request $request,$id){

        $date = date('Y-m-d', strtotime($request->date));

        $result=Fingerprint::find($id);
        $result->date                       = $date;
        $result->number                     = $request->number;
        $result->bmet_status                = $request->bmet_status;
        $result->comment                    = $request->comment;
        $result->updated_by                 = Auth::user()->id;

        if($result->update())
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
                            $entry=FingerPrintFile::find($id);
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

                            $visa_entry = new FingerPrintFile();
                            $visa_entry->fingerprint_id = $result->id;
                            $visa_entry->title = $title;
                            $visa_entry->img_url = $fileName;
                            $visa_entry->save();
                        }
                    }

                    return Redirect::route('fingerprint_index')->withInput()->with('alert.status', 'success')
                        ->with('alert.message', 'Finger print  added successfully!');
                }else{
                    if($request->img_id){
                    $t=FingerPrintFile::whereNotIn('id', $request->img_id)->get();

                    foreach ($t as $value){

                        $image_path = public_path("all_image/$value->img_url");

                       if ( $value->delete()){
                           if(file_exists($image_path))
                           {
                               unlink($image_path);
                           }
                       }
                    }
                    return Redirect::route('fingerprint_index')->withInput()->with('alert.status','success')->with('alert.message', 'Finger print updated successfully!');
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

    public function delete($id)
    {
        $company=Fingerprint::find($id);
        $company->delete();
        return Redirect::route('fingerprint_index')->with('delete','Finger print Deleted');

    }


}
