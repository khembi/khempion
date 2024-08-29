<?php

namespace App\Listeners\Auth;

use Illuminate\Auth\Events\Login;

class LoginListener
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
        $user->logEntries()->create([
            'user_id' => $user->id,
            'level' => 'NOTICE',
            'message' => 'User logged in',
        ]);
    }
}
