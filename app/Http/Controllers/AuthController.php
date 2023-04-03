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
        
        if (!Auth::attempt($request->validate([
            'email' => 'required|string|email', // This is to find specific user in user table by that key (so this can also be username but make sure it exist in the table)
            'password' => 'required|string' // This is necessary
        ]), true /* "remember me" */)) {
            throw ValidationException::withMessages([
                'email' => 'Authentication failed'
            ]);
        }

        // regenerate to avoid attackers using the same ID to send to victims which may get their data
        $request->session()->regenerate();

        // if intended() has no argument, by default it will take you to "/" 
        return redirect()->intended("/listing");
    }

    // Sign out
    public function destroy() {}
}
