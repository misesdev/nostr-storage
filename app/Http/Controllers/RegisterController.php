<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    public function index()
    {
        if(session()->has('email'))
        {
            return redirect('/');
        }

        return view('register/index');
    }

    public function register(Request $request)
    {
        $user = $request->validate([
            'name' => ['required', 'max:50', 'min:5'],
            'email' => ['required', 'max:100', 'unique:users'],
            'password' => ['required']
        ]);

        if($request->password != $request->password_confirm)
        {
            return back()->withErrors([
                'password_confirm' => 'Passwords do not match!'
            ]);
        }

        User::create($user);

        return redirect("/login");
    }
}
