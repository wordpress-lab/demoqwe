<?php

namespace App\Modules\Accountchart\Http\Controllers;

use Exception;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

// Models
use App\Models\Branch\Branch;
use App\Models\AccountChart\Account;
use App\Models\AccountChart\AccountType;
use App\Models\AccountChart\ParentAccountType;

class AccountChartWebController extends Controller
{
    public function index()
    {
        $accounts = Account::all();

        return view('accountchart::account_chart.index', compact('accounts'));
    }

    public function create()
    {
        $branches = Branch::all();
        $account_types = AccountType::where('id','!=',2)
            ->Where('id','!=',13)
            ->get();
        //dd($account_types);
        $parent_account_types = ParentAccountType::all();

        return view('accountchart::account_chart.create', compact('branches', 'account_types', 'parent_account_types'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'account_type_id' => 'required',
            'account_name'    => 'required',
        ]);

        // try
        // {
            $account_data = $request->all();
            $created_by =  Auth::user()->id;
            $updated_by =  Auth::user()->id;

            $parent_account_type = AccountType::find($account_data['account_type_id']);
            $parent_account_type_id = $parent_account_type->parent_account_type_id;
            
            $account = new Account;

            $account->account_name           = $account_data['account_name'];
            $account->account_code           = $account_data['account_code'];
            $account->description            = $account_data['description'];
            $account->account_type_id        = $account_data['account_type_id'];
            $account->parent_account_type_id = $parent_account_type_id;
            $account->created_by             = $created_by;
            $account->updated_by             = $updated_by;

            if($account->save())
            {
                return redirect()
                    ->route('account_chart')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Account added successfully!');
            }
            else
            {
                return redirect()
                    ->route('account_chart_create')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
            }
        // }
        // catch (Exception $e)
        // {
        //     return redirect()
        //         ->route('account_chart_create')
        //         ->with('alert.status', 'danger')
        //         ->with('alert.message', 'Sorry, something went wrong! Refresh or reload the page and try again.');
        // }

    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $account = Account::find($id);

        $branches = Branch::all();
        $account_types = AccountType::where('id','!=',2)
            ->Where('id','!=',13)
            ->get();
        $parent_account_types = ParentAccountType::all();

        return view('accountchart::account_chart.edit', compact('account', 'branches', 'account_types', 'parent_account_types'));
    }

    public function update(Request $request, $id)
    {


        $this->validate($request, [
            'account_type_id' => 'required',
            'account_name'    => 'required',
        ]);

            $account_data = $request->all();
            $created_by =  Auth::user()->id;
            $updated_by =  Auth::user()->id;

            $parent_account_type = AccountType::find($account_data['account_type_id']);
            $parent_account_type_id = $parent_account_type->parent_account_type_id;

            $account = Account::find($id);


            if ($account->required_status==1){
                return redirect()
                    ->route('account_chart')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'You can not edit this Account!');
            }
            else{

                $account->account_name           = $account_data['account_name'];
                $account->account_code           = $account_data['account_code'];
                $account->description            = $account_data['description'];
                $account->account_type_id        = $account_data['account_type_id'];
                $account->parent_account_type_id = $parent_account_type_id;
                $account->updated_by             = $updated_by;

                if($account->update())
                {
                    return redirect()
                        ->route('account_chart', ['id' => $id])
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Account Updated successfully!');
                }
                else
                {
                    return redirect()
                        ->route('account_chart', ['id' => $id])
                        ->with('alert.status', 'danger')
                        ->with('alert.message', 'Sorry, something went wrong! Data cannot be saved.');
                }
            }

    }

    public function destroy($id)
    {
        $account = Account::find($id);

        if ($account->required_status==1){

            return redirect()
                ->route('account_chart')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'You can not Delete this Account!');

        }else{
            if ($account->delete())
            {
                return redirect()
                    ->route('account_chart')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Account deleted successfully!');
            }
            else
            {
                return redirect()
                    ->route('account_chart')
                    ->with('alert.status', 'danger')
                    ->with('alert.message', 'Sorry, something went wrong! Data cannot be deleted.');
            }
        }


    }
}
