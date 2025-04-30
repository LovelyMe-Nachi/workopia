<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\AuthUserRequest;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    // @description  Show login form
    // @route GET /login
    public function login(): View {
        return view('auth.login');
    }

    // @desc  Log in user
    // @route POST /authenticate
    public function authenticate(AuthUserRequest $request): RedirectResponse 
    {
        // Validate the request data
        $credentials = $request->validated();

        // Attempt to log the user in
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(route('home'))
                            ->with('status', 'You are logged in!');
        }

        return back()->withErrors(['email' => 'The provided credentials do not match our recorsds!'])->onlyInput('email');
    }

    public function logout(Request $request): RedirectResponse
    {
        // Log out the user
        Auth::logout(); 

        // Invalidate the session
        $request->session()->invalidate(); 

        // Regenerate the CSRF token
        $request->session()->regenerateToken(); 

        return redirect('/');
    }
}
