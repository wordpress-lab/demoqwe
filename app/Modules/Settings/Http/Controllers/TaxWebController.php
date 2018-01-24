<?php

namespace App\Modules\Settings\Http\Controllers;

use Exception;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

// Models
use App\Models\Tax;

class TaxWebController extends Controller
{
    public function index()
    {
        $taxes = Tax::all();

        return view('settings::tax.index', compact('taxes'));
    }

    public function create()
    {
        return view('settings::tax.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'tax_name' => 'required',
            'amount_percentage' => 'required|numeric|between:1,99',
        ]);

        try
        {
            $tax_data = $request->all();
            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $tax = new Tax;

            $tax->tax_name = $tax_data['tax_name'];
            $tax->amount_percentage = $tax_data['amount_percentage'];
            $tax->created_by = $created_by;
            $tax->updated_by = $updated_by;


            if ($tax->save())
            {
                return redirect()
                    ->route('tax_create')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Tax added successfully!');
            }
            else
            {
                return redirect()
                    ->route('tax_create')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }


        }
        catch (Exception $e)
        {
            return redirect()
                ->route('tax_create')
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
        $tax = Tax::find($id);

        return view('settings::tax.edit', compact('tax'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'tax_name' => 'required',
            'amount_percentage' => 'required|numeric|between:1,99',
        ]);

        try
        {
            $tax_data = $request->all();
            $created_by = Auth::user()->id;
            $updated_by = Auth::user()->id;

            $tax = Tax::find($id);

            $tax->tax_name = $tax_data['tax_name'];
            $tax->amount_percentage = $tax_data['amount_percentage'];
            $tax->created_by = $created_by;
            $tax->updated_by = $updated_by;

            if ($tax->update())
            {
                return redirect()
                    ->route('tax_edit', ['id' => $id])
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Tax updated successfully!');
            }
            else
            {
                return redirect()
                    ->route('tax_edit', ['id' => $id])
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be updated.');
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('tax_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        }
    }

    public function destroy($id)
    {
        $tax = Tax::find($id);

        if ($tax->delete())
        {
            return redirect()
                ->route('tax')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Tax deleted successfully!');
        }
        else
        {
            return redirect()
                ->route('tax')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry, something went wrong! Data cannot be deleted.');
        }
    }
}
