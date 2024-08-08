<?php

use App\Http\Controllers\OAuthController;
use App\Http\Controllers\WelcomeController;
use App\Models\Question;
use App\Services\OpenAIService;
use Illuminate\Support\Facades\Route;

Route::get('/auth/{provider}/redirect', [OAuthController::class, 'redirect'])->name('auth.redirect');
Route::get('/auth/{provider}/callback', [OAuthController::class, 'callback'])->name('auth.callback');

Route::get('/', [WelcomeController::class, 'welcome'])->name('welcome');

Route::get('/styling-guide', [WelcomeController::class, 'styling_guide'])->name('styling_guide');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';

