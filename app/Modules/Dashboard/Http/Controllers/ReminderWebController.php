<?php

namespace App\Modules\Dashboard\Http\Controllers;

use App\Models\Deshboard\Reminder;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;


class ReminderWebController extends Controller
{

    public function index(Request $request)
    {

        try{
            $reminder = new Reminder();
            $reminder->reminddatetime = $request->date. " ".$request->time;
            $reminder->note = $request->note;
            $reminder->created_by = Auth::id();
            $reminder->updated_by = Auth::id();
            if ($reminder->save()) {
                return "200";
            } else {
                return "500";
            }
        }catch (\Illuminate\Database\QueryException $ex){
            return "500";
        }



    }

    public function All(){
        return Reminder::where('created_by',Auth::id())->orderBy('id', 'DESC')->take(50)->get();
    }

    public function destroy($id){

        $rem = Reminder::find($id);

        if($rem->delete()){
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Note deleted.');
        }else{
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be Deleted.');
        }
    }
}