<?php

namespace App\Http\Controllers;

use App\Models\Metrics;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlobController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'archive' => ['required', 'image', 'max:2048']
        ]);

        $user = auth()->user();
        $token = $user->tokens->first();

        if(empty($token)) {
            return back()->withErrors([
                'token' => 'You do not have an upload token, please create one to perform uploads'
            ]);
        }

        if(empty($request->query("token", null))) {
            $token_dir = $token->token;
        } else {
            $token_dir = $request->token;
        }

        if(empty($token_dir)) {
            back()->withErrors([
                'token' => 'You do not have an upload token, please create one to perform uploads'
            ]);
        }

        $path = $request->file('archive')->storePublicly('files/storage/'.substr($token_dir, 0, 25));

        return redirect($path);
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'archive' => ['required', 'image', 'max:2048']
        ]);

        $user = auth()->user();
        $token = $user->tokens->first();

        if(empty($token)) {
            return response("You do not have an upload token, please create one to perform uploads", 403);
        }

        if(empty($request->query("token", null))) {
            $token_dir = $token->token;
        } else {
            $token_dir = $request->token;
        }

        $path = $request->file('archive')->storePublicly('files/storage/'.substr($token_dir, 0, 25));

        Metrics::create([
            'user_id' => $user->id,
            'archive' => $path
        ]);

        return url('/').'/'.$path;
    }

    public function delete($image)
    {
        $token_dir = auth()->user()->tokens->first()->token;

        Storage::delete('files/storage/'.substr($token_dir, 0, 25).'/'.$image);

        return [
            'success' => true,
            'message' => 'deleted image succefuly'
        ];
    }
}
