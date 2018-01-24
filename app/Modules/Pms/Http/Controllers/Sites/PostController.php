<?php

namespace App\Modules\Pms\Http\Controllers\Sites;

use Illuminate\Support\Facades\Redirect;
use App\Models\Pms\Pms_Site;
use App\Modules\Pms\Http\Response\SitesResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Response;

class PostController extends Controller
{
    public function index()
    {
        $sites = Pms_Site::with("employees")->get();
        return view('pms::Sites.index', compact('sites'));
    }
    public function create()
    {
        $sites=[];
        return view('pms::Sites.create', compact('sites'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'company_name' => 'required',
            'address' => 'required',
            'contact_person' => 'required',
            'contact_number' => 'required',

        ]);
     try{
         $newsite = new SitesResponse();
         $uploadedfile= $newsite->upload($request);


         $new=$newsite->store($request,$uploadedfile);
         if(!$new){
             throw new \Exception();
         }
         return Redirect::route('pms_sites_index')->withInput()->with('alert.status', 'success')
             ->with('alert.message', 'Site  added successfully!');
     }catch (\Exception $exception){

         return back()->withInput()->with('alert.status', 'danger')
             ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
     }
    }
    public function edit($id)
    {
        $site=Pms_Site::find($id);
        if(!$site){
            abort(404);
        }
        return view('pms::Sites.edit', compact('site'));
    }
    public function update(Request $request,$id)
    {

        $this->validate($request, [
            'company_name' => 'required',
            'address' => 'required',
            'contact_person' => 'required',
            'contact_number' => 'required',

        ]);
        try{
            $site = Pms_Site::find($id);
            $newsite = new SitesResponse();
            $uploadedfile= $newsite->uploadUpdate($site,$request);

            $update=$newsite->update($site,$request,$uploadedfile);
            if(!$update){
                throw new \Exception();
            }
            return Redirect::route('pms_sites_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Site  updated successfully!');
        }catch (\Exception $exception){

            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
        }
    }
   public function destroy($id)
   {


       try{
           if(empty($id)|| is_null($id)){
               throw new \Exception();
           }
           $site=Pms_Site::find($id);

           if($site->employees->count()){
               throw new \Exception();
           }
           $site->delete();
           return Redirect::route('pms_sites_index')->withInput()->with('alert.status', 'success')
               ->with('alert.message', 'Site  deleted successfully!');
       }catch(\Exception $exception){
           return back()->with('alert.status', 'danger')
               ->with('alert.message', 'Sorry, site has employees! Data cannot be deleted.');
       }

   }
    public function download($id)
    {
        try{
            if(is_null($id))
            {
                throw new Exception("This file is not available");
            }
            $file = Pms_Site::find($id);
            if(empty($file["contact_paper_url"]))
            {
                throw new Exception("This file is not available");
            }

            if (filter_var($file["contact_paper_url"], FILTER_VALIDATE_URL) === true) {
                return redirect($file["contact_paper_url"]);
            }
            $path = public_path($file["contact_paper_url"]);
            $mime = mime_content_type($path);
            if($mime=="application/msword")
            {
                return Response::download($path);
            }
            return Response::make(file_get_contents($path), 200, [
                'Content-Type' => $mime,
                'Content-Disposition' => 'inline; filename="'.$file["company_name"].'"'
            ]);
        }catch (\Exception $exception){
            $msg=  $exception->getMessage();
            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "Sorry, $msg.");
        }
    }
}
