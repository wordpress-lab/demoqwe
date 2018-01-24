<?php

namespace App\Modules\Umrah\Http\Controllers\Police;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ClearenceController extends Controller
{
   public function index()
   {
     $polices = new \stdClass();
     $polices->id = 1;

     $police[] = $polices;

     return view('umrah::police.clearance.index',compact('police'));

   }

    public function Edit($id)
    {

        $police = [];

        return view('umrah::police.clearance.edit',compact('police'));

    }
}
