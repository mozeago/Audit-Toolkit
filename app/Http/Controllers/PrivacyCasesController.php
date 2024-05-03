<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class PrivacyCasesController extends Controller
{
    public function index()
    {
        return View('privacycases');
    }
}
