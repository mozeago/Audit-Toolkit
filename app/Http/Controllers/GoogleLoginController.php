<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ProvidersRouteServiceProvider;

class GoogleLoginController extends Controller
{
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }


    public function handleGoogleCallback()
    {
        $googleUser = Socialite::driver('google')->user();
        $user = User::where('email', $googleUser->email)->first();
        if (!$user) {
            $user = User::create(['name' => $googleUser->name, 'email' => $googleUser->email, 'password' => \Hash::make(rand(100000, 999999))]);
        }

        Auth::login($user);

        if ($this->riskAnalysisCompleted() === 'true') {
            return redirect('dashboard');
        } else {
            return redirect('risk-analysis-questionnaire');
        }
    }
    public function riskAnalysisCompleted()
    {
        $userId = auth()->id();
        return User::find($userId)->qa_analysis_complete ?? false;
    }
}
