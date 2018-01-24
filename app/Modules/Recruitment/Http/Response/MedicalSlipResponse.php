<?php
namespace App\Modules\Recruitment\Http\Response;
/**
 * Created by PhpStorm.
 * User: ontik
 * Date: 12/12/2017
 * Time: 12:49 PM
 */
class MedicalSlipResponse
{
  public function recruitConvertToArray($request,$medical_id)
  {
      if(!isset($request->recruit_id)||!isset($request->recruit_id) || !isset($request->recruit_id))
      {
        return [];
      }
      $newData =  [];
      $passport_receive = array_intersect($request->recruit_id,$request->received_status);
      $passport_return = array_intersect($passport_receive, $request->submitted_status);
      foreach($request->recruit_id as $item)
      {
          $p_ret = null;
          $rec = null;
          if(in_array($item, $passport_receive))
          {
            $rec = 1;
          }
          if(in_array($item, $passport_return))
          {
              $p_ret = 1;
          }
         $newData[$item] = ['updated_at'=>date("Y-m-d H:i:s"),'created_at'=>date("Y-m-d H:i:s"),'pax_id'=>$item,"received_status"=>$rec,'submitted_status'=>$p_ret,"medical_slip_form_id"=>$medical_id];
      }

      return $newData;
  }
}