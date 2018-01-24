<?php

namespace App\Modules\Producttrack\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class ProductItemApiController extends Controller
{
    public function getItemCategory()
    {
        $item_category = DB::table('item_category')->select('item_category_name as text', 'id as value')->get();
        return $item_category;
    }

    public function getItemName($category_id)
    {
        $item_name = DB::table('item')->select('item_name as text', 'id as value')->where('item_category_id', $category_id)->get();
        return $item_name;
    }
}
