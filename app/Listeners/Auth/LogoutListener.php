<?php

namespace App\Listeners\Auth;

use Illuminate\Auth\Events\Logout;

class LogoutListener
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
    public function handle(Logout $event): void
    {
        $user = $event->user;
        $user->logEntries()->create([
            'user_id' => $user->id,
            'level' => 'NOTICE',
            'message' => 'User logged out',
        ]);
    }
}
