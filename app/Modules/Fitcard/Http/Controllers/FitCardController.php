<?php

namespace App\Modules\Fitcard\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\Fitcard\Fit_Card;
use App\Models\Fitcard\Fit_Card_File;
use App\Models\Recruit\Recruitorder;
use App\Models\Mofa\Mofa;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

use App\Models\OrganizationProfile\OrganizationProfile;
use mPDF;


class FitCardController extends Controller
{

    public function fitcard_download($id)
    {
        try{
            if(is_null($id))
            {
                throw new \Exception("This file is not available");
            }
            $file = Fit_Card_File::find($id);
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
        $completed = Fit_Card::whereNotNull('receive_date')
                                    ->join('recruitingorder' , 'recruitingorder.id' , '=' ,'fit_card.pax_id')
                                    ->where('recruitingorder.status' , 1)
                                    ->count();

        $left_temp = Recruitorder::where('status' , 1)->count();

        $left = $left_temp - $completed;

        if(isset($request->all)){
            $count = $request->id;
            if (is_null($id))
            {
                if (session('branch_id')==1){
                    $branch=Branch::all();
                    if($request->today){
                        $recruit = Recruitorder::join("fit_card","recruitingorder.id","fit_card.pax_id")
                                                ->whereDate('fit_card.created_at' , date("Y-m-d"))
                                                ->select("recruitingorder.*")
                                                ->get();
                    }
                    else
                    {
                        $recruit = Recruitorder::leftjoin("mofas","mofas.pax_id","recruitingorder.id")
                                            ->where('recruitingorder.status' , 1)
                                            ->where('mofas.status' , 1)
                                            ->select("recruitingorder.*")
                                            ->get();
                    }
                    return view('fitcard::fit_card.index',compact('id','branch','recruit','completed','left','count'));
                }
                else {

                    $branch=Branch::where('id',session('branch_id'))->get();
                    $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                        ->where('users.branch_id',session('branch_id'))
                        ->where('recruitingorder.status',1)
                        ->select('recruitingorder.*')
                        ->get();
                    return view('fitcard::fit_card.index',compact('id','branch','recruit','completed','left','count'));
                }
            }
            else {

                $branch=Branch::all();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->where('users.branch_id',$id)
                    ->where('recruitingorder.status',1)
                    ->select('recruitingorder.*')
                    ->get();
                return view('fitcard::fit_card.index',compact('id','branch','recruit','completed','left','count'));

            }
        }
        else{
            if (is_null($id))
            {
                if (session('branch_id')==1){
                    $branch=Branch::all();
                    if($request->today){
                        $recruit = Recruitorder::join("fit_card","recruitingorder.id","fit_card.pax_id")
                                                ->leftjoin('police_clearances','police_clearances.paxid','recruitingorder.id')
                                                ->whereNull('police_clearances.submission_date')
                                                ->whereDate('fit_card.created_at' , date("Y-m-d"))
                                                ->select("recruitingorder.*")
                                                ->get();
                    }
                    else
                    {
                        $recruit = Recruitorder::leftjoin('police_clearances','police_clearances.paxid','recruitingorder.id')
                                                ->whereNull('police_clearances.submission_date')
                                                ->where('recruitingorder.status' , 1)
                                                ->leftjoin("mofas","mofas.pax_id","recruitingorder.id")
                                                ->where('mofas.status' , 1)
                                                ->select("recruitingorder.*")
                                                ->get();
                    }
                    $count = count($recruit);
                    return view('fitcard::fit_card.index',compact('id','branch','recruit','completed','left','count'));
                }
                else {

                    $branch=Branch::where('id',session('branch_id'))->get();
                    $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                        ->leftjoin('police_clearances','police_clearances.paxid','recruitingorder.id')
                        ->whereNull('police_clearances.submission_date')
                        ->where('users.branch_id',session('branch_id'))
                        ->where('recruitingorder.status',1)
                        ->select('recruitingorder.*')
                        ->get();
                    $count = count($recruit);
                    return view('fitcard::fit_card.index',compact('id','branch','recruit','completed','left','count'));
                }
            }
            else {

                $branch=Branch::all();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->leftjoin('police_clearances','police_clearances.paxid','recruitingorder.id')
                    ->whereNull('police_clearances.submission_date')
                    ->where('users.branch_id',$id)
                    ->where('recruitingorder.status',1)
                    ->select('recruitingorder.*')
                    ->get();
                $count = count($recruit);
                return view('fitcard::fit_card.index',compact('id','branch','recruit','completed','left','count'));

            }
        }
        
    }


    public function create($id)
    {
        $order = Recruitorder::all();
        $mofa = Mofa::where('pax_id' , $id)->first();

        if(($mofa == Null) || ($mofa->status == 0)){
            return back()->with(['alert.message' => 'Mofa Status is not ok' , 'alert.status' => 'danger']);
        }
        return view('fitcard::fit_card.create',compact('order','id'));
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'fit_card_date' => 'required',
            'img_url' => 'required',
            'receive_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        try{

            $fit_card = new Fit_Card();
            $fit_card->pax_id =$request->pax_id;
            $fit_card->fit_card_date =$request->fit_card_date;
            $fit_card->receive_date =$request->receive_date;
            $fit_card->created_by = Auth::id();
            $fit_card->updated_by = Auth::id();


            if( $fit_card->save())
            {
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

                        $visa_entry=new Fit_Card_File();
                        $visa_entry->fit_card_id=$fit_card->id;
                        $visa_entry->title=$title;
                        $visa_entry->img_url=$fileName;
                        $visa_entry->save();
                    }

                    return Redirect::route('fit_card')->withInput()->with('alert.status', 'success')
                        ->with('alert.message', 'Fit Card added successfully!');
                }

            }else{
                return back()->withInput()->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }
        }catch (\Exception $exception){
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
        }

    }


    public function edit($id)
    {
        $recruit=Recruitorder::find($id);
        $order=Recruitorder::all();
        $fit_card = Fit_Card::find($id);

        foreach ($order as $value){
            if ($value->id==$fit_card->pax_id){
                return view('fitcard::fit_card.edit',compact('recruit','order','fit_card'));
            }
        }
        return Redirect::route('fit_card_create');
    }


    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'fit_card_date' => 'required',
            'receive_date' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }
        
        try{
            $fit_Card = Fit_Card::find($id);
            $fit_Card->pax_id =$request->pax_id;
            $fit_Card->fit_card_date =$request->fit_card_date;
            $fit_Card->receive_date =$request->receive_date;
            $fit_Card->updated_by = Auth::id();
            if( $fit_Card->save())
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
                            $entry=Fit_Card_File::find($id);
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

                            $visa_entry = new Fit_Card_File();
                            $visa_entry->fit_card_id = $fit_Card->id;
                            $visa_entry->title = $title;
                            $visa_entry->img_url = $fileName;
                            $visa_entry->save();
                        }
                    }

                    return Redirect::route('fit_card')->withInput()->with('alert.status', 'success')
                        ->with('alert.message', 'Fit Card updated successfully!');
                }else{

                    $t=Fit_Card_File::whereNotIn('id', $request->img_id)->get();

                    foreach ($t as $value){

                        $image_path = public_path("all_image/$value->img_url");

                        if ( $value->delete()){
                            if(file_exists($image_path))
                            {
                                unlink($image_path);
                            }
                        }
                    }
                    return Redirect::route('fit_card')->withInput()->with('alert.status', 'success')
                        ->with('alert.message', 'Fit Card updated successfully!');
                }

            }else
            {
                return back()->withInput()->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }
        }catch (\Exception $exception){
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
        }

    }

    public function delete($id)
    {
        $mofa= Fit_Card::find($id);
        $mofa->delete();
        return back()->withInput()->with('alert.status', 'danger')
            ->with('alert.message', 'Fit Card deleted.');
    }

    public function pdf()
    {
        $OrganizationProfile = OrganizationProfile::first();
        $mpdf = new mPDF('utf-8', 'A4');
        $view =  view('fitcard::fit_card.fitcard_pdf',compact('OrganizationProfile'));
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }
}
