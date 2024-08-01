<?php

use App\Models\Question;
use App\Services\OpenAIService;
use Illuminate\Support\Facades\Route;

// Route::view('/', 'welcome');

Route::get('/', function () {
    dd(Question::find(3)->load('assistant'));
    dd(app()->make(OpenAIService::class)->retrieveMessages('thread_QPat3AKUoj7t4mLu8EzUyGMt'));
});

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__.'/auth.php';
