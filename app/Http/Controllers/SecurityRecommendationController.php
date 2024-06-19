<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SecurityRecommendationController extends Controller
{
    public function index(): View
    {
        return view('security-recommendation');
    }
}
