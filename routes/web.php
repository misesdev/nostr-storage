<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\BlobController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\TokensController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [DashboardController::class, 'index'])->middleware('auth');

Route::get('/login', [LoginController::class, 'index'])->name('login');

Route::post('/login', [LoginController::class, 'login']);

Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/forgot', [LoginController::class, 'forgot'])->name('forgot');

Route::post('/forgot', [LoginController::class, 'resetPassword']);

Route::get('/register', [RegisterController::class, 'index'])->name('register');

Route::post('/register', [RegisterController::class, 'register']);

// Account Group
Route::middleware('auth')->prefix('user')->group(function() {

    Route::get('/account', [AccountController::class, 'index']);

    Route::post('/upload', [BlobController::class, 'upload']);

    Route::post('/file/delete/{file}', [BlobController::class, 'delete']);

    Route::post('/update', [AccountController::class, 'update']);

    Route::post('/update-profile', [AccountController::class, 'updateProfile']);

    Route::post('/update-password', [AccountController::class, 'updatePassword']);

});


// Tokens Manage Group
Route::prefix('tokens')->group(function() {

    Route::get('/manage', [TokensController::class, 'index']);

    Route::post('/create', [TokensController::class, 'create']);

    Route::get('/delete/{id}', [TokensController::class, 'delete']);

})->middleware('auth');







