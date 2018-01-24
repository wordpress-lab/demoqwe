<?php

namespace App\Modules\Producttrack\Http\Controllers;

use DB;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Models\Branch\Branch;
use App\Models\Inventory\Product;

use App\Models\Inventory\ProductPhase;


class ProductTrackWebController extends Controller
{
    public function index()
    {
        $products = Product::all();
        
        return view('producttrack::track.index' , compact('products'));
    }

    public function create()
    {
        $branches = Branch::all();
        return view('producttrack::track.create' , compact('branches'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'product_name'    => 'required',

            'product_phase.*'   => 'required',
            'total_product'   => 'required | numeric',
        ]);

        try
        {
            $product_data = $request->all();
            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $product = new Product;

            $product->branch_id          = 1;
            $product->product_name       = $product_data['product_name'];
            $product->total_product      = $product_data['total_product'];
            $product->created_by         = $created_by;
            $product->updated_by         = $updated_by;

            if($product->save())
            {
                $product_phase = Product::orderBy('created_at','desc')->first();
                $product_id    = $product_phase->id;
                $phase_data    = $request->all();
                $created_by    = Auth::user()->id;
                $updated_by    = Auth::user()->id;
                $count         = count($phase_data['product_phase']);

                $product_phase_arary = $phase_data['product_phase'];
                $product_phase = [];
                for($i=0; $i< $count; $i++)
                {

                    $product_phase[] = [
                        'product_phase_name' => $product_phase_arary[$i] ,
                        'product_id'         => $product_id,
                        'status'             => 0,
                        'created_by'         => $created_by,
                        'updated_by'         => $updated_by,
                        'created_at'         => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'         => \Carbon\Carbon::now()->toDateTimeString(),
                    ];
                }
                $save = DB::table('product_phase')->insert($product_phase);

                if($save)
                {
                    return redirect()
                        ->route('track')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Product added successfully!');
                }
                else
                {
                    return redirect()
                        ->route('track_create')
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
                }
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('track_create')
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
        $product = Product::find($id);
        $branches = Branch::all();
        return view('producttrack::track.edit' , compact('product' , 'branches'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'product_name'    => 'required',
            'total_product'   => 'required | numeric',

        ]);

        try
        {
            $product_data = $request->all();
            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $product = Product::find($id);

            $product->branch_id          = 1;
            $product->product_name       = $product_data['product_name'];
            $product->total_product      = $product_data['total_product'];
            $product->created_by         = $created_by;
            $product->updated_by         = $updated_by;

            $product_phases = $product->productPhases->count();
            $product_id     = $id;

            if($product->update())
            {
                if($product_phases > 0)
                {
                    $delete=ProductPhase::where('product_id' , $product_id)->delete();

                }

                $phase_data    = $request->all();
                $created_by    = Auth::user()->id;
                $updated_by    = Auth::user()->id;
                $count         = count($phase_data['product_phase']);

                $product_phase_arary = $phase_data['product_phase'];
                $product_phase = [];
                for($i = 0; $i < $count; $i++)
                {

                    $product_phase[] = [
                        'product_phase_name' => $product_phase_arary[$i] ,
                        'product_id'         => $product_id,
                        'status'             => 0,
                        'created_by'         => $created_by,
                        'updated_by'         => $updated_by,
                        'created_at'         => \Carbon\Carbon::now()->toDateTimeString(),
                        'updated_at'         => \Carbon\Carbon::now()->toDateTimeString(),
                    ];
                }
                $save = DB::table('product_phase')->insert($product_phase);
                if($save)
                {
                  return redirect()
                    ->route('track')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Product updated successfully!');  
                }
                else
                {
                    return redirect()
                        ->route('track_edit', ['id' => $id])
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
                }
                
            }
            
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('track_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }

    }

    public function destroy($id)
    {
        $product = Product::find($id);

        if($product->delete())
        {
            return redirect()
                ->route('track')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Product deleted successfully!');
        }
        else
        {
            return redirect()
                ->route('track')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
        }
    }

    //api for get product phase item list
    public function getProduct($id)
    {
        $data = ProductPhase::where('product_id', $id)->get();
        return $data;
    }


}
