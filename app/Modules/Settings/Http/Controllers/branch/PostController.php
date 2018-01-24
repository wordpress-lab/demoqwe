<?php

namespace App\Modules\Settings\Http\Controllers\branch;

use App\Models\Branch\Branch;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
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
        $branchs = Branch::with('Users')->get();



        return view('settings::branch.index', compact('branchs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('settings::branch.create');
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
            'branch_name' => 'required|unique:branch',
            'location' => 'required',
        ]);
       try{
           $user_id = Auth::user()->id;
           $branch = new Branch();
           $branch->branch_name = $request->branch_name;
           $branch->location = $request->location;
           $branch->branch_description = $request->branch_description;
           $branch->created_by = $user_id;
           $branch->updated_by = $user_id;
           $branch->save();
           return redirect()
               ->route('branch_create')
               ->with('alert.status', 'success')
               ->with('alert.message', 'Branch created successfully!');
       }catch (\Illuminate\Database\QueryException $ex){
           return redirect()
               ->route('branch_create')
               ->with('alert.status', 'danger')
               ->with('alert.message', 'Sorry something went wrong! Data cannot created successfully!');
       }catch (\Exception $ex){
           return redirect()
               ->route('branch_create')
               ->with('alert.status', 'danger')
               ->with('alert.message', 'Sorry something went wrong! Data cannot created successfully!');
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
        $branch = Branch::find($id);
        return view('settings::branch.edit', compact('branch'));
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
            'branch_name' => 'required',
            'location' => 'required',
        ]);
        try{
            $user_id = Auth::user()->id;
            $branch = Branch::find($id);
            $branch->branch_name = $request->branch_name;
            $branch->location = $request->location;
            $branch->branch_description = $request->branch_description;

            $branch->updated_by = $user_id;
            $branch->save();
            return redirect()
                ->route('branch')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Branch updated successfully!');
        }catch (\Illuminate\Database\QueryException $exception){
            if($exception instanceof \Illuminate\Database\QueryException )
            {

                if (App::environment('development', 'local'))
                {
                    $msg = $exception->getMessage();
                }

                if(isset($exception->errorInfo[0]) && isset($exception->errorInfo[1]) && count($exception->errorInfo)==3)
                {
                    if(isset($exception->errorInfo[0]) && isset($exception->errorInfo[1]) && isset($exception->errorInfo[2]) && $exception->errorInfo[0]=="42000" && $exception->errorInfo[1]=="1142")
                    {
                        $msg = explode("@",$exception->errorInfo[2])[0];
                    }

                    if ($exception->getCode() == "42000")
                    {
                        return back()
                            ->with('alert.status', 'danger')
                            ->with('alert.message', 'You not allowed at this moment'." ".$msg);
                    }

                }
            }
            return redirect()
                ->route('branch_edit',$id)
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry something went wrong! Data cannot updated successfully!');
        }catch (\Exception $ex){
            return redirect()
                ->route('branch_edit',$id)
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry something went wrong! Data cannot updated successfully!');
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
       $branch = Branch::with('Users')->find($id);
       if($branch->Users()->count()){
         return redirect()
            ->route('branch')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'There are some users exist on this branch! Data cannot delete!');
        }
        else
        {
           $branch->delete();
           return redirect()
                ->route('branch')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Branch deleted successfully!');
        }
    }
}
