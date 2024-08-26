<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Event;
use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;


class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }
 
   
    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::listen(Login::class, function ($event) {
            $user = $event->user;
            Log::info('User logged in:', ['id' => $user->id, 'email' => $user->email]);
        });
        Event::listen(Logout::class, function ($event) {
            $user = $event->user;
            Log::info('User logged out:', ['id' => $user->id, 'email' => $user->email]);
        });
    }
}
