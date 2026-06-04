<?php

namespace App\Http\Controllers;

use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use Laravel\Socialite\Facades\Socialite;

class AuthController extends Controller
{
    public function login(): View
    {
        return view('pages.auth.login');
    }

    public function login_store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(route('admin.dashboard'));
    }

    public function logout(Request $request): RedirectResponse
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('home');
    }

    public function google_redirect(): RedirectResponse
    {
        return Socialite::driver('google')->redirect();
    }

    public function google_callback(): RedirectResponse
    {
        try {
            $googleUser = Socialite::driver('google')->user();

            $user = User::firstOrCreate(
                ['email' => $googleUser->getEmail()],
                [
                    'name' => $googleUser->getName() ?? $googleUser->getNickname() ?? 'Usuário Google',
                    'google_id' => $googleUser->getId(),
                    'password' => bcrypt(str()->random(40)),
                    'email_verified_at' => now(),
                ],
            );

            if (! $user->google_id) {
                $user->update(['google_id' => $googleUser->getId()]);
            }

            Auth::login($user, remember: true);

            return redirect()->intended(route('admin.dashboard'));
        } catch (Exception $e) {
            return redirect()
                ->route('login')
                ->with('error', 'Não foi possível autenticar com o Google: '.$e->getMessage());
        }
    }
}
