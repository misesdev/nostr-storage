<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    //
    public function index(Request $request)
    {
        return view('register/index');
    }

    public function register(User $user)
    {
        // implements register
        dd($user->name);

        return redirect("/login");
    }

}
