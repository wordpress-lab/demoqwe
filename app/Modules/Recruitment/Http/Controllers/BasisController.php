<?php

namespace App\Modules\Recruitment\Http\Controllers;

use App\Models\Formbasis\Formbasis;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BasisController extends Controller
{
    public function edit(){

        $basis=Formbasis::where('setting_id','formbasis')->count();

        if (!$basis){
                 $basis=new Formbasis();
                 $basis->setting_id='formbasis';
                 $basis->save();
                  return view('recruitment::formbasis.edit',compact('basis'));
        }else{

            $basis=Formbasis::where('setting_id','formbasis')->first();
             return view('recruitment::formbasis.edit',compact('basis'));

        }



           // return view('recruitment::formbasis.edit',compact('basis'));


    }

    public function update(Request $request,$id){

        $basis=Formbasis::find($id);
        $basis->companyNameEN=$request->companyNameEN;
        $basis->companyNameBN=$request->companyNameBN;
        $basis->ownerNameEN=$request->ownerNameEN;
        $basis->ownerNameBN=$request->ownerNameBN;
        $basis->addressEN=$request->addressEN;
        $basis->addressBN=$request->addressBN;
        $basis->licenceEN=$request->licenceEN;
        $basis->licenceBN=$request->licenceBN;
        $basis->ownerDesignationEN=$request->ownerDesignationEN;
        $basis->ownerDesignationBN=$request->ownerDesignationBN;
        $basis->update();

        return redirect()->back()->with('msg','Data updated');




    }
}
