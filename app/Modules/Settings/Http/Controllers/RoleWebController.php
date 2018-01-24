<?php

namespace App\Modules\Settings\Http\Controllers;

use Exception;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

//Models
use App\Models\AccessLevel\Role;
use App\Models\AccessLevel\Modules;
use App\Models\AccessLevel\AccessLevel;
use Illuminate\Support\Facades\DB;

class RoleWebController extends Controller
{
    public function index()
    {
        $roles = Role::all();

        return view('settings::roles.index', compact('roles'));
    }

    public function create()
    {
        return view('settings::roles.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name'        => 'required',
            'description' => 'required',
        ]);

        try
        {
            $role_data = $request->all();
            $user_id = Auth::user()->id;

            $role = new Role;
            $role->name        = $role_data['name'];
            $role->description = $role_data['description'];
            $role->created_by  = $user_id;
            $role->updated_by  = $user_id;

            if ($role->save())
            {
                $last_role = Role::orderBy('created_at', 'DESC')->first();
                $role_id = $last_role['id'];
                $modules = Modules::all();

                foreach($modules as $module)
                {
                    $access_level = new AccessLevel;
                    $module_id = $module->id;

                    $access_level->create     = 0;
                    $access_level->read       = 0;
                    $access_level->update     = 0;
                    $access_level->delete     = 0;
                    $access_level->role_id    = $role_id;
                    $access_level->module_id  = $module_id;
                    $access_level->created_by = $user_id;
                    $access_level->updated_by = $user_id;

                    $access_level->save();
                }

                return redirect()
                    ->route('role_create')
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Role created successfully!');
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('role_create')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry something went wrong! Data cannot created successfully!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role = Role::find($id);

        return view('settings::roles.edit', compact('role'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'        => 'required',
            'description' => 'required',
        ]);

        try
        {
            $role_data = $request->all();
            $user_id = Auth::user()->id;

            $role = Role::find($id);
            $role->name        = $role_data['name'];
            $role->description = $role_data['description'];
            $role->created_by  = $user_id;
            $role->updated_by  = $user_id;

            if ($role->update())
            {
                return redirect()
                    ->route('role_edit', ['id' => $id])
                    ->with('alert.status', 'success')
                    ->with('alert.message', 'Role created successfully!');
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('role_edit', ['id' => $id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry something went wrong! Data cannot created successfully!');
        }
    }

    public function destroy($id)
    {

        $role = Role::find($id);

        if($role->users->count())
        {
            return redirect()
                ->route('role')
                ->with('alert.status', 'alert')
                ->with('alert.message', 'Role has users! ');
        }


        if($role->delete())
        {
            return redirect()
                ->route('role')
                ->with('alert.status', 'success')
                ->with('alert.message', 'Role has been deleted successfully!');
        }
    }
}
