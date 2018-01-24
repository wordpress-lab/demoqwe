<?php

namespace App\Modules\Umrah\Http\Controllers\GiftPack;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index()
    {
        $p = new \stdClass();
        $p->id= 1;
        $police[] =$p;

        return view('umrah::GiftPack.index',compact('police'));

    }

    public function create()
    {
        $p = new \stdClass();
        $p->id= 1;
        $police[] =$p;

        return view('umrah::GiftPack.create',compact('police'));

    }

    public function Edit($id)
    {

        $police = [];

        return view('umrah::GiftPack.edit',compact('police'));

    }
}
