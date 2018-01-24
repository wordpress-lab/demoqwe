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

class StockManagementHistoryWebController extends Controller
{
    public function index($id)
    {
        $stocks = Stock::where('item_id', $id)->get();

        return view('stockmanagement::history.index', compact('stocks', 'id'));
    }

    public function create($id)
    {
        $item_categories = ItemCategory::all();
        $branches = Branch::all();
        $items = Item::all();
        $item_data = Item::find($id);

        return view('stockmanagement::history.create', compact('item_categories', 'branches', 'items', 'item_data'));
    }

    public function store(Request $request, $id)
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
            $stock->date                 = date('Y-m-d',strtotime($stock_data['date']));
            $stock->total                = $stock_data['total'];
            $stock->created_by           = $created_by;
            $stock->updated_by           = $updated_by;

            if($stock->save())
            {
                $item_id = $stock_data['item_id'];
                $total_purchases = Stock::where('item_id', $item_id)->sum('total');
                $item = Item::find($id);

                $item->total_purchases = $total_purchases;

                if($item->update())
                {
                    return redirect()
                    ->route('inventory')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Stock added successfully!');
                }
                
            }
            else
            {
                return redirect()
                    ->route('stock_history_create', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('stock_history_create', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
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
                    ->route('stock_history', ['id' => $item_id])
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
