<?php

namespace App\Modules\Settings\Http\Controllers\Currency;

use App\Models\Setting\Currency\SettingCurrency;
use App\Models\Setting\Currency\SettingCurrencyRate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CurrencyRateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {

      $curr = SettingCurrency::with('rate')->find($id);


      return view('settings::currency.currencyRate.index',compact('curr'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $curr = SettingCurrency::find($id);


        return view('settings::currency.currencyRate.create',compact('curr'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,$id)
    {
        $this->validate($request, [
            'rate' => 'required|max:255',
        ]);
        $user_id = Auth::user()->id;
        $curr =  new SettingCurrencyRate();

        $curr->currency_id  = $id;
        $curr->conversion_rate = $request->rate;
        $curr->note = $request->note;
        $curr->created_by = $user_id;
        $curr->updated_by = $user_id;
        try{
            $curr->save();

            return redirect()
                ->route('settings_Currency_index_list')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Currency rate added successfully!');
        }catch (\Exception $exception){
            return back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Currency rate added fail!');
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      $curr_rate = SettingCurrencyRate::find($id);
      return view('settings::currency.currencyRate.edit',compact('curr_rate'));
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
        $this->validate($request, [
            'rate' => 'required|max:255',
        ]);
        $user_id = Auth::user()->id;
        $curr = SettingCurrencyRate::find($id);
        $curr->conversion_rate = $request->rate;
        $curr->note = $request->note;

        $curr->updated_by = $user_id;
        try{
            $curr->save();
            return redirect()
                ->route('settings_Currency_rate_history_list',$curr->currency_id)
                ->with('alert.status', 'success')
                ->with('alert.message', 'Currency rate updated successfully!');

        }catch (\Exception $exception){
            return redirect()
                ->back()
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Currency rate updated fail!');
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
        $item = SettingCurrencyRate::find($id);
        $currency_id = $item->currency_id;
        try{
            if ($item->delete())
            {
                return redirect()
                    ->route('settings_Currency_rate_history_list',$currency_id)
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Currency rate deleted successfully!');
            }
            else
            {
                throw new \Exception();
            }
        }catch(\Exception $exception){
            return redirect()
                ->route('settings_Currency_rate_history_list',$currency_id)
                ->with('alert.status', 'warning')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be deleted.');
        }
    }
}
