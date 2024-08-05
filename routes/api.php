<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\BlobController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Api routes authenticated
Route::middleware('auth:sanctum')->prefix('storage')->group(function() {

    Route::post('/upload', [BlobController::class, 'uploadFile']);

    Route::post('/delete/{image}', [BlobController::class, 'delete']);

});




