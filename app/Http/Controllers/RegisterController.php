<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterUserRequest;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class RegisterController extends Controller
{
    // @description  Show register form
    // @route GET /register
    public function register(): View {
        return view('auth.register');
    }

    // @description  Store new user
    // @route POST /register
    public function store(RegisterUserRequest $request): RedirectResponse {
        // Validate the incoming request data
        $validatedData = $request->validated();

        $validatedData['password'] = Hash::make($validatedData['password']);

        $user = User::create($validatedData);

        Auth::login($user);

        return redirect()->route('login')->with('success','You have been registered successfully. You can now login in!!');
    }
}
