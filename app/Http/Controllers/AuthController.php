<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Show the login form.
    public function showLogin()
    {
        return view('auth.login');
    }

    // Check the email and password. On success, go to the admin posts list.
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();   // protects against session fixation
            return redirect()->intended(route('posts.index'));
        }

        return back()
            ->withErrors(['email' => 'The email or password is incorrect.'])
            ->onlyInput('email');
    }

    // Log out, clear the session, and return to the public blog.
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('blog.index');
    }
}
