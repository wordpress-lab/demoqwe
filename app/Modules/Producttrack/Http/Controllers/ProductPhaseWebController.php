<?php

namespace App\Modules\Producttrack\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class ProductPhaseWebController extends Controller
{
    public function index()
    {
        return view('producttrack::phase.index');
    }

    public function create()
    {
        return view('producttrack::phase.create');
    }

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        return view('producttrack::phase.edit');
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
