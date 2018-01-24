<?php

namespace App\Modules\Visa\Http\Controllers\Embassy;

use App\Lib\Date\ArabicDate;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use mPDF;
class PostController extends Controller
{
    public function officeList()
    {
        $date= ArabicDate::Convert("12-05-2017","Y/m/d");
        $mpdf = new mPDF('utf-8', 'A4');
        $data = array("1","5","2","5","4","5","4","5","4","85","4","5","4","5","4","5","4","5","4","0");
        $view =  view('visa::Embassy.officelist',compact('date','data'));
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }
    public function jobSeeker()
    {

        $mpdf = new mPDF('utf-8', 'A4');
        $data = array("1","5","2","5","4","5","4","5","4","85","4","5","4","5","4","5","4","5","4","0");
        $view =  view('visa::Embassy.jobseeker',compact('data'));
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }
}
