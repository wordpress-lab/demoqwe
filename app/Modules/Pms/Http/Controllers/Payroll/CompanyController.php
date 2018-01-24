<?php

namespace App\Modules\Pms\Http\Controllers\Payroll;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Validator;

//Models
use App\Models\Pms\PmsCompany;
use Auth;

class CompanyController extends Controller
{
    public function index()
    {
        $company = PmsCompany::all();

        return view('pms::Company.index' , compact('company'));
    }

    public function create()
    {
        return view('pms::Company.create');
    }

    public function store(Request $request)
    {
        $inputdata =[
            'name_en' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $fileName = null;
        if ($request->hasFile('logo_url')){
            $file= $request->logo_url;
            $fileName=uniqid(). '.' .$file->getClientOriginalName();
            $file->move(public_path('uploads/company-logo'), $fileName);
        }


        $input = $request->all();

        $user = Auth::id();

        $insert = new PmsCompany;

        $insert->name_en                = $input['name_en'];
        $insert->name_ar                = $input['name_ar'];
        $insert->logo_url               = $fileName;
        $insert->bank_name              = $input['bank_name'];
        $insert->account_name           = $input['account_name'];
        $insert->account_number         = $input['account_number'];
        $insert->iban                   = $input['iban'];
        $insert->person_name            = $input['person_name'];
        $insert->person_contact         = $input['person_contact'];
        $insert->address_en             = $input['address_en'];
        $insert->address_ar             = $input['address_ar'];
        $insert->bank_name              = $input['bank_name'];
        $insert->email                  = $input['email'];
        $insert->created_by             = $user;
        $insert->updated_by             = $user;

        $insert->save();

        return Redirect::route('pms_payroll_company_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Pms Payroll Company Inserted Successfully!');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $company = PmsCompany::find($id);

        return view('pms::Company.edit' , compact('company'));
    }

    public function update(Request $request, $id)
    {
        $inputdata =[
            'name_en' => 'required'
        ];
        
        $validator = Validator::make($request->all(), $inputdata);
        if ($validator->fails())
        {
            return back()->withErrors($validator)->withInput();
        }

        $insert = PmsCompany::find($id);

        $fileName = $insert->logo_url;

        if ($request->hasFile('logo_url')){

            $image_path = asset("uploads/company-logo/$insert->logo_url");

            if(file_exists($image_path))
            {
                unlink($image_path);
            }

            $file= $request->logo_url;
            $fileName=uniqid(). '.' .$file->getClientOriginalName();
            $file->move(public_path('uploads/company-logo'), $fileName);
        }


        $input = $request->all();

        $user = Auth::id();

        $insert->name_en                = $input['name_en'];
        $insert->name_ar                = $input['name_ar'];
        $insert->logo_url               = $fileName;
        $insert->bank_name              = $input['bank_name'];
        $insert->account_name           = $input['account_name'];
        $insert->account_number         = $input['account_number'];
        $insert->iban                   = $input['iban'];
        $insert->person_name            = $input['person_name'];
        $insert->person_contact         = $input['person_contact'];
        $insert->address_en             = $input['address_en'];
        $insert->address_ar             = $input['address_ar'];
        $insert->bank_name              = $input['bank_name'];
        $insert->email                  = $input['email'];
        $insert->updated_by             = $user;

        $insert->update();

        return Redirect::route('pms_payroll_company_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Pms Payroll Company Updated Successfully!');
    }

    public function destroy($id)
    {
        $delete = PmsCompany::find($id);

        $image_path = asset("uploads/company-logo/$delete->logo_url");

        if(file_exists($image_path))
        {
            unlink($image_path);
        }

        if($delete->delete()){
            return back()->with(['alert.status' => 'danger','alert.message' => 'Pms Payroll Company Deleted Successfully!']);
        }
        else{
            return back()->with(['alert.status' => 'danger','alert.message' => 'Pms Payroll Company Deleted Fail!']);
        }
    }
}
