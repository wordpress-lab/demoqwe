<?php

namespace App\Modules\Umrah\Http\Controllers\Visa;

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

        return view('umrah::visaprocessing.index',compact('police'));

    }

    public function create()
    {

        $polices =  new \stdClass();
        $polices->id = 1;
        $police[]=$polices;

        return view('umrah::visaprocessing.create',compact('police'));

    }
    public function Edit($id)
    {

        $police = [];

        return view('umrah::visaprocessing.edit',compact('police'));

    }
}
