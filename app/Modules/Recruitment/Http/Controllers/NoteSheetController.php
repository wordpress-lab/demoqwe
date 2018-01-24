<?php

namespace App\Modules\Recruitment\Http\Controllers;

use App\Models\Formbasis\Formbasis;
use App\Models\Recruit\Note_sheet;
use App\Models\Recruit\Note_sheet_pax;
use App\Models\Recruit\Recruitorder;
use Carbon\Carbon;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use mPDF;

class NoteSheetController extends Controller
{
    public function index(){


        $note= DB::select("SELECT GROUP_CONCAT(recruitingorder.paxid) as id,note_sheet.applicationDate,note_sheet_pax.note_sheet_id FROM note_sheet JOIN note_sheet_pax on note_sheet.id= note_sheet_pax.note_sheet_id JOIN recruitingorder ON recruitingorder.id= note_sheet_pax.recruit_id GROUP BY note_sheet_pax.note_sheet_id");
           //dd($note);

        return view('recruitment::note_sheet.index',compact('note'));

    }


    public function create(){

        $order=Recruitorder::all();
        return view('recruitment::note_sheet.create',compact('order'));
    }

    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'applicationDate' => 'required',
            'countryGender' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $input = Input::all();
        $condition = $input['recruit_id'];

        $note=new Note_sheet();


        $note->countryGender=$request->countryGender;
        $note->applicationDate=$request->applicationDate;
        $note->sourceIncomeTax=$request->sourceIncomeTax;
        $note->welfareFee=$request->welfareFee;
        $note->payOrderNumber=$request->payOrderNumber;
        $note->chalanNumber=$request->chalanNumber;
        $note->infoAttestation=$request->infoAttestation;
        $note->payOrderDate=$request->payOrderDate;
        $note->chalanDate=$request->chalanDate;
        $note->certificateAttestation=$request->certificateAttestation;
        $note->payOrderAmount=$request->payOrderAmount;
        $note->chalanAmount=$request->chalanAmount;
        $note->created_by=Auth::user()->id;
        $note->updated_by=Auth::user()->id;
        if ($note->save()) {

            $id=$note->id;

            foreach ($request->recruit_id as $key=>$condition) {

                if(is_array($request->brifing[$key])){
                    $brif=array_keys($request->brifing[$key])[0];
                    $brife= $request->brifing[$key][$brif];
                }else{
                    $brife= $request->brifing[$key] ;
                }

                if(is_array($request->comment[$key])){
                    $com=array_keys($request->comment[$key])[0];
                    $comment= $request->comment[$key][$com];
                }else{
                    $comment= $request->comment[$key] ;
                }

                $data=array(
                'brifing'=>$brife,
                'comment'=>$comment,
                'recruit_id' => $condition,
                'note_sheet_id' => $id,
                'created_by' => Auth::user()->id,
                'updated_by' => Auth::user()->id,
                );
             Note_sheet_pax::insert($data);

            }
            return Redirect::route('note_sheet_index')->with('msg', 'Data Inserted');
        }

    }


    public function edit($id){
        $order=Recruitorder::all();

        $note=Note_sheet::find($id);

        //dd($note);

        $immipax=Note_sheet_pax::where('note_sheet_id',$id)->get();
        //dd($immipax);

        return view('recruitment::note_sheet.edit',compact('order','note','immipax'));
    }



    public function update(Request $request,$id){

        $validator = Validator::make($request->all(), [
            'applicationDate' => 'required',
            'countryGender' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect::back()->withErrors($validator);
        }

        $input = Input::all();
        $condition = $input['recruit_id'];

        $note=Note_sheet::find($id);

        $note->countryGender=$request->countryGender;
        $note->applicationDate=$request->applicationDate;
        $note->sourceIncomeTax=$request->sourceIncomeTax;
        $note->welfareFee=$request->welfareFee;
        $note->payOrderNumber=$request->payOrderNumber;
        $note->chalanNumber=$request->chalanNumber;
        $note->infoAttestation=$request->infoAttestation;
        $note->payOrderDate=$request->payOrderDate;
        $note->chalanDate=$request->chalanDate;
        $note->certificateAttestation=$request->certificateAttestation;
        $note->payOrderAmount=$request->payOrderAmount;
        $note->chalanAmount=$request->chalanAmount;
        $note->created_by=Auth::user()->id;
        $note->updated_by=Auth::user()->id;

        if ($note->save()) {
            $delete = Note_sheet_pax::where('note_sheet_id',$id)->delete();

            $id=$note->id;

            foreach ($request->recruit_id as $key=>$cond) {

                if(is_array($request->brifing[$key])){
                    $brif=array_keys($request->brifing[$key])[0];
                    $brife= $request->brifing[$key][$brif];
                }else{
                    $brife= $request->brifing[$key] ;
                }

                if(is_array($request->comment[$key])){
                    $com=array_keys($request->comment[$key])[0];
                    $comment= $request->comment[$key][$com];
                }else{
                    $comment= $request->comment[$key] ;
                }

                $data=array(
                    'brifing'=>$brife,
                    'comment'=>$comment,
                    'recruit_id' => $cond,
                    'note_sheet_id' => $id
                );
                Note_sheet_pax::insert($data);

            }
            return Redirect::route('note_sheet_index')->with('msg', 'Data Updated');
        }

    }


    public function delete($id){

        $note=Note_sheet::find($id);

        if ($note->delete()){

            $delete = Note_sheet_pax::where('note_sheet_id',$id)->delete();
        }

        return Redirect::route('note_sheet_index')->with('del', 'Data Deleted');
    }





    public function download($id){

        $note2=Note_sheet::find($id);
        $formbasis=Formbasis::first();

        $note=DB::select("SELECT note_sheet.*,note_sheet_pax.*,contact.display_name,recruitingorder.passportNumber,recruitingorder.passenger_name,visaentrys.visaNumber,recruit_customer.visaAdvice,recruit_customer.professionEn,company.name,company.salary,company.mealallowance,company.airtransport FROM note_sheet_pax JOIN note_sheet ON note_sheet_pax.note_sheet_id= note_sheet.id JOIN recruitingorder ON note_sheet_pax.recruit_id= recruitingorder.id JOIN visaentrys ON recruitingorder.registerSerial_id= visaentrys.id JOIN recruit_customer ON note_sheet_pax.recruit_id= recruit_customer.recruit_id JOIN company ON visaentrys.company_id= company.id JOIN contact ON recruitingorder.customer_id= contact.id");

        $css = public_path().'/css/bootstrap.min.css';

        $bootstrap = file_get_contents($css);

        $view =  view('recruitment::note_sheet.note_sheet',compact('note','note2','formbasis','bootstrap'));
        $mpdf = new mPDF('format' , 'Legal');
        $mpdf->WriteHTML($view);
        $mpdf->Output('Note-sheet-'.Carbon::now().'.pdf','I');
    }



}
