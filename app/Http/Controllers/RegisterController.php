<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('pages.Auth.register');
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'username' => 'required',
            'fullname' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required|min:3',
        ]);

        $credentials['password'] = Hash::make($credentials['password']);

        $user = User::create($credentials);

        return redirect()->route('login')->with('success', 'Register success!');
    }
}
