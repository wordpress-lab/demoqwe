<?php

namespace App\Modules\Pms\Http\Controllers\Payroll;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

use mPDF;

//Models
use App\Models\Pms\PmsSector;
use App\Models\OrganizationProfile\OrganizationProfile;
use Auth;

class SectorsController extends Controller
{
    public function index()
    {
        $sectors = PmsSector::all();

        return view('pms::Sectors.index' , compact('sectors'));
    }

    public function create()
    {
        return view('pms::Sectors.create');
    }

    public function store(Request $request)
    {
        $input = $request->all();

        $insert = new PmsSector;

        $insert->type             = $input['type'];
        $insert->name             = $input['name'];

        $insert->save();

        return Redirect::route('pms_sectors_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Sectors Inserted Successfully!');

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $sector = PmsSector::find($id);

        return view('pms::Sectors.edit' , compact('sector'));
    }

    public function update(Request $request, $id)
    {
        $input = $request->all();

        $insert = PmsSector::find($id);

        $insert->type             = $input['type'];
        $insert->name             = $input['name'];

        $insert->update();

        return Redirect::route('pms_sectors_index')->withInput()->with('alert.status', 'success')
                ->with('alert.message', 'Sectors Updated Successfully!');
    }

    public function destroy($id)
    {

       if($id==1||$id==2)
       {
           return back()->with(['alert.status' => 'danger','alert.message' => 'Sectors can not be delete!']);
       }
       $delete = PmsSector::find($id);
       if($delete->required == 1){
            return back()->withInput()->with(['alert.status' => 'danger','alert.message' => 'Sectors Deleted Fail!']);
        }
        else{
            $delete->delete();
            
            return back()->withInput()->with(['alert.status' => 'success','alert.message' => 'Sectors Deleted Successfully!']);
        }
    }

    public function pdf()
    {
        $OrganizationProfile = OrganizationProfile::first();
        return view('pms::Sectors.pdf' , compact('OrganizationProfile'));
    }

    public function payrollPdf()
    {
        $mpdf = new mPDF('utf-8', 'A4-L');
        $view =  view('pms::Sectors.pdf2' , compact('OrganizationProfile'));
        $mpdf->WriteHTML($view);
        $mpdf->Output();
        
    }
}
