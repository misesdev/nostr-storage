<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TokensController extends Controller
{
    public function index()
    {
        $tokens = auth()->user()->tokens;

        return view('user.tokens.index', ['tokens' => $tokens]);
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => ['required', 'max:50', 'min:5', 'unique:personal_access_tokens'],
            'expires' => ['required']
        ]);

        auth()->user()->createToken($request->name, ['*'], $request->date('expires'));

        return redirect('/tokens/manage');
    }

    public function delete($id)
    {
        auth()->user()->tokens()->where('id', $id)->delete();

        return redirect('/tokens/manage');
    }
}
