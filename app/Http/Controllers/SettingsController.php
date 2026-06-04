<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class SettingsController extends Controller
{
    public function edit(User $user)
    {
        return view('pages.admin.settings.edit', compact('user'));
    }

    public function update(Request $req, User $user): RedirectResponse
    {
        $req->validate([
            'email' => 'required|email',
            'name' => 'required|min:3',
            'password' => 'required|min:6',
            'password_confirmation' => 'required|same:password'
        ]);

        try {
            $user->name = $req->input('name');
            $user->email = $req->input('email');
            $user->password = $req->input('password');
            $user->save();
        } catch (Exception $e) {
            return redirect()->back()->withErrors($e->getMessage());
        }
        return redirect()->route('dashboard');
    }
}
