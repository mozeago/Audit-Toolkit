<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SecuritySubSectionsController extends Controller
{
    public function index(): View
    {
        return view('security-sub-sections');
    }
}
