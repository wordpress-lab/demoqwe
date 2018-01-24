<?php

namespace App\Modules\Company\Http\Controllers;

use App\Models\Branch\Branch;
use App\Models\Company\Company;
use App\Models\Inventory\Item;
use App\Models\Visa\Visa;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class CompanyController extends Controller
{
    public function index($id=null)
    {

        $id=$id;

        if (is_null($id))
        {
            if (session('branch_id')==1){
                //dd('1');
                $branch=Branch::all();
                $company = Company::all();
                return view('company::company.index', compact('company','branch','id'));
              //  return view('order::order.index',compact('branch','id'))->with('order',$company);
            }
            else {

                $branch=Branch::where('id',session('branch_id'))->get();
                $company = Company::join('users','company.created_by','=','users.id')
                    ->where('users.branch_id',session('branch_id'))
                    ->select('company.*')
                    ->get();
                return view('company::company.index', compact('company','branch','id'));
                //return view('order::order.index',compact('branch','id'))->with('order',$order);
            }
        }
        else {

                $branch=Branch::all();
                $company = Company::join('users','company.created_by','=','users.id')
                    ->where('users.branch_id',$id)
                    ->select('company.*')
                    ->get();
                return view('company::company.index', compact('company','branch','id'));

        }
    }

    public function create()
    {
        return view('company::company.create');
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
        ]);
        if ($validator->fails())
        {
            return redirect::back()->withErrors($validator);
        }
        DB::beginTransaction();

            try{
                $result=new Company();
                $result->name=$request->name;
                $result->company_code=$request->company_code;

                $result->salary=$request->salary;
                $result->mealallowance=$request->mealallowance;
                $result->airtransport=$request->airtransport;
                $result->referencename=$request->referencename;
                $result->nameAr = $request->nameAr;
                $result->contactNumber =$request->contactNumber;
                $result->companyAddress = $request->companyAddress;
                $result->created_by=Auth::user()->id;
                $result->updated_by=Auth::user()->id;

                if($result->save())
                {
                 $item =  new Item();
                 $item->created_by=Auth::user()->id;
                 $item->updated_by=Auth::user()->id;
                 $item->item_name = $result->name;
                 $item->company_id = $result->id;
                 $item->item_category_id = 2;
                 $item->branch_id = 1;
                     if(!$item->save())
                     {
                         throw  new \Exception();
                     }
                }
                else
                {
                    throw  new \Exception();
                }

                DB::commit();
                return Redirect::route('visa_create',["companyid"=>$result->id])->with('success','Company Created');
            }
            catch(\Exception $exception)
            {
                DB::rollBack();
                return back()->with('delete','Company Created Fail');
            }




    }

    public function edit($id)
    {
        $company=Company::find($id);
        return view('company::company.edit',compact('company'));
    }

    public function update(Request $request,$id)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'company_code' => 'required',
        ]);

        if ($validator->fails())
        {
            return redirect::back()->withErrors($validator);
        }
        DB::beginTransaction();
        try{
            $result = Company::find($id);
            $result->name = $request->name;
            $result->company_code = $request->company_code;

            $result->salary = $request->salary;
            $result->mealallowance = $request->mealallowance;
            $result->airtransport = $request->airtransport;
            $result->referencename = $request->referencename;
            $result->nameAr = $request->nameAr;
            $result->contactNumber = $request->contactNumber;
            $result->companyAddress = $request->companyAddress;
            $result->updated_by = Auth::user()->id;

            if($result->save())
            {
               $item = Item::where('company_id',$result->id)->first();
                if($item)
                {
                    $item->updated_by=Auth::user()->id;
                    $item->item_name = $result->name;
                    $item->company_id = $result->id;
                    $item->save();
                }
            }
            else
            {
                throw new \Exception();
            }
            DB::commit();
            return Redirect::route('company_index')->with('alert.status', 'success')
                ->with('alert.message', 'Company Udpated successfully!');
        }
        catch(\Exception $exception)
        {
            DB::rollBack();
            return back()->with('delete','Company Update Fail');
        }

    }

    public function delete($id)
    {
        try{
            $company=Company::find($id);
            $visa=Visa::where('company_id',$id)->first();
            if($visa)
            {
                return redirect()->back()->with('delete','The Company has attached with visa');
            }
            $company->delete();
            return redirect()->back()->with('delete','Company Deleted');
        }
        catch(\Exception $exception){
            $ms= $exception->getMessage();
            return redirect()->back()->with('success',"$ms");
        }


    }



}
