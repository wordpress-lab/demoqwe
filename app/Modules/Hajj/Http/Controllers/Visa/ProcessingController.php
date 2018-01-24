<?php

namespace App\Modules\Hajj\Http\Controllers\Visa;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProcessingController extends Controller
{
    public function index()
    {

        $polices =  new \stdClass();
        $polices->id = 1;
        $police[]=$polices;

        return view('hajj::visaprocessing.index',compact('police'));

    }

    public function create()
    {

        $polices =  new \stdClass();
        $polices->id = 1;
        $police[]=$polices;

        return view('hajj::visaprocessing.create',compact('police'));

    }
    public function Edit($id)
    {

        $police = [];

        return view('hajj::visaprocessing.edit',compact('police'));

    }
}
