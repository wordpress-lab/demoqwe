<?php

namespace App\Modules\Inventory\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redirect;

use App\Models\Company\Company;
use App\Models\Moneyin\InvoiceEntry;
use Exception;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

// Models
use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\Product;
use App\Models\Inventory\ProductPhase;
use App\Models\Inventory\ProductPhaseItem;
use App\Models\Inventory\Stock;
use App\Models\AccountChart\Account;
use App\Models\Tax;
use App\Models\MoneyOut\BillEntry;

class InventoryWebController extends Controller
{
    public function apiAllInventory(Request $request)
    {
       try{
           $items = Item::leftjoin("item_category","item_category.id","item.item_category_id")
               ->select("item.created_at","item.id","item.item_category_id","item.reorder_point","item_category.item_category_name","item.item_name","item.total_purchases","item.total_sales","item.total_purchases")
               ->get();
           foreach ($items as $value)
           {
               $value->format_created_at = date("Y-m-d",strtotime($value->created_at));
           }
           return response($items);
       }catch (\Exception $exception){

           return response([]);
       }

    }
    public function index()
    {
        $items = Item::leftjoin("item_category","item_category.id","item.item_category_id")
            ->select("item.id","item.item_category_id","item.reorder_point","item_category.item_category_name","item.item_name","item.total_purchases","item.total_sales","item.total_purchases")
            ->get();
        $item_categories = ItemCategory::select("item_category_name",'id')->get();
        return view('inventory::inventory.Ajax.index', compact('items','item_categories'));
    }

    public function create(Request $request)
    {
        $item_categories = ItemCategory::all();
        $accounts = Account::all();
        $branches = Branch::all();
        $taxs     = Tax::all();
        $company =  [];
        $confirmation_id = null;
        $order_id = null;
        if($request->confirmation){
            $confirmation_id = $request->confirmation;
        }
        if($request->order){
            $order_id = $request->order;
        }

        return view('inventory::inventory.create', compact('company','item_categories', 'accounts', 'branches','taxs','confirmation_id','order_id'));
    }

    public function store(Request $request)
    {
        
        $item_data = $request->all();


         try {

            $validator = Validator::make($request->all(), [
                'item_name'                 => 'required|unique:item',
                'item_category_id'          => 'required',
            ]);

            if ($validator->fails()) {
                return redirect::back()->withErrors($validator);
            }

            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $item = new Item;

            $item->item_name                 = $item_data['item_name'];
            $item->item_about                = $item_data['item_about'];
            $item->item_sales_rate           = $item_data['item_sales_rate'];
            $item->item_sales_description    = $item_data['item_sales_description'];
            $item->item_sales_tax            = $item_data['item_sales_tax'];
            $item->item_purchase_rate        = $item_data['item_purchase_rate'];
            $item->item_purchase_description = $item_data['item_purchase_description'];
            $item->reorder_point             = $item_data['reorder_point'];
            $item->item_category_id          = $item_data['item_category_id'];
            $item->unit_type                 = $item_data['unit_type'];
            $item->branch_id                 = 1;
            $item->created_by                = $created_by;
            $item->updated_by                = $updated_by;
//
//             if($item_data['item_category_id']==2){
//             $item->company_id = !empty($item_data['company_id'])?$item_data['company_id']:null;
//             }


            if($item->save())
            {
                if(!empty($request->confirmation_id)){
                    return redirect()
                        ->route('confirmation_edit',$request->confirmation_id)
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Item added successfully!');
                }
                if(!empty($request->order_id)){
                    return redirect()
                        ->route('confirmation_create',$request->order_id)
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Item added successfully!');
                }
                return redirect()
                    ->route('inventory')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Item added successfully!');
            }
            else
                {

                  throw new \Exception("something went wrong");
            }
        }
        catch (\Exception $e)
        {

            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function show($id)
    {
        $item = Item::find($id);
        $item_categories = ItemCategory::all();
        return view('inventory::inventory.show', compact('item','item_categories'));
    }

    public function edit($id)
    {
        $item_categories = ItemCategory::all();
        $accounts = Account::all();
        $branches = Branch::all();
        $item = Item::find($id);
        $taxs     = Tax::all();
        $company =  [];
        return view('inventory::inventory.edit', compact('company','accounts', 'branches', 'item_categories', 'item', 'id','taxs'));
    }

    public function update(Request $request, $id)
    {
        $items = Item::find($id);

        if($items->item_name == $request->item_name){
            $validator = Validator::make($request->all(), [
                'item_category_id'          => 'required',
            ]);

            if ($validator->fails()) {
                return redirect::back()->withErrors($validator);
            }
        }
        else{
            $validator = Validator::make($request->all(), [
                'item_name'                 => 'required|unique:item',
                'item_category_id'          => 'required',
            ]);

            if ($validator->fails()) {
                return redirect::back()->withErrors($validator);
            }
        }
        


        try {
            $item_data = $request->all();
            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $item = Item::find($id);

            $item->item_name                 = $item_data['item_name'];
            $item->item_about                = $item_data['item_about'];
            $item->item_sales_rate           = $item_data['item_sales_rate'];
            $item->item_sales_description    = $item_data['item_sales_description'];
            $item->item_sales_tax            = $item_data['item_sales_tax'];
            $item->item_purchase_rate        = $item_data['item_purchase_rate'];
            $item->item_purchase_description = $item_data['item_purchase_description'];
            $item->reorder_point             = $item_data['reorder_point'];
            $item->item_category_id          = $item_data['item_category_id'];
            $item->unit_type                 = $item_data['unit_type'];
            $item->branch_id                 = 1;
            $item->created_by                = $item['created_by'];
            $item->updated_by                = $updated_by;
//            if($item_data['item_category_id']==2){
//                $item->company_id = !empty($item_data['company_id'])?$item_data['company_id']:null;
//            }else{
//                $item->company_id = null;
//            }

            if($item->update())
            {
                return redirect()
                    ->route('inventory', ['id' => $id])
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Item added successfully!');
            }
            else
            {
                return redirect()
                    ->route('inventory', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('inventory', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function destroy($id)
    {
        $item_use = InvoiceEntry::where('item_id', $id)->get();
        if(count($item_use) > 0)
        {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, Item is used in invoice. You can not delete this item.');
        }

        $item_use = BillEntry::where('item_id', $id)->get();
        if(count($item_use) > 0)
        {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, Item is used in bill. You can not delete this item.');
        }

        $item = Item::find($id);

        if ($item->delete())
        {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Item deleted successfully!');
        }
        else
        {
            return redirect()
                ->route('inventory')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be deleted.');
        }
    }
}
