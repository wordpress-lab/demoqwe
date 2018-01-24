<?php

namespace App\Modules\Deletemodule\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Models\ModuleDelete\ModuleDelete;
use App\Models\AccessLevel\Modules;

class ModuleDeleteController extends Controller
{
    public function index()
    {
        return view('deletemodule::delete_module.index');
    }
 
    public function create()
    {
        //
    }
  
    public function store(Request $request)
    {
        //
    }
 
    public function show($id)
    {
        //
    }
    
    public function edit($id)
    {
        //
    }
    
    public function update(Request $request)
    {
        if($request->ticketing == 1)
        {
            $module = Modules::whereBetween('id' , [24,29])->delete();

            $update = ModuleDelete::find(1);

            $update->status = 0;
            $update->update();

            $directory1 = app_path('Modules/Settings/Http/Controllers/Order');
            $directory2 = app_path('Modules/Settings/Http/Controllers/ticket');
            $directory3 = app_path('Modules/Settings/Resources/Views/dashboard');
            $directory4 = app_path('Modules/Settings/Resources/Views/order');
            $directory5 = app_path('Modules/Settings/Resources/Views/ticket');
            $directory6 = app_path('Modules/Settings/Resources/Views/ticket_bill');
            
            File::deleteDirectory($directory1);
            File::deleteDirectory($directory2);
            File::deleteDirectory($directory3);
            File::deleteDirectory($directory4);
            File::deleteDirectory($directory5);
            File::deleteDirectory($directory6);

        }

        if($request->manpower == 1)
        {
            $update = ModuleDelete::find(2);

            $update->status = 0;
            $update->update();

            $directory1 = app_path('Modules/Manpowerservice');
            
            File::deleteDirectory($directory1);

        }

        if($request->recruit == 1)
        {
            $module = Modules::whereBetween('id' , [30,76])->delete();

            $update = ModuleDelete::find(3);

            $update->status = 0;
            $update->update();

            $directory1 = app_path('Modules/Recruitdashboard');
            $directory2 = app_path('Modules/Company');
            $directory3 = app_path('Modules/Visa');
            $directory4 = app_path('Modules/Visastamp');
            $directory5 = app_path('Modules/Order');
            $directory6 = app_path('Modules/Customer');
            $directory7 = app_path('Modules/Okala');
            $directory8 = app_path('Modules/Medicalslip');
            $directory9 = app_path('Modules/Mofa');
            $directory10 = app_path('Modules/Musaned');
            $directory11 = app_path('Modules/Fingerprint');
            $directory12 = app_path('Modules/Flight');
            $directory13 = app_path('Modules/Document');
            $directory14 = app_path('Modules/Recruitment');
            $directory15 = app_path('Modules/Recrutereport');
            $directory16 = app_path('Modules/Manpower');
            $directory17 = app_path('Modules/Fitcard');
            $directory18 = app_path('Modules/Policeclearance');
            $directory19 = app_path('Modules/Stampingapproval');
            $directory20 = app_path('Modules/Training');
            $directory21 = app_path('Modules/Completion');
            $directory22 = app_path('Modules/Flightnew');
            $directory23 = app_path('Modules/Iqama');
            $directory24 = app_path('Modules/Kafala');
            $directory25 = app_path('Modules/Settlement');

            
            File::deleteDirectory($directory1);
            File::deleteDirectory($directory2);
            File::deleteDirectory($directory3);
            File::deleteDirectory($directory4);
            File::deleteDirectory($directory5);
            File::deleteDirectory($directory6);
            File::deleteDirectory($directory7);
            File::deleteDirectory($directory8);
            File::deleteDirectory($directory9);
            File::deleteDirectory($directory10);
            File::deleteDirectory($directory11);
            File::deleteDirectory($directory12);
            File::deleteDirectory($directory13);
            File::deleteDirectory($directory14);
            File::deleteDirectory($directory15);
            File::deleteDirectory($directory16);
            File::deleteDirectory($directory17);
            File::deleteDirectory($directory18);
            File::deleteDirectory($directory19);
            File::deleteDirectory($directory20);
            File::deleteDirectory($directory21);
            File::deleteDirectory($directory22);
            File::deleteDirectory($directory23);
            File::deleteDirectory($directory24);
            File::deleteDirectory($directory25);

        }

        if($request->hazz == 1)
        {
            $update = ModuleDelete::find(4);

            $update->status = 0;
            $update->update();

            $directory1 = app_path('Modules/Hajj');
            
            File::deleteDirectory($directory1);

        }

        if($request->umrah == 1)
        {
            $update = ModuleDelete::find(5);

            $update->status = 0;
            $update->update();

            $directory1 = app_path('Modules/Umrah');
            
            File::deleteDirectory($directory1);

        }

        if($request->hrm == 1)
        {
            $update = ModuleDelete::find(6);

            $update->status = 0;
            $update->update();

            $directory1 = app_path('Modules/Hrm');
            
            File::deleteDirectory($directory1);

        }

        if($request->pms == 1)
        {
            $update = ModuleDelete::find(7);

            $update->status = 0;
            $update->update();

            $directory1 = app_path('Modules/Pms');
            
            File::deleteDirectory($directory1);

        }

        return back()->with('message' , 'Module Deleted Successfully');
        
    }

    public function destroy($id)
    {
        //
    }
}
