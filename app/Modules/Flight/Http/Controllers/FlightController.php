<?php

namespace App\Modules\Flight\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\Contact\Contact;
use App\Models\Flight\Flight;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Recruit\Recruitorder;
use Barryvdh\DomPDF\Facade as PDF;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class FlightController extends Controller
{
    public function index($id=null){

        $id=$id;

        if (is_null($id))
        {
            if (session('branch_id')==1){
                $branch=Branch::all();
                $recruit = Recruitorder::all();
                return view('flight::flight.index',compact('id','branch','recruit'));
            }
            else {

                $branch=Branch::where('id',session('branch_id'))->get();
                $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                    ->where('users.branch_id',session('branch_id'))
                    ->select('recruitingorder.*')
                    ->get();
                return view('flight::flight.index',compact('id','branch','recruit'));
            }
        }
        else {

            $branch=Branch::all();
            $recruit = Recruitorder::join('users','recruitingorder.created_by','=','users.id')
                ->where('users.branch_id',$id)
                ->select('recruitingorder.*')
                ->get();
            return view('flight::flight.index',compact('id','branch','recruit'));

        }
    }

    public function create(){

        $order = DB::table("recruitingorder")->select('*')
            ->whereNOTIn('id',function($query){
                $query->select('paxid')->from('flight');
            })
            ->get();

        $vendor=Contact::all();
        return view('flight::flight.create',compact('order','vendor','flight'));

    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'paxid' => 'required',
            'carrierName' => 'required',
            'flightDate' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $input = Input::all();
        $condition = $input['paxid'];

        foreach ($condition as $cond) {

            $flight = new Flight();
            $flight->carrierName = $input['carrierName'];
            $flight->flightDate = $input['flightDate'];
            $flight->country = $input['country'];
            $flight->comment = $input['comment'];
            $flight->vendor_id = $input['vendor_id']? $input['vendor_id']:null;
            $flight->paxid = $cond;
            $flight->created_by =Auth::user()->id ;
            $flight->updated_by =Auth::user()->id ;
            $flight->save();
        }
        return Redirect::route('flight_index')->with('create','Flight Created');
    }

    public function edit($id){

        $flight=Flight::all();
        $recruit=Recruitorder::find($id);
        $order=Recruitorder::all();
        $vendor=Contact::all();
        return view('flight::flight.edit',compact('flight','order','vendor','recruit'));
    }

    public function update(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'paxid' => 'required',
            'carrierName' => 'required',
            'flightDate' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $input = Input::all();
        $condition = $input['paxid'];

        foreach ($condition as $cond) {

            $flight=Flight::find($id);
            $flight->carrierName = $input['carrierName'];
            $flight->flightDate = $input['flightDate'];
            $flight->country = $input['country'];
            $flight->comment = $input['comment'];
            $flight->vendor_id = $input['vendor_id']? $input['vendor_id']:null;
            $flight->paxid = $cond;
            $flight->created_by =Auth::user()->id ;
            $flight->updated_by =Auth::user()->id ;
            $flight->save();
        }

        return Redirect::route('flight_index')->with('create','Flight Updated');
    }

    public function delete($id){

        $company=Flight::find($id);
        $company->delete();
        return Redirect::route('flight_index')->with('delete','Manpower Deleted');
    }

    public function flightcard($id=null)
    {
        try{
            $count=Flight::where('paxid',$id)->count();
            if(is_null($id))
            {
               throw new \Exception("Pax not found");
            }
            if(!$count)
            {
                throw new \Exception("Pax not Exist");
            }
            //Ensure the MBString PHP extension is enabled
            $OrganizationProfile = OrganizationProfile::find(1);
            $flightcard= Flight::where('paxid',$id)->get()->last();
            $pdf = PDF::loadView('flight::pdf.flightcard',compact('flightcard','OrganizationProfile'));
            $filename = "flight_card ".Carbon::now().".pdf";
            return $pdf->stream($filename);
        }catch(\Exception $e){
            $msg = $e->getMessage();
            return back()->with('alert.message',"$msg")->with('alert.status','warning');
        }


    }
}
