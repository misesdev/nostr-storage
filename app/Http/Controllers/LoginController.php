<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function index(Request $request)
    {
        return view('login.index');
    }

    public function login(Request $request)
    {
        // implements login

        return redirect('/');
    }

    public function forgot(Request $request)
    {
        return view('login.forgot');
    }

}
