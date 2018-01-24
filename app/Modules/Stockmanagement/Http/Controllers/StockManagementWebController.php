<?php

namespace App\Modules\Stockmanagement\Http\Controllers;

use Exception;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

// Models
use App\Models\Branch\Branch;
use App\Models\Inventory\Item;
use App\Models\Inventory\ItemCategory;
use App\Models\Inventory\Stock;

class StockManagementWebController extends Controller
{
    public function index()
    {
        $items = Item::all();

        return view('stockmanagement::stock.index', compact('items'));
    }

    public function create()
    {
        $item_categories = ItemCategory::all();
        $branches = Branch::all();
        $items = Item::all();

        return view('stockmanagement::stock.create', compact('item_categories', 'branches', 'items'));
    }

    public function store(Request $request)
    {

        $this->validate($request, [
            'item_category_id'  => 'required',
            'item_id'           => 'required',
            'date'              => 'required',
            'total'             => 'required | numeric',
        ]);

        try
        {



            $stock_data = $request->all();


            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $stock = new Stock;

            $stock->branch_id            = 1;
            $stock->item_category_id     = $stock_data['item_category_id'];
            $stock->item_id              = $stock_data['item_id'];
            $stock->date                 = $stock_data['date'];
            $stock->total                = $stock_data['total'];
            $stock->created_by           = $created_by;
            $stock->updated_by           = $updated_by;

            if($stock->save())
            {
                $item_id = $stock_data['item_id'];
                $total_purchases = Stock::where('item_id', $item_id)->sum('total');
                $item = Item::find($item_id);

                $item->total_purchases = $total_purchases;

                if($item->update())
                {
                 return redirect()
                    ->route('stock_create')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Stock added successfully!');
                }
            }
            else
            {
                return redirect()
                    ->route('stock_create')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('stock_create')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function show($id)
    {
        return view('stockmanagement::stock.show');
    }

    public function edit($id)
    {
        $item_categories = ItemCategory::all();
        $branches = Branch::all();
        $items = Item::all();
        $stock = Stock::find($id);

        return view('stockmanagement::stock.edit', compact('item_categories', 'branches', 'items', 'stock'));
    }

    public function update(Request $request, $id)
    {


        $this->validate($request, [
            'item_category_id'  => 'required',
            'item_id'           => 'required',
            'date'              => 'required',
            'total'             => 'required | numeric',
        ]);

        try
        {

            $stock_data = $request->all();
            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $stock = Stock::find($id);

            $stock->branch_id            = 1;
            $stock->item_category_id     = $stock_data['item_category_id'];
            $stock->item_id              = $stock_data['item_id'];
            $stock->date                 = $stock_data['date'];
            $stock->total                = $stock_data['total'];
            $stock->created_by           = $created_by;
            $stock->updated_by           = $updated_by;

            if($stock->update())
            {

                $item_id = $stock_data['item_id'];
                $total_purchases = Stock::where('item_id', $item_id)->sum('total');
                $item = Item::find($item_id);
                $item->total_purchases = $total_purchases;

                if($item->update())
                {
                    return redirect()
                        ->route('stock_edit', ['id' => $id])
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'stock updated successfully!');
                }
            }
            else
            {
                return redirect()
                    ->route('stock_edit', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('stock_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function destroy($item_id, $id)
    {
        $stock = Stock::find($id);
        if($stock->delete())
        {
            
            $total_purchases = Stock::where('item_id', $item_id)->sum('total');
            $item = Item::find($item_id);
            $item->total_purchases = $total_purchases;

            if($item->update())
            {
                return redirect()
                    ->route('stock_history', ['id' => $item])
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Stock deleted successfully!');
            }
        }
        else
        {
            return redirect()
                ->route('stock_history', ['id' => $item_id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Cannot delete data.');
        }
    }
}
