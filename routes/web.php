<?php

use Illuminate\Support\Facades\Route;


Route::view('/', 'welcome');
Route::get('/google/redirect', [App\Http\Controllers\GoogleLoginController::class, 'redirectToGoogle'])->name('google.redirect');
Route::get('/google/callback', [App\Http\Controllers\GoogleLoginController::class, 'handleGoogleCallback'])->name('google.callback');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

// Route::get('/google/redirect', [app\Http\Controllers\GoogleController::class, 'redirectToGoogle'])->name('google.redirect');
// Route::get('/google/callback', [app\Http\Controllers\GoogleController::class, 'handleGoogleCallback'])->name('google.callback');

// Route::get('/google/redirect',[GoogleController::class,'handleGoogleRedirect'])->name('handleGoogleRedirect');
// Route::get('/google/callback',[GoogleController::class,'handleGoogleCallback'])->name('handleGoogleCallback');

