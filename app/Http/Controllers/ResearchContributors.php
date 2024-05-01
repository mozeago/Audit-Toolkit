<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ResearchContributors extends Controller
{
    public function index()
    {
        return View('research-contributors');
    }
}
