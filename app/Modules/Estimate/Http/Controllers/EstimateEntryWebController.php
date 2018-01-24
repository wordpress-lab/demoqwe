<?php

namespace App\Modules\Estimate\Http\Controllers;

use App\Models\OrganizationProfile\OrganizationProfile;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EstimateEntryWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('estimate::index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function pdf()
    {
        $OrganizationProfile = OrganizationProfile::find(1);

        $pdf = PDF::loadView('estimate::estimate.pdf',compact('OrganizationProfile'));
        return $pdf->stream();
    }

    public function terms()
    {
        $OrganizationProfile = OrganizationProfile::find(1);

        $pdf = PDF::loadView('estimate::estimate.terms',compact('OrganizationProfile'));
        return $pdf->stream();
    }
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
