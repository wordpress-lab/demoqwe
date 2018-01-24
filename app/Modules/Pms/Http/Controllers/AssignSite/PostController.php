<?php

namespace App\Modules\Pms\Http\Controllers\AssignSite;

use App\Models\Pms\Pms_Employee;
use App\Models\Pms\Pms_Site;
use App\Modules\Pms\Http\Response\SiteAssignResponse;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;

class PostController extends Controller
{
    public function index()
    {
        $sites = Pms_Employee::where("site_name","!=",'')->orwhere("site_name","!=",null)->with("site")->get();

        return view('pms::AssignSite.index', compact('sites'));
    }

    public function create()
    {
        $emp = Pms_Employee::all();
        $sites = Pms_Site::all();

        return view('pms::AssignSite.create', compact('sites','emp'));
    }

    public function store(Request $request)
    {
      $updatemp = new SiteAssignResponse();
      try{
        $update=$updatemp->store($request);
          return Redirect::route('pms_assign_sites_index')->withInput()->with('alert.status', 'success')
              ->with('alert.message', 'Employees assign to site successfully!');
      }catch (\Exception $exception){
          $msg =  $exception->getMessage();
          return back()->withInput()->with('alert.status', 'danger')
              ->with('alert.message', "Sorry, something went wrong! site cannot be assign. $msg");
      }
    }
    public function edit($id)
    {
        $emp = Pms_Employee::find($id);
        $sites = Pms_Site::all();

        return view('pms::AssignSite.edit', compact('sites','emp'));
    }

    public function update(Request $request,$id)
    {
        $updatemp = new SiteAssignResponse();
        try{
            $emp = Pms_Employee::find($id);

            if(!$emp){
                throw new \Exception();
            }

            $update=$updatemp->update($emp,$request);
            return Redirect::route('pms_assign_sites_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Employees assign to site successfully!');
        }catch (\Exception $exception){


            $msg =  $exception->getMessage();

            return back()->withInput()->with('alert.status', 'danger')
                ->with('alert.message', "Sorry, something went wrong! site cannot be assign. $msg");
        }
    }

    public function destroy($id)
    {
        $updatemp = new SiteAssignResponse();
        try{
            if(empty($id)|| is_null($id))
            {
                throw new Exception();
            }
            $emp=Pms_Employee::find($id);
            if(!$emp){
                throw new Exception();
            }

            $updatemp->remove($emp);
            return Redirect::route('pms_assign_sites_index')->with('alert.status', 'success')
                ->with('alert.message', 'Employee deleted successfully!');
        }catch(\Exception $exception){
            return back()->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, site has employees! Data cannot be deleted.');
        }
    }
}
