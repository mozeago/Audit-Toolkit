<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class SecurityQuestionsController extends Controller
{
    public function index(): View
    {
        return View('security-questions');
    }
}
