<?php
namespace App\Modules\Order\Http\Response;
use App\Models\Recruit\Recruitorder;
use App\Models\Recruit_Customer\Recruit_customer;
use Illuminate\Http\Request;

/**
 * Created by Rayhan.
 * User: Ontik
 * Date: 11/15/2017
 * Time: 4:15 PM
 */
class RecruitCustomer
{
    public function store($request,$recruite_order)
    {
      if(!$request instanceof Request)
      {
          return null;
      }
      if(!$recruite_order instanceof Recruitorder || is_null($recruite_order))
      {
          return null;
      }
      $gender =$request['gender'];
      $updatecustomer =Recruit_customer::updateOrCreate(
            ['pax_id' => $recruite_order->id,'recruit_id'=> $recruite_order->id],
            ['gender' => $gender,'pax_id' => $recruite_order->id, 'recruit_id' => $recruite_order->id]
      );
      if($updatecustomer)
      {
          return true;
      }
      else
      {
          return null;
      }
    }


}
