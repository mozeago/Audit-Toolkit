<?php

namespace App\Http\Controllers;

use Illuminate\View\View;
use Illuminate\Http\Request;

class UsersSettings extends Controller
{
    public function index(): View
    {
        return View('user-settings');
    }
}
