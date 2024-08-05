<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class BlobController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'archive' => ['required']
        ]);

        $user_dir = str_replace(" ", "-", auth()->user()->name);


        $path = $request->file('archive')->storePublicly('storage/'.$user_dir);

        return redirect($path);
    }

    public function uploadFile(Request $request)
    {
        $request->validate([
            'archive' => 'required'
        ]);

        $user_dir = str_replace(" ", "-", auth()->user()->name);

        $path = $request->file('archive')->storePublicly('storage/'.$user_dir);

        return $path;
    }

    public function delete($image)
    {
        $user_dir = str_replace(" ", "-", auth()->user()->name);

        Storage::delete('storage/'.$user_dir.'/'.$image);

        return [
            'success' => true,
            'message' => 'deleted image succefuly'
        ];
    }
}
