<?php

use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\GirioneSSOController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
Route::redirect("/","/dashboard");
Route::get("/test", [TestController::class, 'redirect'])->name('test');

Route::get('/login', function () {
    return view('login');
})->name('login');


Route::middleware('auth')->get('/dashboard', function () {
    return view('dashboard');
})->name('dashboard');


Route::middleware('auth')->post('/logout', function () {
    Auth::logout();
    return redirect()->route('login');
})->name('logout');

// Girione SSO (GiriOne) manual OAuth2 Authorization Code Flow
Route::get('auth/girione', [GirioneSSOController::class, 'redirect'])->name('girione.redirect');
Route::get('auth/girione/callback', [GirioneSSOController::class, 'callback'])->name('girione.callback');

// Socialite dynamic providers (exclude girione so it doesn't get intercepted)
Route::get('auth/{provider}', [SocialiteController::class, 'redirect'])
    ->where('provider', '^(?!girione$)[A-Za-z0-9_-]+$')
    ->name('socialite.redirect');

Route::get('auth/{provider}/callback', [SocialiteController::class, 'callback'])
    ->where('provider', '^(?!girione$)[A-Za-z0-9_-]+$')
    ->name('socialite.callback');