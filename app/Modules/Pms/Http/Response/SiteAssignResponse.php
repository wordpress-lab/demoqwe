<?php
/**
 * Created by PhpStorm.
 * User: ontik
 * Date: 12/5/2017
 * Time: 4:54 PM
 */

namespace App\Modules\Pms\Http\Response;


use App\Models\Pms\Pms_Employee;

class SiteAssignResponse
{

    public function store($request)
     {
      $receive = Pms_Employee::whereIn('id', $request->empcode)->update(['site_name' => $request->site_name]);
      if(!$receive){
          throw new \Exception();
      }
      return $receive;
    }
    public function update($emp,$req)
    {

        $emp->site_name = $req->site_name;
        $emp->save();
        if(!$emp){
            throw new \Exception();
        }
        return $emp;
    }
    public function remove($emp)
    {
        $emp->site_name = null;
        $emp->save();
        if(!$emp){
            throw new \Exception();
        }
        return $emp;
    }
}