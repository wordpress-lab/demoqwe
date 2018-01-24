<?php
/**
 * Created by PhpStorm.
 * User: Ontik Technology 3
 * Date: 05-08-17
 * Time: 14.35
 */

namespace App\Lib;


class Concatenote
{
   function todaynote($content){

   if(empty($content))
   {
     return null;
   }else
   {
       foreach ($content as $value)

           return $value;
     }
   }

}