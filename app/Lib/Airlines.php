<?php
/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 20-07-17
 * Time: 17.55
 */

namespace App\Lib;


use App\Models\Visa\Ticket\Airline\Airlinetax;

class Airlines
{

    public function AirlineTax($id)
    {

     $tax = Airlinetax::where('airline_id',$id)->get();
        $data = null;
      foreach ($tax as $item){

       $data .=$item->AirlineTax->title.",";
      }

      return $data;
    }

}