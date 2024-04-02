<?php

namespace App\Http\Controllers;

use App\Models\RiskInformation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiskInformationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return View('risk-information');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(RiskInformation $riskInformation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiskInformation $riskInformation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RiskInformation $riskInformation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiskInformation $riskInformation)
    {
        //
    }
}
