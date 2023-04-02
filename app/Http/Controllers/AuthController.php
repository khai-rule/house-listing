<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // Display the form to sign in
    public function create() {
        return inertia("Auth/Login");
    }

    // WHen the form is submitted - create session if valid
    public function store(Request $request) {
        
        if (Auth::attempt($request->validate([
            "email" => "required|string|email",
            "password" => "required|string"
        ]), true /* "remember me" */)) {
            throw ValidationException::withMessages([
                "email" => "Authentication failed"
            ]);
        }

        // regenerate to avoid attackers using the same ID to send to victims which may get their data
        $request->session()->regenerate();

        return redirect()->intended();
    }

    // Sign out
    public function destroy() {}
}
