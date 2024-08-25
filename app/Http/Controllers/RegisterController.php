<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    public function index()
    {
        $title = 'Register Page';
        return view('auth.register', compact('title'));
    }

    public function register(Request $request)
    {
        $credentials = $request->validate([
            'username' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        $credentials['password'] = Hash::make($credentials['password']);

        $user = User::create($credentials);


        Auth::login($user);
        return redirect('/');
    }
}
