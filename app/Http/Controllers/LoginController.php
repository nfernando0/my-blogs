<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index()
    {
        return view('pages.Auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:3',
        ]);

        if (auth()->attempt($credentials)) {
            if(auth()->user()->role == 'admin') {
                return redirect()->route('dashboard');
            } else {
                return redirect()->route('home')->with('success', 'Login successfully!');
            }
        }

        return redirect()->back()->with('error', 'Login failed!');
    }

    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();

        $request->session()->regenerate();

        return redirect()->route('home')->with('success', 'Logout successfully!');
    }
}
