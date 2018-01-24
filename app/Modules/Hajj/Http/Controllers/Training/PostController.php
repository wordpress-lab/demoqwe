<?php

namespace App\Modules\Hajj\Http\Controllers\Training;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $p = new \stdClass();
        $p->id = 1;
        $police[] = $p;

        return view('hajj::training.index',compact('police'));

    }


    public function create()
    {
        $p = new \stdClass();
        $p->id = 1;
        $police[] = $p;



        return view('hajj::training.create',compact('police'));

    }

    public function store(Request $request)
    {


        dd($request->all());
        return view('hajj::training.create',compact('police'));

    }
    public function Edit($id)
    {

        $police = [];

        return view('hajj::training.edit',compact('police'));

    }
}
