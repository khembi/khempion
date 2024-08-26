<?php

namespace App\Listeners;
use Illuminate\Auth\Events\Login;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

use App\Models\LogEntry;

class UserLoginListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(Login $event): void
    {
        $user = $event->user;
        $logEntry = new LogEntry();
        $logEntry->user_id = $user->id;
        $logEntry->loggable_type = 'App\Models\User';
        $logEntry->loggable_id = $user->id;
        $logEntry->level = 'NOTICE';
        $logEntry->message = 'User logged in';
        $logEntry->context = ['id' => $user->id, 'email' => $user->email];
        $logEntry->save();
            // Log::info($event instanceof Login ? 'User logged in' : 'User logged out', ['id' => $user->id, 'email' => $user->email]);
        
    }
}
