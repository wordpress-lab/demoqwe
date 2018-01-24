<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Dompdf\Dompdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use mPDF;


class PdfController extends Controller
{
    public function getPdf(){
        $pdf = PDF::loadView('boss');
        return $pdf->stream();

    }

    public function medical(){

        return view('medical_slip');

    }
    public function potro_1(){

        return view('potro_1');
    }
    public function potro_2(){

        return view('potro_2');
    }
    public function potro_3(){

        return view('potro_3');


    }

    public function document(){

        //return view('document');

        $mpdf = new mPDF('utf-8', 'A4-L');
        $view =  view('document');

        $mpdf->WriteHTML($view);
        $mpdf->Output();

    }

    public function immegration_1(){

        return view('immigration_1');
    } public function immegration_2(){

        return view('immigration_2');
    }
    public function immegration_3(){

        return view('immigration_3');
    }
  public function immegration_4()
  {
   return view('immigration_4');
  }
  public function note_sheet()
  {
      //return view('note_sheet');
      $mpdf = new mPDF('utf-8', 'A4-L');
      $view =  view('note_sheet');
      $mpdf->WriteHTML($view);
      $mpdf->Output();
  }

    public function rabahinternational(){

       $mpdf = new mPDF('utf-8', 'A4-P');
        $view =  view('rabahinternational');
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }
    public function visaacceptance(){

        $mpdf = new mPDF('utf-8', 'A4');
        $view =  view('visaacceptance');
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }


    public function work_agreement(){

       //return view('note_sheet');
        $mpdf = new mPDF('utf-8', 'A4');
        $view =  view('work_agreement');
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }


    public function test(){

        $mpdf = new mPDF('utf-8', 'A4-L');
        $view =  view('test');
        $mpdf->WriteHTML($view);
        $mpdf->Output();

    }



    public function visa(){

     return view('visa');
    }
    public function billing(){

        $mpdf = new mPDF('utf-8', 'A4-L');
        $view =  view('billing');
        $mpdf->WriteHTML($view);
        $mpdf->Output();
    }

    public function mail(){
        return view('email');
    }

    public function Pdf2(){

        //return view('document');

        $mpdf = new mPDF('utf-8', 'A4-P');
        $view =  view('visa2');

        $mpdf->WriteHTML($view);
        $mpdf->Output();

    }

    public function test2(){

        $mpdf = new mPDF('utf-8', 'A4-P');
        $view =  view('test2');
        $mpdf->WriteHTML($view);
        $mpdf->Output();

    }

    public function group(){

        $mpdf = new mPDF('utf-8', 'A4-P');
        $view =  view('group');
        $mpdf->WriteHTML($view);
        $mpdf->Output();

    }






}
