<?php

namespace App\Http\Controllers;

use App\Models\User;
use Auth;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login()
    {
        return view('pages.auth.login');
    }

    public function login_store(Request $req): RedirectResponse
    {
        return redirect()->intended('/dashboard');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('home');
    }

    public function google_redirect()
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
            $user = User::firstOrFail('email', $googleUser->getEmail());

            Auth::login($user);

            return redirect()->intended('/dashboard');

        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }
}
