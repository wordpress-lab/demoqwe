<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\AccessLevel\Modules;
use App\Models\AccessLevel\AccessLevel;
use Illuminate\Support\Facades\Auth;

class CreateAccess
{
    public function handle($request, Closure $next)
    {



        $user = Auth::user();
        $user_role = $user->role_id;

        $d_prefix = $request->route()->getPrefix();
        $prefix = substr($d_prefix, 1);

        $module = Modules::where('module_prefix', $prefix)->first();
        if(!isset($module->id))
        {
            return redirect()->back()
                ->with('alert.status', 'warning')
                ->with('alert.message', 'You don\'t have enough permission to perform this operation!');
        }

        $module_id = $module->id;

        $access = AccessLevel::where('role_id', $user_role)->where('module_id', $module_id)->first();

        if(!isset($access->read))
        {
            return redirect()->back()
                ->with('alert.status', 'warning')
                ->with('alert.message', 'You don\'t have enough permission to perform this operation!');
        }

        if($access->create == 0)
        {
            return redirect()->back()
                ->with('alert.status', 'warning')
                ->with('alert.message', 'You don\'t have enough permission to perform this operation!');
        }

        return $next($request);
    }
}
