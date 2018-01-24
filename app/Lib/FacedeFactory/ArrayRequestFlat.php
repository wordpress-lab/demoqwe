<?php

namespace App\Lib\FacedeFactory;

use RecursiveArrayIterator;
use RecursiveIteratorIterator;

class ArrayRequestFlat
{
   public function Flatten($data=[])
   {
       $refine_ref= [];
       if(is_array($data))
       {
           $ref = new RecursiveIteratorIterator(new RecursiveArrayIterator($data));
           foreach($ref as $value)
           {
               if(!empty($value))
               {
                   $refine_ref[] = $value;
               }

           }



           return $refine_ref;
       }
       return null;
   }
}