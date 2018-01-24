<?php

namespace App\Modules\Invoice\Http\Controllers\Pdf;

use Illuminate\Http\Request;
use mPDF;
use App\Lib\Date\ArabicDate;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
   public function index()
   {
       dd("asds");
   }
   /*
    * finance application
    */
   public function contractApplication(){

       $date= ArabicDate::Convert("12-05-2017","Y/m/d");
       $mpdf = new mPDF('utf-8', 'A4');
       $data = array("1","5","2","5","4","5","4","5","4","85","4","5","4","5","4","5","4","5","4","0");
       $view =  view('invoice::pdfapplication.contactApplication',compact('data','date'));
       $mpdf->WriteHTML($view);
       $mpdf->Output();
   }

}
