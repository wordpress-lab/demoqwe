<?php

namespace App\Modules\Report\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\Contact\Contact;
use App\Models\Contact\ContactCategory;
use App\Models\OrganizationProfile\OrganizationProfile;
use App\Modules\Report\Http\Response\ContactReport;
use App\Modules\Report\Http\Response\ContactWiseItem;
use DateTime;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ContactWiseItemController extends Controller
{
    public function index()
    {
        $branch_id = session('branch_id');
        $current_branch=Branch::find($branch_id);

        $category = ContactCategory::all();
        $date = new DateTime('now');
        $date->modify('first day of this month');

        $branch=Branch::all();
        $start = $date->format('Y-m-d');
        $date->modify('last day of this month');
        $end = $date->format('Y-m-d');
        $OrganizationProfile = OrganizationProfile::find(1);

        $list = [];

        return view('report::Ajax.item.index',compact('category','current_branch','branch','OrganizationProfile','start','end'));

    }

    public function filter(Request $request)
    {
        $branch_id = session('branch_id');
        $current_branch=Branch::find($branch_id);
        $category = ContactCategory::all();
        $branch= Branch::all();
        $start = date("Y-m-d",strtotime($request->from_date));
        $end = date("Y-m-d",strtotime($request->to_date));
        $OrganizationProfile = OrganizationProfile::find(1);
        $list = [];

        return view('report::Ajax.item.index',compact('category','current_branch','branch','OrganizationProfile','start','end'));

    }
    public function AlpahabetSearch(Request $request)
    {
        $branch_id = session('branch_id');
        $current_branch=Branch::find($branch_id);

        $category = ContactCategory::all();
        $date = new DateTime('now');
        $date->modify('first day of this month');

        $branch=Branch::all();
        $start = $date->format('Y-m-d');
        $date->modify('last day of this month');
        $end = $date->format('Y-m-d');
        $OrganizationProfile = OrganizationProfile::find(1);
        $type_from = $request->type_from;
        $type_to = $request->type_to;
        $list = [];

        return view('report::Ajax.item.index',compact('category','current_branch','branch','OrganizationProfile','start','end'));

    }
    public function dateFilter(Request $request){


        $from = '"'.date("Y-m-d",strtotime($request->start)).'"';
        $to='"'.date("Y-m-d",strtotime($request->end)).'"';

        $contact_item = Contact::select("contact.display_name as display_name","contact.id as id","contact.contact_category_id as category",DB::raw("customer_sales_quantity_date(contact.id,$from,$to) as sales"),DB::raw("customer_purchase_quantity_date(contact.id,$from,$to) as purchase"))->get();
        return response($contact_item);
    }
    public function alpaFilter(Request $request)
    {
        $type_from = trim($request->type_from);
        $type_to=trim($request->type_to);
        if($type_from>$type_to)
        {
            $temp=  $type_from;
            $from_alpa = $type_to;
            $to_alpa = $temp;
            $str = $from_alpa."-".$to_alpa;
            $q= "^[$str]";
        }else{
            $str = $type_from."-".$type_to;
            $q= "^[$str]";
        }
        $from = '"'.date("Y-m-d",strtotime($request->start)).'"';
        $to='"'.date("Y-m-d",strtotime($request->end)).'"';
        $contact_item = Contact::select("contact.display_name as display_name","contact.id as id","contact.contact_category_id as category",DB::raw("customer_sales_quantity_date(contact.id,$from,$to) as sales"),DB::raw("customer_purchase_quantity_date(contact.id,$from,$to) as purchase"))
                               ->where("contact.display_name","regexp",$q)
                               ->get();
        return response($contact_item);
    }

    public function alpaNameFilter(Request $request)
    {
        $from = '"'.date("Y-m-d",strtotime($request->start)).'"';
        $to='"'.date("Y-m-d",strtotime($request->end)).'"';
        $name = $request->contact_name;

        $contact_item = Contact::select("contact.display_name as display_name","contact.id as id","contact.contact_category_id as category",DB::raw("customer_sales_quantity_date(contact.id,$from,$to) as sales"),DB::raw("customer_purchase_quantity_date(contact.id,$from,$to) as purchase"))
            ->where("contact.display_name","like","%{$name}%")
            ->get();
        return response($contact_item);
    }
    public function apiContactName(Request $request)
    {

        $q= trim($request->name);
        $branch_id = session('branch_id');
        $url = route("report_account_contact_wise_item_all",["contact_name"=>$q]);
        $list = Contact::where("contact.display_name","like","%{$q}%")->select("display_name")->take(10)->get();
        foreach ($list as $item){
            $item->url = $url;
        }

        return response($list);
    }
    public function apiContactItemDetails(Request $request)
    {
    //details
        $id = $request->id;
        if(!isset($request->id)||!is_numeric($request->id)){
          return back();
        }
        $customer =Contact::find($id);

        if(!$customer)
        {
            abort(404);
        }

        $branch_id = session('branch_id');
        $current_branch=Branch::find($branch_id);
        $branch= Branch::all();
        $start = date("Y-m-d",strtotime($request->start));
        $end = date("Y-m-d",strtotime($request->end));
        $OrganizationProfile = OrganizationProfile::find(1);
        $list = [];
        $contact_route = route("report_account_api_Contact_Item_Details_show",['id'=>$id,'branch'=>$branch_id,'start'=>$start,'end'=>$end]);
        return view('report::Ajax.item.show',compact('contact_route','customer','id','current_branch','branch','OrganizationProfile','start','end'));


    }
    public function apiContactItemDetailsShow($id,$branch,$start,$end)
    {
       if(!isset($id)){
           return [];
       }
      $itemlist =new ContactWiseItem($start,$end);
      $items = $itemlist->Itemlist($id);
      return $items;
    }
    public function apiContactItemList(Request $request)
    {
       $contact_item = [];
       $contact_item = Contact::select("contact.display_name as display_name","contact.id as id","contact.contact_category_id as category",DB::raw('customer_sales_quantity(contact.id) as sales'),DB::raw("customer_purchase_quantity(contact.id) as purchase"))->get();

       return response($contact_item);
    }
}
