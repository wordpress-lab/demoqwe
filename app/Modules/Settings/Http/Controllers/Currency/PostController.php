<?php

namespace App\Modules\Settings\Http\Controllers\Currency;

use App\Models\Backup\backup;
use App\Models\Setting\Currency\SettingCurrency;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
      $currency = SettingCurrency::with('rate')->latest()->get();

      return view('settings::currency.currency.index',compact('currency'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings::currency.currency.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:setting_currencies|max:255',
        ]);
        try{
            $user_id = Auth::user()->id;
            $currency =  new SettingCurrency();
            $currency->name = $request->name;
            $currency->symbol = $request->symbol;
            $currency->note = $request->note;
            $currency->created_by = $user_id;
            $currency->updated_by = $user_id;
            $currency->save();
            return redirect()
                ->route('settings_Currency_index_list')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Currency added successfully!');
        }catch(\Exception $exception){
            return back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Currency added fail!');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $currency =  SettingCurrency::find($id);
     return view('settings::currency.currency.edit',compact('currency'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $currency =  SettingCurrency::find($id);
        if($currency["name"]!=$request->name)
        {
            $this->validate($request, [
                'name' => 'required|unique:setting_currencies|max:255',
            ]);
        }


        try{

            $user_id = Auth::user()->id;

            $currency->name = $request->name;
            $currency->symbol = $request->symbol;
            $currency->note = $request->note;
            $currency->created_by = $user_id;
            $currency->updated_by = $user_id;
            $currency->save();

            return redirect()
                ->route('settings_Currency_index_list')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Currency updated successfully!');
        }catch(\Exception $exception){
            return back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Currency update fail!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = SettingCurrency::find($id);
        try{
            if ($item->delete())
            {
                return redirect()
                    ->route('settings_Currency_index_list')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Currency deleted successfully!');
            }
            else
            {
             throw new \Exception();
            }
        }catch(\Exception $exception){
            return redirect()
                ->route('settings_Currency_index_list')
                ->with('alert.status', 'warning')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be deleted.');
        }

    }
}
