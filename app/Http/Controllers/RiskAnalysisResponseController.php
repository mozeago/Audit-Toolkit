<?php

namespace App\Http\Controllers;

use App\Models\RiskAnalysisResponse;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;

class RiskAnalysisResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return View('risk-analysis-questionnaire');
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
    public function show(RiskAnalysisResponse $riskAnalysisResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiskAnalysisResponse $riskAnalysisResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RiskAnalysisResponse $riskAnalysisResponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiskAnalysisResponse $riskAnalysisResponse)
    {
        //
    }
}
