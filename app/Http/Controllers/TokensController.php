<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokensController extends Controller
{
    public function index()
    {

        return view('user.tokens.index');
    }

    public function create(Request $request)
    {

        return view('user.tokens.create');
    }

    public function delete($id)
    {
        return true;
    }
}
