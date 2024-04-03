<?php

namespace App\Http\Controllers;

use App\Models\RiskRecommendation;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiskRecommendationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return View('risk-recommendation');
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
    public function show(RiskRecommendation $riskRecommendation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiskRecommendation $riskRecommendation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RiskRecommendation $riskRecommendation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiskRecommendation $riskRecommendation)
    {
        //
    }
}
