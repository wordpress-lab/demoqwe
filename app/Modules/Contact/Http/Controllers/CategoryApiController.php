<?php

namespace App\Modules\Contact\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use DB;

class CategoryApiController extends Controller
{
    public function getContactCategory()
    {
        $category = DB::table('contact_category')->select('contact_category_name as text', 'id as value')->get();
        $agent = DB::table('agents')
            ->select('display_name as text', 'id as value')->get();

        return response()->json([
            'category'   =>  $category,
            'agent'   =>  $agent,
        ], 201);

    }
}
