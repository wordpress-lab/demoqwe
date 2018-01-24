<?php

namespace App\Modules\Contact\Http\Controllers;

use App\Models\Contact\Agent;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

// Models
use App\Models\Contact\Contact;
use App\Models\Contact\ContactCategory;

class InventorySearchController extends Controller
{
    public function index($id)
    {
    	$contacts = Contact::where('contact_category_id',$id)->get();

        if($id == 6)
        {
            $agents = Agent::all();
        }
        else
        {
            $agents = [];
        }

        
        $contactCategories = ContactCategory::all();

        //return $contacts;

        return view('contact::contact.index', compact('contacts', 'contactCategories', 'agents'));
    }
}
