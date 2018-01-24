<?php

namespace App\Modules\Inventory\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\Product;
use App\Models\Inventory\ProductPhase;
use App\Models\Inventory\ProductPhaseItem;
use App\Models\Inventory\Stock;
use App\Models\AccountChart\Account;

class CategoryWebController extends Controller
{
	public function index(){
		$branches = Branch::all();
		$item_categories = ItemCategory::all();
        return view('inventory::category.index', compact('branches','item_categories'));
	}

    public function create()
    {
        $branches = Branch::all();
        return view('inventory::category.create', compact('branches'));
    }



    public function store(Request $request)
    {
        $this->validate($request, [
            'item_category_name' => 'required',
            'item_category_description' => 'required',
        ]);

        try
        {
            $category_data = $request->all();
            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $category = new ItemCategory;

            $category->item_category_name = $category_data['item_category_name'];
            $category->item_category_description = $category_data['item_category_description'];
            $category->branch_id = 1;
            $category->created_by = $created_by;
            $category->updated_by = $updated_by;


            if ($category->save())
            {
                return redirect()
                    ->route('inventory_category_create')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Category added successfully!');
            }
            else
            {
                return redirect()
                    ->route('inventory_category_create')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }


        }
        catch (Exception $e)
        {
            return redirect()
                ->route('inventory_category_create')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function edit($id)
    {
    	$branches = Branch::all();
        $category = ItemCategory::find($id);

        return view('inventory::category.edit', compact('category', 'branches'));
    }


    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'item_category_name' => 'required',
            'item_category_description' => 'required',
        ]);

        try
        {
            $category_data = $request->all();
            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $category = ItemCategory::find($id);

            $category->item_category_name = $category_data['item_category_name'];
            $category->item_category_description = $category_data['item_category_description'];
            $category->branch_id = 1;
            $category->created_by = $created_by;
            $category->updated_by = $updated_by;

            if ($category->update())
            {
                return redirect()
                    ->route('inventory_category_edit', ['id' => $id])
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Category updated successfully!');
            }
            else
            {
                return redirect()
                    ->route('inventory_category_edit', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('inventory_category_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }


    public function destroy($id)
    {
        $category = ItemCategory::find($id);

        if ($category->delete())
        {
            return redirect()
                ->route('inventory_category')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Category deleted successfully!');
        }
        else
        {
            return redirect()
                ->route('inventory_category')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be deleted.');
        }
    }
    
}
