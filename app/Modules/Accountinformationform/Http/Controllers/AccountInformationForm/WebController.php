<?php

namespace App\Modules\Accountinformationform\Http\Controllers\AccountInformationForm;

use App\Models\Branch\Branch;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;

use Barryvdh\DomPDF\Facade as PDF;

//Models
use App\Models\Inventory\Item;
use App\Models\AccountInformationForm\AccountInformationForm;
use App\Models\OrganizationProfile\OrganizationProfile;
use Illuminate\Support\Facades\DB;

class WebController extends Controller
{
    public function index()
    {
        $auth_id = Auth::id();
        $information= [];
        $branch_id = session('branch_id');
        $branchs = Branch::orderBy('id','asc')->get();
        $condition = "YEAR(str_to_date(account_information_forms.created_at,'%Y-%m-%d')) = YEAR(CURDATE()) AND MONTH(str_to_date(account_information_forms.created_at,'%Y-%m-%d')) = MONTH(CURDATE())";

        if($branch_id==1){
            $information = AccountInformationForm::whereRaw($condition)->get();
        }else{
            $information = AccountInformationForm::whereRaw($condition)->select(DB::raw('account_information_forms.*'))->join('users','users.id','=','account_information_forms.created_by')->where('users.branch_id',$branch_id)->get();
        }

        return view('accountinformationform::accountInformationForm.index' , compact('information','branchs'));
    }

    public function search(Request $request)
    {

        $auth_id = Auth::id();
        $branch_id = session('branch_id');

        if(session('branch_id')==1)
        {
            $branch_id =  $request->branch_id?$request->branch_id:session('branch_id');
        }
        else
        {
            $branch_id = session('branch_id');
        }
        $from_date =  date('Y-m-d',strtotime($request->from_date));
        $to_date =  date('Y-m-d',strtotime($request->to_date));
        $condition = "str_to_date(account_information_forms.created_at, '%Y-%m-%d') between '$from_date' and '$to_date'";
        $branchs = Branch::orderBy('id','asc')->get();
        $information = [];
        if($branch_id==1){
            $information = AccountInformationForm::orderBy('account_information_forms.created_at','desc')->select(DB::raw('account_information_forms.*'))->whereRaw($condition)->get();

        }else{
            $information = AccountInformationForm::orderBy('account_information_forms.created_at','desc')->select(DB::raw('account_information_forms.*'))->whereRaw($condition)->join('users','users.id','=','account_information_forms.created_by')->where('users.branch_id',$branch_id)->get();

        }

        return view('accountinformationform::accountInformationForm.index' , compact('information','branchs','branch_id','from_date','to_date'));
    }

    public function create()
    {
        $item = Item::all();
        return view('accountinformationform::accountInformationForm.create' , compact('item'));
    }

    public function store(Request $request)
    {
        $information = new AccountInformationForm;

        $information->user_id                       = Auth::user()->id;

        $information->machine_model_no_1            = $request->machine_model_no_1;
        $information->machine_model_no_2            = $request->machine_model_no_2;
        $information->machine_part_no_1             = $request->machine_part_no_1;
        $information->machine_part_no_2             = $request->machine_part_no_2;
        $information->machine_serial_no_1           = $request->machine_serial_no_1;
        $information->machine_serial_no_2           = $request->machine_serial_no_2;
        $information->machine_quantity_1            = $request->machine_quantity_1;
        $information->machine_quantity_2            = $request->machine_quantity_2;
        $information->machine_warranty_1            = $request->machine_warranty_1;
        $information->machine_warranty_2            = $request->machine_warranty_2;
        $information->machine_unit_price_1          = $request->machine_unit_price_1;
        $information->machine_unit_price_2          = $request->machine_unit_price_2;

        $information->optional_model_no_1           = $request->optional_model_no_1;
        $information->optional_model_no_2           = $request->optional_model_no_2;
        $information->optional_part_no_1            = $request->optional_part_no_1;
        $information->optional_part_no_2            = $request->optional_part_no_2;
        $information->optional_serial_no_1          = $request->optional_serial_no_1;
        $information->optional_serial_no_2          = $request->optional_serial_no_2;
        $information->optional_quantity_1           = $request->optional_quantity_1;
        $information->optional_quantity_2           = $request->optional_quantity_2;
        $information->optional_warranty_1           = $request->optional_warranty_1;
        $information->optional_warranty_2           = $request->optional_warranty_2;
        $information->optional_unit_price_1         = $request->optional_unit_price_1;
        $information->optional_unit_price_2         = $request->optional_unit_price_2;

        $information->bill_date                     = $request->bill_date;
        $information->bill_amount                   = $request->bill_amount;
        $information->business_promotion_amount     = $request->business_promotion_amount;
        $information->bill_format                   = $request->bill_format;
        $information->customer_type                 = $request->customer_type;
        $information->price_type                    = $request->price_type;
        $information->billing_information_consignee = $request->billing_information_consignee;
        $information->billing_information__different_consignee = $request->billing_information__different_consignee;
        $information->payment_terms                 = $request->payment_terms;

        $information->purchaser_name                = $request->purchaser_name;
        $information->purchaser_telephone_number    = $request->purchaser_telephone_number;
        $information->purchaser_email_no            = $request->purchaser_email_no;
        $information->purchaser_designation         = $request->purchaser_designation;
        $information->purchaser_mobile_no           = $request->purchaser_mobile_no;
        $information->purchaser_fax_no              = $request->purchaser_fax_no;

        $information->charge_of_payment_name                = $request->charge_of_payment_name;
        $information->charge_of_payment_telephone_number    = $request->charge_of_payment_telephone_number;
        $information->charge_of_payment_email_no            = $request->charge_of_payment_email_no;
        $information->charge_of_payment_designation         = $request->charge_of_payment_designation;
        $information->charge_of_payment_mobile_no           = $request->charge_of_payment_mobile_no;
        $information->charge_of_payment_fax_no              = $request->charge_of_payment_fax_no;

        $information->visit_customer_permises               = $request->visit_customer_permises;
        $information->customer_occupying_permises           = $request->customer_occupying_permises;
        $information->neighbours_to_confirm_answer          = $request->neighbours_to_confirm_answer;
        $information->permises_rent                         = $request->permises_rent;
        $information->office_setup                          = $request->office_setup;
        $information->no_of_staff                           = $request->no_of_staff;
        $information->building_type                         = $request->building_type;
        $information->customer_get_contact                  = $request->customer_get_contact;
        $information->liase_with                            = $request->liase_with;
        $information->confident_of_payment                  = $request->confident_of_payment;
        $information->receive_purchase_order                = $request->receive_purchase_order;
        $information->delivery_product_before               = $request->delivery_product_before;
        $information->credit_days                           = $request->credit_days;

        $information->created_by                            = Auth::user()->id;
        $information->updated_by                            = Auth::user()->id;

        $information->save();

        return redirect('accountinformationform/')->with('message' , 'Information Insert Successfully');

    }

    public function show($id)
    {
        $information = AccountInformationForm::find($id);
        $all_info = AccountInformationForm::all();
        $item = Item::all();

        return view('accountinformationform::accountInformationForm.show' , compact('information' , 'all_info' , 'item'));
    }

    public function edit($id)
    {
        $information = AccountInformationForm::find($id);
        $all_info = AccountInformationForm::all();
        $item = Item::all();

        return view('accountinformationform::accountInformationForm.edit' , compact('information' , 'all_info' , 'item'));
    }

    public function update(Request $request, $id)
    {
        $information = AccountInformationForm::find($id);

        $information->machine_model_no_1            = $request->machine_model_no_1;
        $information->machine_model_no_2            = $request->machine_model_no_2;
        $information->machine_part_no_1             = $request->machine_part_no_1;
        $information->machine_part_no_2             = $request->machine_part_no_2;
        $information->machine_serial_no_1           = $request->machine_serial_no_1;
        $information->machine_serial_no_2           = $request->machine_serial_no_2;
        $information->machine_quantity_1            = $request->machine_quantity_1;
        $information->machine_quantity_2            = $request->machine_quantity_2;
        $information->machine_warranty_1            = $request->machine_warranty_1;
        $information->machine_warranty_2            = $request->machine_warranty_2;
        $information->machine_unit_price_1          = $request->machine_unit_price_1;
        $information->machine_unit_price_2          = $request->machine_unit_price_2;

        $information->optional_model_no_1           = $request->optional_model_no_1;
        $information->optional_model_no_2           = $request->optional_model_no_2;
        $information->optional_part_no_1            = $request->optional_part_no_1;
        $information->optional_part_no_2            = $request->optional_part_no_2;
        $information->optional_serial_no_1          = $request->optional_serial_no_1;
        $information->optional_serial_no_2          = $request->optional_serial_no_2;
        $information->optional_quantity_1           = $request->optional_quantity_1;
        $information->optional_quantity_2           = $request->optional_quantity_2;
        $information->optional_warranty_1           = $request->optional_warranty_1;
        $information->optional_warranty_2           = $request->optional_warranty_2;
        $information->optional_unit_price_1         = $request->optional_unit_price_1;
        $information->optional_unit_price_2         = $request->optional_unit_price_2;

        $information->bill_date                     = $request->bill_date;
        $information->bill_amount                   = $request->bill_amount;
        $information->business_promotion_amount     = $request->business_promotion_amount;
        $information->bill_format                   = $request->bill_format;
        $information->customer_type                 = $request->customer_type;
        $information->price_type                    = $request->price_type;
        $information->billing_information_consignee = $request->billing_information_consignee;
        $information->billing_information__different_consignee = $request->billing_information__different_consignee;
        $information->payment_terms                 = $request->payment_terms;

        $information->purchaser_name                = $request->purchaser_name;
        $information->purchaser_telephone_number    = $request->purchaser_telephone_number;
        $information->purchaser_email_no            = $request->purchaser_email_no;
        $information->purchaser_designation         = $request->purchaser_designation;
        $information->purchaser_mobile_no           = $request->purchaser_mobile_no;
        $information->purchaser_fax_no              = $request->purchaser_fax_no;

        $information->charge_of_payment_name                = $request->charge_of_payment_name;
        $information->charge_of_payment_telephone_number    = $request->charge_of_payment_telephone_number;
        $information->charge_of_payment_email_no            = $request->charge_of_payment_email_no;
        $information->charge_of_payment_designation         = $request->charge_of_payment_designation;
        $information->charge_of_payment_mobile_no           = $request->charge_of_payment_mobile_no;
        $information->charge_of_payment_fax_no              = $request->charge_of_payment_fax_no;

        $information->visit_customer_permises               = $request->visit_customer_permises;
        $information->customer_occupying_permises           = $request->customer_occupying_permises;
        $information->neighbours_to_confirm_answer          = $request->neighbours_to_confirm_answer;
        $information->permises_rent                         = $request->permises_rent;
        $information->office_setup                          = $request->office_setup;
        $information->no_of_staff                           = $request->no_of_staff;
        $information->building_type                         = $request->building_type;
        $information->customer_get_contact                  = $request->customer_get_contact;
        $information->liase_with                            = $request->liase_with;
        $information->confident_of_payment                  = $request->confident_of_payment;
        $information->receive_purchase_order                = $request->receive_purchase_order;
        $information->delivery_product_before               = $request->delivery_product_before;
        $information->credit_days                           = $request->credit_days;

        $information->updated_by                            = Auth::user()->id;

        $information->update();

        return back()->with('message' , 'Information Update Successfully');
    }

    public function destroy($id)
    {
        $information = AccountInformationForm::find($id);

        if($information->delete()){
            return back()->with('message' , 'Information Deleted Successfully');
        }
        else{
            return back()->with('message' , 'Information Update Failed');
        }
    }

    public function execuitive($id)
    {
        $executive = AccountInformationForm::find($id);

        return view('accountinformationform::accountInformationForm.executive' , compact('executive'));
    }

    public function execuitiveUpdate(Request $request,$id)
    {
        // $executive = AccountInformationForm::updateOrCreate([
        //     'id'    => $id,
        //     ],[
        //         'signature_of_executive' => $request->signature_of_executive,
        //         'executive_comment'      => $request->executive_comment,
        //         'updated_by'             => Auth::user()->id,
        //     ]);

        $executive = AccountInformationForm::find($id);

        if($executive->signature_of_executive == NULL)
        {
            $executive->signature_of_executive   = $request->signature_of_executive;
            $executive->executive_comment        = $request->executive_comment;
            $executive->updated_by               = Auth::user()->id;

            $executive->update();
        }
        else
        {
            $executive->signature_of_executive   = $request->signature_of_executive;
            $executive->executive_comment        = $request->executive_comment;
            $executive->updated_by               = Auth::user()->id;

            $executive->update();
        }

        return back()->with('message' , 'Executive Approval Successfully');
        
    }

    public function manager($id)
    {
        $manager = AccountInformationForm::find($id);

        return view('accountinformationform::accountInformationForm.manager' , compact('manager'));
    }

    public function managerUpdate(Request $request,$id)
    {
        // $manager = AccountInformationForm::updateOrCreate([
        //     'id'    => $id,
        //     ],[
        //         'signature_of_manager' => $request->signature_of_manager,
        //         'manager_comment'        => $request->manager_comment,
        //     ]);

        $executive = AccountInformationForm::find($id);

        if($executive->signature_of_manager == NULL)
        {
            $executive->signature_of_manager   = $request->signature_of_manager;
            $executive->manager_comment        = $request->manager_comment;
            $executive->updated_by             = Auth::user()->id;

            $executive->update();
        }
        else
        {
            $executive->signature_of_manager   = $request->signature_of_manager;
            $executive->manager_comment        = $request->manager_comment;
            $executive->updated_by             = Auth::user()->id;

            $executive->update();
        }
        
        return back()->with('message' , 'Manager Approval Successfully');
        
    }

    public function account($id)
    {
        $account = AccountInformationForm::find($id);

        return view('accountinformationform::accountInformationForm.account' , compact('account'));
    }

    public function accountUpdate(Request $request,$id)
    {
        // $account = AccountInformationForm::updateOrCreate([
        //     'id'    => $id,
        //     ],[
        //         'signature_of_account'      => $request->signature_of_account,
        //         'account_comment'           => $request->account_comment,
        //     ]);

        $executive = AccountInformationForm::find($id);

        if($executive->signature_of_account == NULL)
        {
            $executive->signature_of_account   = $request->signature_of_account;
            $executive->account_comment        = $request->account_comment;
            $executive->updated_by             = Auth::user()->id;

            $executive->update();
        }
        else
        {
            $executive->signature_of_account   = $request->signature_of_account;
            $executive->account_comment        = $request->account_comment;
            $executive->updated_by             = Auth::user()->id;

            $executive->update();
        }
        
        return back()->with('message' , 'Account Approval Successfully');
        
    }

    public function admin($id)
    {
        $admin = AccountInformationForm::find($id);

        return view('accountinformationform::accountInformationForm.admin' , compact('admin'));
    }

    public function adminUpdate(Request $request,$id)
    {
        // $admin = AccountInformationForm::updateOrCreate([
        //     'id'    => $id,
        //     ],[
        //         'signature_of_admin'      => $request->signature_of_admin,
        //         'admin_comment'           => $request->admin_comment,
        //     ]);

        $executive = AccountInformationForm::find($id);

        if($executive->signature_of_admin == NULL)
        {
            $executive->signature_of_admin   = $request->signature_of_admin;
            $executive->admin_comment        = $request->admin_comment;
            $executive->updated_by           = Auth::user()->id;

            $executive->update();
        }
        else
        {
            $executive->signature_of_admin   = $request->signature_of_admin;
            $executive->admin_comment        = $request->admin_comment;
            $executive->updated_by           = Auth::user()->id;

            $executive->update();
        }
        
        return back()->with('message' , 'Admin Approval Successfully');
        
    }

    public function director($id)
    {
        $director = AccountInformationForm::find($id);

        return view('accountinformationform::accountInformationForm.director' , compact('director'));
    }

    public function directorUpdate(Request $request,$id)
    {
        // $director = AccountInformationForm::updateOrCreate([
        //     'id'    => $id,
        //     ],[
        //         'signature_of_director'      => $request->signature_of_director,
        //         'director_comment'           => $request->director_comment,
        //     ]);

        $executive = AccountInformationForm::find($id);

        if($executive->signature_of_director == NULL)
        {
            $executive->signature_of_director   = $request->signature_of_director;
            $executive->director_comment        = $request->director_comment;
            $executive->updated_by              = Auth::user()->id;

            $executive->update();
        }
        else
        {
            $executive->signature_of_director   = $request->signature_of_director;
            $executive->director_comment        = $request->director_comment;
            $executive->updated_by              = Auth::user()->id;

            $executive->update();
        }
        
        return back()->with('message' , 'Director Approval Successfully');
        
    }

    public function officer($id)
    {
        $officer = AccountInformationForm::find($id);

        return view('accountinformationform::accountInformationForm.officer' , compact('officer'));
    }

    public function officerUpdate(Request $request,$id)
    {
        // $officer = AccountInformationForm::updateOrCreate([
        //     'id'    => $id,
        //     ],[
        //         'signature_of_billing_officer'      => $request->signature_of_billing_officer,
        //         'billing_officer_comment'           => $request->billing_officer_comment,
        //     ]);

        $executive = AccountInformationForm::find($id);

        if($executive->signature_of_billing_officer == NULL)
        {
            $executive->signature_of_billing_officer   = $request->signature_of_billing_officer;
            $executive->billing_officer_comment        = $request->billing_officer_comment;
            $executive->updated_by                     = Auth::user()->id;

            $executive->update();
        }
        else
        {
            $executive->signature_of_billing_officer   = $request->signature_of_billing_officer;
            $executive->billing_officer_comment        = $request->billing_officer_comment;
            $executive->updated_by                     = Auth::user()->id;

            $executive->update();
        }
        
        return back()->with('message' , 'Billing Officer Approval Successfully');
        
    }

    public function myAfi()
    {
        $information = AccountInformationForm::where('user_id' , Auth::user()->id)->get();
        return view('accountinformationform::accountInformationForm.my_afi' , compact('information'));
    }

    public function aifPdf($id){
        $information = AccountInformationForm::find($id);
        $profile = OrganizationProfile::first();
        $pdf = PDF::loadView('accountinformationform::accountInformationForm.aif_pdf',compact('information' , 'profile'));
        return $pdf->stream();
    }
}
