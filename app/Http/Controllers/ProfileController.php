<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function index()
    {
        $title = 'Profile Page';

        $user = User::find(auth()->user()->id);

        return view('content.profile.index', compact('title', 'user'));
    }

    public function update(Request $request)
    {
        $user = User::find(auth()->user()->id);
        $user->email = $request->input('email');
        $user->username = $request->input('username');
        $user->address = $request->input('address');
        $user->phone = $request->input('phone');

        $oldPassword = $request->input('old_password');
        $newPassword = $request->input('new_password');
        $confirmPassword = $request->input('confirm_password');

        if (!Hash::check($oldPassword, $user->password)) {
            return redirect()->back()->with('error', 'Old password does not match');
        }

        if ($newPassword != $confirmPassword) {
            return redirect()->back()->with('error', 'Password does not match');
        }

        $user->password = Hash::make($newPassword);
        $user->save();

        return redirect()->back()->with('success', 'Profile updated successfully');
    }
}
