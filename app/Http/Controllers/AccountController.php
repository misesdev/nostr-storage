<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
            'archive' => 'required'
        ]);

        $path = $request->file('archive')->storePublicly('profiles');

        auth()->user()->update([
            'profile' => $path
        ]);

        return redirect('/user/account')->with([ 'message' => 'Updated profile picture!']);
    }
}
