<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ResearchersController extends Controller
{
    public function index()
    {
        return view("researchers");
    }
}
