<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class SecurityInformationController extends Controller
{
    public function index(): View
    {
        return view('security-information');
    }
}
