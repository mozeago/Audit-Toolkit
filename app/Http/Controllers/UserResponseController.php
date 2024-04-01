<?php

namespace App\Http\Controllers;

use App\Models\UserResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserResponseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return View('user-responses');
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
    public function show(UserResponse $userResponse)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserResponse $userResponse)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserResponse $userResponse)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserResponse $userResponse)
    {
        //
    }
}
