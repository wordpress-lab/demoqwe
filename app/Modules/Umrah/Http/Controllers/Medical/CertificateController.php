<?php

namespace App\Modules\Umrah\Http\Controllers\Medical;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class CertificateController extends Controller
{
    public function index()
    {
       $polices =  new \stdClass();
        $polices->id = 1;
        $police[]=$polices;

        return view('umrah::medical.certificate.index',compact('police'));

    }

    public function Edit($id)
    {

        $police=[];

        return view('umrah::medical.certificate.edit',compact('police'));

    }
}
