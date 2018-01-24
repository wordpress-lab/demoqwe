<?php

namespace App\Modules\Pricelist\Http\Controllers\PriceList;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
//Models
use App\Models\Contact\Contact;
use App\Models\Inventory\Item;
use App\Models\PriceList\PriceList;

class WebController extends Controller
{
    
    public function index()
    {
        $pricelist = PriceList::all();
        return view('pricelist::priceList.index' , compact('pricelist'));
    }

    
    public function create()
    {
        $contact = Contact::all();
        $item = Item::all();
        return view('pricelist::priceList.create' , compact('contact','item'));
    }

    
    public function store(Request $request)
    {
        $this->validate($request, [
            'contact'  => 'required',
            'item' => 'required',
        ]);

        $price_list = new Pricelist;

        $price_list->contact_id     = $request->contact;
        $price_list->item_id        = $request->item;
        $price_list->sales_rate     = $request->sales_rate;
        $price_list->purchase_rate  = $request->purchase_rate;
        $price_list->comment        = $request->comment;
        $price_list->created_by     = Auth::user()->id;
        $price_list->updated_by     = Auth::user()->id;

        $price_list->save();

        return redirect('price-list/')->with('message' , 'Price List Insert Successfully');
    }

    
    public function show($item_id,$contact_id)
    {
        $price = Pricelist::where('contact_id',$contact_id)->where('item_id',$item_id)->orderBy('id', 'desc')->first();
        return response()->json($price, 200);
    }

    
    public function edit($id)
    {
        $price_list = Pricelist::find($id);
        $contact = Contact::all();
        $item = Item::all();
        return view('pricelist::priceList.edit' , compact('price_list' , 'contact' , 'item'));
    }

    
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'contact'  => 'required',
            'item' => 'required',
        ]);

        $price_list = Pricelist::find($id);

        $price_list->contact_id     = $request->contact;
        $price_list->item_id        = $request->item;
        $price_list->sales_rate     = $request->sales_rate;
        $price_list->purchase_rate  = $request->purchase_rate;
        $price_list->comment        = $request->comment;
        $price_list->updated_by     = Auth::user()->id;

        $price_list->update();

        return redirect('price-list/')->with('message' , 'Price List Update Successfully');
    }

    
    public function destroy($id)
    {
        $delete = Pricelist::find($id);

        if($delete->delete())
        {
            return back()->with('message' , 'Price List Deleted Successfully');
        }
    }
}
