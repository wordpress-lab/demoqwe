<?php

namespace App\Modules\Hajj\Http\Controllers\Flight;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $p= new \stdClass();
        $p->id = 1;
        $police[] = $p;

        return view('hajj::flight.index',compact('police'));

    }

    public function Edit($id)
    {

        $police = [];

        return view('hajj::flight.edit',compact('police'));

    }
}
