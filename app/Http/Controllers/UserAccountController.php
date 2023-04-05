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
        //* $user->password = Hash::make($user->password); // Hashing with bcrypt by default --> don't have to write this if you have hash password globally (see User.php)
        //* $user->save(); // Save to database // don't need this if you hash globally. Change User::make to User::create
        Auth::login($user); // This would log them in after account is created

        return redirect()->route("listing.index")
            ->with("success", "Account created!");
    }
}
