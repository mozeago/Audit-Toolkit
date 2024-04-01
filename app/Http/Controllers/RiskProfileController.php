<?php

namespace App\Http\Controllers;

use App\Models\RiskProfile;
use Illuminate\Http\Request;
use Illuminate\View\View;

class RiskProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        return View('risk-profile-dashboard');
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
    public function show(RiskProfile $riskProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(RiskProfile $riskProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, RiskProfile $riskProfile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(RiskProfile $riskProfile)
    {
        //
    }
}
