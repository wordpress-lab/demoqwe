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

class AccessLevelWebController extends Controller
{
    public function index()
    {
        //
    }

    public function create()
    {
        $roles = Role::all();
        $modules = Modules::all();

        return view('settings::access_level.create', compact('roles', 'modules'));
    }

    public function store(Request $request)
    {
        $access_level_data = $request->all();
        $modules = Modules::all();
        $role_id = $access_level_data['role_id'];
        $user_id = Auth::user()->id;

        try
        {
            foreach($modules as $module)
            {
                $module_id = $module->id;

                if(isset($access_level_data['create_'.$module_id]))
                {
                    $create = 1;
                }
                else
                {
                    $create = 0;
                }

                if(isset($access_level_data['read_'.$module_id]))
                {
                    $read = 1;
                }
                else
                {
                    $read = 0;
                }

                if(isset($access_level_data['update_'.$module_id]))
                {
                    $update = 1;
                }
                else
                {
                    $update = 0;
                }

                if(isset($access_level_data['delete_'.$module_id]))
                {
                    $delete = 1;
                }
                else
                {
                    $delete = 0;
                }

                $access_level_count = AccessLevel::where('module_id', $module_id)->where('role_id', $role_id)->count();

                if($access_level_count > 0)
                {
                    $access_level = AccessLevel::where('module_id', $module_id)->where('role_id', $role_id)->first();

                    $access_level->create     = $create;
                    $access_level->read       = $read;
                    $access_level->update     = $update;
                    $access_level->delete     = $delete;
                    $access_level->role_id    = $role_id;
                    $access_level->module_id  = $module_id;
                    $access_level->created_by = $user_id;
                    $access_level->updated_by = $user_id;

                    $access_level->update();

                    return redirect()
                        ->route('access_level_create')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Access level updated successfully!');
                }
                else
                {
                    $access_level = new AccessLevel;

                    $access_level->create     = $create;
                    $access_level->read       = $read;
                    $access_level->update     = $update;
                    $access_level->delete     = $delete;
                    $access_level->role_id    = $role_id;
                    $access_level->module_id  = $module_id;
                    $access_level->created_by = $user_id;
                    $access_level->updated_by = $user_id;

                    $access_level->save();

                    return redirect()
                        ->route('access_level_create')
                        ->with('alert.status', 'success')
                        ->with('alert.message', 'Access level created successfully!');
                }
            }
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('access_level_create')
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry something went wrong! Data cannot updated successfully!');
        }
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $role_id = $id;
        $roles = Role::all();
        $access_levels = AccessLevel::where('role_id', $role_id)->get();

        return view('settings::access_level.edit', compact('roles','access_levels', 'role_id'));
    }

    public function update(Request $request)
    {
        $access_level_data = $request->all();
        $modules = Modules::all();
        $role_id = $access_level_data['role_id'];
        $user_id = Auth::user()->id;

        $length = count($modules);

        try
        {
            foreach($modules as $module)
            {
                $module_id = $module->id;

                if(isset($access_level_data['create_'.$module_id]))
                {
                    $create = 1;
                }
                else
                {
                    $create = 0;
                }

                if(isset($access_level_data['read_'.$module_id]))
                {
                    $read = 1;
                }
                else
                {
                    $read = 0;
                }

                if(isset($access_level_data['update_'.$module_id]))
                {
                    $update = 1;
                }
                else
                {
                    $update = 0;
                }

                if(isset($access_level_data['delete_'.$module_id]))
                {
                    $delete = 1;
                }
                else
                {
                    $delete = 0;
                }

                $access_level_count = AccessLevel::where('module_id', $module_id)->where('role_id', $role_id)->count();

                if($access_level_count > 0)
                {
                    $access_level = AccessLevel::where('module_id', $module_id)->where('role_id', $role_id)->first();

                    $access_level->create     = $create;
                    $access_level->read       = $read;
                    $access_level->update     = $update;
                    $access_level->delete     = $delete;
                    $access_level->role_id    = $role_id;
                    $access_level->module_id  = $module_id;
                    $access_level->created_by = $user_id;
                    $access_level->updated_by = $user_id;

                    $access_level->update();
                }
                else
                {
                    $access_level = new AccessLevel;

                    $access_level->create     = $create;
                    $access_level->read       = $read;
                    $access_level->update     = $update;
                    $access_level->delete     = $delete;
                    $access_level->role_id    = $role_id;
                    $access_level->module_id  = $module_id;
                    $access_level->created_by = $user_id;
                    $access_level->updated_by = $user_id;

                    $access_level->save();
                }
            }

            return redirect()
                ->route('access_level_edit', ['id' => $role_id])
                ->with('alert.status', 'success')
                ->with('alert.message', 'Access level updated successfully!');
        }
        catch (Exception $e)
        {
            return redirect()
                ->route('access_level_edit', ['id' => $role_id])
                ->with('alert.status', 'danger')
                ->with('alert.message', 'Sorry something went wrong! Data cannot updated successfully!');
        }
    }

    public function destroy($id)
    {
        //
    }
}
