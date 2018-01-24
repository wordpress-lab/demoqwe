<?php

namespace App\Modules\Pms\Http\Controllers\Employees;

use App\Models\Pms\Pms_Employee;
use App\Models\Pms\Pms_Site;
use App\Modules\Pms\Http\Response\EmployeeResponse;
use Exception;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    public function index()
    {
        $employees = Pms_Employee::with("site")->get();
        return view('pms::Employees.index', compact('employees'));
    }

    public function newCode()
    {
        $generate_code = Pms_Employee::max("code_name");

        if(!$generate_code){
            return str_pad($generate_code+1,6,0,STR_PAD_LEFT);
        }
        if(is_numeric($generate_code))
        {
            return  str_pad($generate_code+1,6,0,STR_PAD_LEFT);
        }

        if(is_string($generate_code)){
            $newgenerate_code=str_pad($generate_code,6,0,STR_PAD_LEFT);
        }
        return $newgenerate_code."1";
    }
    public function newCodeave(Request $request)
    {
        $generate_code_check = Pms_Employee::where("code_name",trim($request->code_name))->count();
        return $generate_code_check;
    }
    public function create()
    {
        $generate_code = $this->newCode();
        $sites =  Pms_Site::all();
        return view('pms::Employees.create', compact('sites','generate_code'));
    }
    public function store(Request $request)
    {

        $this->validate($request, [
            'code_name' => 'required',
            'date_of_birth' => 'required',
            'father_name' => 'required',
            'name' => 'required',
        ]);


        try{
            if($this->newCodeave($request)){
            throw new \Exception("Code is not unique. try another");
            }
            $emp = new EmployeeResponse();
            $photo =  $emp->photoUpload($request);
            $passport =  $emp->passportUpload($request);
            $iqama =  $emp->iqamaUpload($request);
            $emp->store($request,$iqama,$passport,$photo);
            return Redirect::route('pms_employees_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Employee  store successfully!');
        }catch(\Exception $exception){

            $msg =  $exception->getMessage();
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "Sorry, something went wrong! Data cannot be saved. $msg");
        }

    }
    public function edit($id)
    {
        $employee=Pms_Employee::find($id);
        $sites =  Pms_Site::all();
        return view('pms::Employees.edit', compact('employee','sites'));
    }
    public function update(Request $request,$id)
    {
        $this->validate($request, [

            'date_of_birth' => 'required',
            'father_name' => 'required',
            'name' => 'required',


        ]);
        try{
            if(is_null($id)){
                throw new Exception();
            }

            $emprow =  Pms_Employee::find($id);
            $emp = new EmployeeResponse();
            $photo =  $emp->photoUploadUpdate($emprow,$request);
            $passport =  $emp->passportUploadUpdate($emprow,$request);
            $iqama =  $emp->iqamaUploadUpdate($emprow,$request);
            $emp->update($emprow,$request,$iqama,$passport,$photo);
            return Redirect::route('pms_employees_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Employee  updated successfully!');
        }catch (Exception $exception){

            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
        }
        dd($request->all());
    }

    public function destroy($id)
    {


        try{
            if(empty($id)|| is_null($id))
            {
                throw new Exception();
            }
            $emp=Pms_Employee::find($id);
            if(!$emp){
                throw new Exception();
            }
            if($emp->site_name || count($emp->site_name)){
                throw new Exception();
            }
            $emp->delete();
            return Redirect::route('pms_employees_index')->with('alert.status', 'success')
                ->with('alert.message', 'Employee deleted successfully!');
        }catch(\Exception $exception){
            return back()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, site has employees! Data cannot be deleted.');
        }

    }
    public function download($id,$file_type=null)
    {
        try{
            if(is_null($id) || is_null($file_type))
            {
                throw new Exception("This file is not available");
            }

            $file = Pms_Employee::find($id);
            $path = $this->validateFile($file,$file_type);
            $mime = mime_content_type($path);
            if($mime=="application/msword")
            {
                return Response::download($path);
            }

            return Response::make(file_get_contents($path), 200, [
                'Content-Type' => $mime,
                'Content-Disposition' => 'inline; filename="'.$file["code_name"].'"'
            ]);
        }catch(\Exception $exception){

            $msg=  $exception->getMessage();

            return back()->with('alert.status', 'danger')
                                      ->with('alert.message', "Sorry, $msg.");
        }
    }

    public function validateFile($file,$file_type)
    {
        $type_list =  ["iqama_url"=>"iqama_url","passport_url"=>"passport_url","photo_url"=>"photo_url"];
        $type = array_search($file_type, $type_list);
        if(!$file){
            throw new Exception("This file is not available");
        }
        if(empty($file[$type]))
        {
            throw new Exception("This file is not available");
        }

        return public_path($file[$type]);
    }
}
