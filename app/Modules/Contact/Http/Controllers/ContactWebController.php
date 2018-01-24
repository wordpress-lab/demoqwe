<?php

namespace App\Modules\Contact\Http\Controllers;


use App\Models\AccountChart\Account;
use App\Models\ManualJournal\JournalEntry;
use Exception;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

// Models
use App\Models\Contact\Contact;
use App\Models\Contact\ContactCategory;
use App\Models\Contact\Agent;
use App\Models\MoneyOut\Bill;
use App\Models\Moneyin\Invoice;
use App\Models\OrganizationProfile\OrganizationProfile;
use Illuminate\Support\Facades\DB;

class ContactWebController extends Controller
{
    public function index()
    {
        // $contacts = Contact::with("contactCategory")->get();
        // $agents = Agent::all();
        $contacts = [];
        $agents = [];
        $contactCategories = ContactCategory::all();
        return view('contact::contact.ajax.index', compact('contacts', 'contactCategories', 'agents'));
    }

    public function create()
    {
        $contact_categories = ContactCategory::all();
        return view('contact::contact.create', compact('contact_categories'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
             'display_name'      => 'required',
             'phone_number_1'    => 'unique:contact'
        ]);
        DB::beginTransaction();
        try
        {
            $data = $request->all();
            $user_id = Auth::user()->id;
            $contact = new Contact;
//            if($data['contact_category_id'] == 6)
//            {
//                $contact = new Agent;
//            }
//            else
//            {
//
//                $contact->contact_category_id = $data['contact_category_id'];
//                if($data['contact_category_id'] == 1 || $data['contact_category_id'] == 2)
//                {
//                    if($data['agent_id'])
//                    {
//                        $contact->agent_id            = $data['agent_id'];
//                    }
//                }
//            }

            if($request->hasFile('profile_picture'))
            {
                $file = $request->file('profile_picture');
                $file_name = $file->getClientOriginalName();
                $without_extention = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention = $file->getClientOriginalExtension();
                $num = rand(1,500);
                $new_file_name = $without_extention.$num.'.'.$file_extention;
                $success = $file->move('uploads/contact',$new_file_name);
                if($success)
                {
                    $contact->profile_pic_url = 'uploads/contact/'.$new_file_name;
                }
            }



            if($data['contact_category_id']==5)
            {
                $account = new Account();
                $account->account_name =$data['display_name'];
                $account->account_code =$data['display_name'];
                $account->account_type_id =5;
                $account->parent_account_type_id =1;
                $account->required_status =1;
                $account->created_by = $user_id;
                $account->updated_by = $user_id;
                $account->save();
            }
            $contact->first_name = $data['first_name'];
            $contact->last_name = $data['last_name'];
            $contact->display_name = $data['display_name'];
            $contact->company_name = $data['company_name'];
            $contact->email_address = $data['email_address'];
            $contact->skype_name = $data['skype_name'];
            $contact->phone_number_1 = $data['phone_number_1'];
            $contact->phone_number_2 = $data['phone_number_2'];
            $contact->phone_number_3 = $data['phone_number_3'];
            $contact->billing_street = $data['billing_street'];
            $contact->billing_city = $data['billing_city'];
            $contact->billing_state = $data['billing_state'];
            $contact->billing_zip_code = $data['billing_zip_code'];
            $contact->billing_country = $data['billing_country'];
            $contact->shipping_street = $data['shipping_street'];
            $contact->shipping_city = $data['shipping_city'];
            $contact->shipping_state = $data['shipping_state'];
            $contact->shipping_zip_code = $data['shipping_zip_code'];
            $contact->shipping_country = $data['shipping_country'];
            $contact->fb_id = $data['fb_id'];
            $contact->tw_id = $data['tw_id'];
            $contact->about = $data['about'];
            $contact->contact_category_id = $data['contact_category_id'];
            if($data['contact_category_id']!=6)
            {
                $contact->account_id = isset($account->id)?$account->id:null;
            }

            $contact->contact_status = 1;
            $contact->branch_id = 1;
            $contact->created_by = $user_id;
            $contact->updated_by = $user_id;
            if($contact->save())
            {
                DB::commit();
                return redirect()
                    ->route('contact')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Conatact added successfully!');
            }


            DB::rollBack();
            throw new \Exception("fail to add");

        }
        catch (Exception $e)
        {

            DB::rollBack();
            return redirect()
                ->route('contact')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
        }
    }

    public function show($id)
    {
        $contact = Contact::find($id);
        $contact_category = $contact->contactCategory->contact_category_name;
        return view('contact::contact.view', compact('contact', 'contact_category'));
    }

    public function showAgent($id)
    {
        $contact = Agent::find($id);
        $contact_category = "Agent";
        return view('contact::contact.view', compact('contact', 'contact_category'));
    }

    public function edit($id)
    {
        $contact = Contact::find($id);
        $contact_id = $id;
        $contact_categories = ContactCategory::all();
        $contact_category_id = Contact::find($id)->contactCategory->id;
        return view('contact::contact.edit', compact('contact', 'contact_categories', 'contact_category_id', 'contact_id'));
    }

    public function editAgent($id)
    {
        $contact = Agent::find($id);
        $contact_id = $id;
        $contact_categories = ContactCategory::all();
        $contact_category_id = 6;
        return view('contact::contact.edit', compact('contact', 'contact_categories', 'contact_category_id', 'contact_id'));
    }

    public function update(Request $request, $id)
    {
        $contact = Contact::find($id);

        if($request->phone_number_1 == $contact->phone_number_1){
            $this->validate($request, [
                'display_name'      => 'required',
            ]);
        }
        else{
            $this->validate($request, [
                'display_name'      => 'required',
                'phone_number_1'    => 'unique:contact'
            ]);
        }
        
        
        $data = $request->all();
        $created_by = $contact->created_by;
        $user_id = Auth::user()->id;

        if($contact['contact_category_id']==5){
            $contact->contact_category_id = 5;
        }
        else{
            $contact->contact_category_id = $data['contact_category_id'];
        }    
        try
        {

//            if($data['contact_category_id'] == 6)
//            {
//                $contact = Agent::find($id);
//            }
//            else
//            {
//
//                if(isset($data['agent_id']))
//                {
//                    if($data['agent_id'])
//                        $contact->agent_id            = $data['agent_id'];
//                }
//            }


            if($request->hasFile('profile_picture'))
            {
                if($contact->profile_pic_url)
                {
                    $delete_path = public_path($contact->profile_pic_url);
                    $delete = unlink($delete_path);
                }
                $file = $request->file('profile_picture');
                $file_name = $file->getClientOriginalName();
                $without_extention = substr($file_name, 0, strrpos($file_name, "."));
                $file_extention = $file->getClientOriginalExtension();
                $num = rand(1,500);
                $new_file_name = $without_extention.$num.'.'.$file_extention;
                $success = $file->move('uploads/contact',$new_file_name);
                if($success)
                {
                    $contact->profile_pic_url = 'uploads/contact/'.$new_file_name;
                }
            }
            if($contact->account_id)
            {
                $account =  Account::find($contact->account_id);
                $account->account_name =$data['display_name'];
                $account->account_code =$data['display_name'];
                $account->account_type_id =5;
                $account->parent_account_type_id =1;
                $account->updated_by = $user_id;
                $account->save();
            }

            $contact->first_name            = $data['first_name'];
            $contact->last_name             = $data['last_name'];
            $contact->display_name          = $data['display_name'];
            $contact->company_name          = $data['company_name'];
            $contact->email_address         = $data['email_address'];
            $contact->skype_name            = $data['skype_name'];
            $contact->phone_number_1        = $data['phone_number_1'];
            $contact->phone_number_2        = $data['phone_number_2'];
            $contact->phone_number_3        = $data['phone_number_3'];
            $contact->billing_street        = $data['billing_street'];
            $contact->billing_city          = $data['billing_city'];
            $contact->billing_state         = $data['billing_state'];
            $contact->billing_zip_code      = $data['billing_zip_code'];
            $contact->billing_country       = $data['billing_country'];
            $contact->shipping_street       = $data['shipping_street'];
            $contact->shipping_city         = $data['shipping_city'];
            $contact->shipping_state        = $data['shipping_state'];
            $contact->shipping_zip_code     = $data['shipping_zip_code'];
            $contact->shipping_country      = $data['shipping_country'];
            $contact->fb_id                 = $data['fb_id'];
            $contact->tw_id                 = $data['tw_id'];
            $contact->about                 = $data['about'];
            $contact->contact_status        = 1;
            $contact->branch_id             = 1;
//            $contact->created_by            = $contact['created_by'];
            $contact->updated_by            = $user_id;


            if($contact->save())
            {
                return redirect()
                    ->route('contact', ['id' => $id])
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Contact Update successfully!');
            }
            else
            {
                throw new \Exception();

            }
        }
        catch (\Exception $e)
        {
            return redirect()
                ->route('contact', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be Update.');
        }
    }

    public function destroy($id)
    {

        DB::beginTransaction();
        try
        {
            $contact = Contact::find($id);
            $journal = JournalEntry::where('contact_id',$contact->id)->count();
           if($journal){
              return redirect()
                   ->route('contact')
                   ->with('alert.status', 'danger')
                   ->with('alert.message', 'Sorry, contact cannot be Deleted. 
                            Because this contact contain transactions. Remove all transactions for this contact before delete contact');
           }else{
               try{
                   if($contact->contact_category_id==5){
                       Account::find($contact->account_id)->delete();
                   }
                   $contact->delete();
                   DB::commit();
                   return redirect()
                       ->route('contact')
                       ->with('alert.status', 'danger')
                       ->with('alert.message', 'Contact Deleted successfully!');
               }catch (\Exception $e){
                   DB::rollBack();
                   return redirect()
                       ->route('contact')
                       ->with('alert.status', 'success')
                       ->with('alert.message', 'Sorry, contact cannot be Deleted. 
                            Something wrong try again ');
               }

           }
            $invoices = Invoice::where('customer_id', $id)->get();
            if(count($invoices) > 0)
            {
                return redirect()
                    ->route('contact')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, contact cannot be Deleted. 
                            Because this contact contain invoice. Remove all invoice for this contact before delete contact');
            }

            $bills = Bill::where('vendor_id', $id)->get();
            if(count($bills) > 0)
            {
                return redirect()
                    ->route('contact')
                    ->with('alert.status', 'alert')
                    ->with('alert.message', 'Sorry, contact cannot be Deleted. 
                            Because this contact contain bill. Remove all bill for this contact before delete contact');
            }

            if($contact->profile_pic_url)
            {
                $delete_path = public_path($contact->profile_pic_url);
                $delete = unlink($delete_path);
            }

            if ($contact->delete())
            {
                return redirect()
                    ->route('contact')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Contact Deleted successfully!');
            }
            else
            {
                return redirect()
                    ->route('contact')
                    ->with('alert.status', 'alert')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be Deleted.');
            }
        }
        catch (Exception $e)
        {
            return $e->getMessage();
        }

    }

    public function destroyAgent($id)
    {
        try
        {
            $agent = Agent::find($id);

            if($agent->profile_pic_url)
            {
                $delete_path = public_path($agent->profile_pic_url);
                $delete = unlink($delete_path);
            }

            if ($agent->delete())
            {
                return redirect()
                    ->route('contact')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Agent Deleted successfully!');
            }
            else
            {
                return redirect()
                    ->route('contact')
                    ->with('alert.status', 'alert')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be Deleted.');
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('contact')
                ->with('alert.status', 'alert')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be Deleted.');
        }

    }

    public function pdf()
    {
        $OrganizationProfile = OrganizationProfile::first();
        $contacts = Contact::all();
        
        return view('contact::contact.pdf', compact('contacts', 'OrganizationProfile'));
    
    }
}
