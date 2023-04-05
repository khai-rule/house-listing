<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class UserAccountController extends Controller
{
    public function create() 
    {
        return inertia("UserAccount/Create");
    }

    public function store(Request $request) 
    {
        $user = User::create($request->validate([
            "name" => "required",
            "email" => "required|email|unique:users",
            "password" => "required|min:8|confirmed", // When using "confirmed", Laravel will expect another field called password_confirmation 
        ]));
        $user->password = Hash::make($user->password); // Hashing with bcrypt by default
        $user->save(); // Save to database
        Auth::login($user); // This would log them in after account is created

        return redirect()->route("listing.index")
            ->with("success", "Account created!");
    }
}
