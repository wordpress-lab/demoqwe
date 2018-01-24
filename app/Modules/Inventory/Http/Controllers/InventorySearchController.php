<?php

namespace App\Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
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
class InventorySearchController extends Controller
{
    public function index($id)
    {
    	$items = Item::where('item_category_id',$id)->get();
        $item_categories = ItemCategory::all();
        return view('inventory::inventory.index', compact('items','item_categories'));
    }
}
