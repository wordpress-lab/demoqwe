<?php

namespace App\Modules\Settings\Http\Controllers;

use Exception;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

//Models
use App\Models\OrganizationProfile\OrganizationProfile;

class OrganizationProfileWebController extends Controller
{
    public function edit()
    {
        $op = OrganizationProfile::find(1);

        return view('settings::organization_profile.edit', compact('op'));
    }

    public function update(Request $request)
    {
        $op_data = $request->all();

        $op = OrganizationProfile::find(1);

        $op->display_name   = $op_data['display_name'];
        $op->company_name   = $op_data['company_name'];
        $op->street         = $op_data['street'];
        $op->city           = $op_data['city'];
        $op->state          = $op_data['state'];
        $op->country        = $op_data['country'];
        $op->zip_code       = $op_data['zip_code'];
        $op->website        = $op_data['website'];
        $op->contact_number = $op_data['contact_number'];
        $op->email          = $op_data['email'];
        $op->etin          = $op_data['etin'];
        $op->vat_number          = $op_data['vat_number'];

        if($request->hasFile('logo'))
        {
            $image = $request->file('logo');

            $image_name = 'logo';
            $extension = $image->getClientOriginalExtension();
            $new_image_name = $image_name.'.png';
            $path = 'uploads/op-logo';

            $success = $image->move($path,$new_image_name);

            if($success)
            {
                $op->logo = $new_image_name;

                if($op->save())
                {
                    return redirect()
                        ->route('organization_profile')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Organization Profile Updated Successfully!');
                }
                else
                {
                    return redirect()
                        ->route('organization_profile')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Sorry, something went wrong! Organization profile cannot update!');
                }
            }
            else
            {
                return redirect()
                    ->route('user_create')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Organization profile cannot update!');
            }
        }
        else
        {
            $op->logo = 'logo.png';

            if($op->save())
            {
                return redirect()
                    ->route('organization_profile')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Organization Profile Updated Successfully!');
            }
            else
            {
                return redirect()
                    ->route('organization_profile')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Organization profile cannot update!');
            }
        }

    }
}
