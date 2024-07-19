<?php

namespace App\Providers;

use App\Contracts\LoggerInterface;
use App\Services\LoggerService;
use Illuminate\Support\ServiceProvider;

class QACoreServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(LoggerInterface::class, LoggerService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
