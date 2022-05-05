<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FacebookController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});

// Get initial facebook redirection.
Route::get('auth/facebook', [FacebookController::class,'redirectToFacebook'])->name('auth.facebook');

// Get and check the user and save or redirect the user .
Route::get('auth/facebook/callback', [FacebookController::class,'handleFacebookCallback']);
