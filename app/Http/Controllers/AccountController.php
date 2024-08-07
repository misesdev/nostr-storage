<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AccountController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('user.account.index', ['user' => $user]);
    }

    public function update(Request $request)
    {
        $properties = $request->validate([
            'name' => ['required', 'min:5', 'max:100'],
            'email' => ['required', 'min:5', 'max:80']
        ]);

        auth()->user()->update($properties);

        return redirect('user/account')->with([ 'message' => 'Updated account informations!']);
    }

    public function updateProfile(Request $request)
    {
        $request->validate([
            'archive' => ['required', 'image', 'max:2000']
        ]);

        $path = $request->file('archive')->storePublicly('profiles');

        auth()->user()->update([
            'profile' => $path
        ]);

        return redirect('/user/account')->with(['message' => 'Updated profile picture!']);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password' => ['required', 'min:5'],
            'new_password' => ['required', 'min:5'],
            'confirm_password' => ['required', 'min:5']
        ]);

        if($request->new_password != $request->confirm_password) {
            return back()->withErrors([
                'confirm_password' => 'Passwords do not match!',
                //'new_password' => 'Passwords do not match!'
            ]);
        }

        $user = auth()->user();

        if(Auth::attempt(['email' => $user->email, 'password' => $request->password]))
        {
            $request->session()->regenerate();

            return back()->withErrors([
                'password' => 'incorrect password!'
            ]);
        }

        $user->update(['password' => $request->new_password]);

        return redirect('/user/account')->with([ 'message' => 'Updated password!']);
    }
}
