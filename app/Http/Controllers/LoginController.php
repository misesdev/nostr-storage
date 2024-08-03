<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index()
    {
        if(session()->has('name'))
        {
            return redirect('/');
        }

        return view('login.index');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required'],
            'password' => ['required']
        ]);

        if(Auth::attempt($credentials))
        {
            $request->session()->regenerate();

            return redirect('/');
        }

        return back()->withErrors([
            'auth' => 'The provided credentials do not match our records!'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/login');
    }

    public function forgot()
    {
        if(session()->has('email'))
        {
            return redirect('/');
        }

        return view('login.forgot');
    }

    public function resetPassword(Request $request)
    {
        return redirect('/login');
    }
}
