<?php

namespace App\Modules\Settings\Http\Controllers\invoice;

use App\Models\OrganizationProfile\OrganizationProfile;
use App\Models\Template\HeaderTemplate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class HeaderController extends Controller
{
    public function edit()
    {
        try{
            $op = HeaderTemplate::count();
            if($op){
                $op = HeaderTemplate::latest()->first();
                return view('settings::invoice.header.edit', compact('op'));

            }else{

                $op =  new HeaderTemplate();
                $op->file_url = "uploads/template/banner.jpg";
                $op->headerType = 1;
                $op->save();
                return view('settings::invoice.header.edit', compact('op'));
            }
        }catch (\Exception $exception){
            return redirect()
                ->route('organization_profile')->with('alert.status', 'danger')
              ->with('alert.message', $exception);
        }



    }

    public function update(Request $request)
    {
        $op_data = $request->all();

        $op = HeaderTemplate::where('id',$op_data['id'])->first();
        $op->headerType   = $op_data['active'];
        if($request->hasFile('logo'))
        {
            $image = $request->file('logo');

            $image_name = 'banner';
            $extension = $image->getClientOriginalExtension();
            $new_image_name = $image_name.'.png';
            $path = 'uploads/template';

            $success = $image->move($path,$new_image_name);

            if($success)
            {
                $op->file_url = $path."/".$new_image_name;

                if($op->save())
                {
                    return redirect()
                        ->route('organization_invoice_header')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Template Header Type Updated Successfully!');
                }
                else
                {
                    return redirect()
                        ->route('organization_invoice_header')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Sorry, something went wrong! Template Header Type cannot update!');
                }
            }
            else
            {
                return redirect()
                    ->route('organization_invoice_header')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Template Header Type cannot update!');
            }
        }
        else
        {
            $path = 'uploads/template';
            $op->file_url = $path."/".'banner.png';

            if($op->save())
            {
                return redirect()
                    ->route('organization_invoice_header')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Template Header Type Profile Updated Successfully!');
            }
            else
            {
                return redirect()
                    ->route('organization_invoice_header')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Template Header Type cannot update!');
            }
        }

    }
}
