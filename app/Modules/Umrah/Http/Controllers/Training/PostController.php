<?php

namespace App\Modules\Umrah\Http\Controllers\Training;

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

        return view('umrah::training.index',compact('police'));

    }


    public function create()
    {
        $p = new \stdClass();
        $p->id = 1;
        $police[] = $p;



        return view('umrah::training.create',compact('police'));

    }

    public function store(Request $request)
    {


        dd($request->all());
        return view('umrah::training.create',compact('police'));

    }
    public function Edit($id)
    {

        $police = [];

        return view('umrah::training.edit',compact('police'));

    }
}
