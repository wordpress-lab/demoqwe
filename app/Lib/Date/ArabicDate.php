<?php
/**
 * Created by PhpStorm.
 * User: lis
 * Date: 12/3/2017
 * Time: 12:17 PM
 */

namespace App\Lib\Date;


class ArabicDate
{
   public static function Convert($date,$format="d/m/Y") {

         $standard = array("0","1","2","3","4","5","6","7","8","9");
        $eastern_arabic_symbols = array("٠","١","٢","٣","٤","٥","٦","٧","٨","٩");
        $current_date = date($format,strtotime($date));
        $arabic_date = str_replace($standard , $eastern_arabic_symbols , $current_date);

        return $arabic_date;
    }
}