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
            'archive' => ['required', 'image', 'max:1000']
        ]);

        if(empty($request->token)) {
            $token_dir = auth()->user()->tokens->first()->token;
        } else {
            $token_dir = $request->token;
        }

        $path = $request->file('archive')->storePublicly('storage/'.$token_dir);

        return redirect($path);
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'archive' => ['required', 'image', 'max1000']
        ]);

        $user = auth()->user();

        if(empty($request->token)) {
            $token_dir = $user->tokens->first()->token;
        } else {
            $token_dir = $request->token;
        }

        $path = $request->file('archive')->storePublicly('storage/'.$token_dir);

        Metrics::create([
            'user_id' => $user->id,
            'archive' => $path
        ]);

        return url('/').'/'.$path;
    }

    public function delete($image)
    {
        $token_dir = auth()->user()->tokens->first()->token;

        Storage::delete('storage/'.$token_dir.'/'.$image);



        return [
            'success' => true,
            'message' => 'deleted image succefuly'
        ];
    }
}
