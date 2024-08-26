<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Logout;
use App\Models\LogEntry;

class UserLogoutListener
{
    public function __construct()
    {
        //
    }

    public function handle(Logout $event)
    {
        $user = $event->user;
        $logEntry = new LogEntry();
        $logEntry->user_id = $user->id;
        $logEntry->loggable_type = 'App\Models\User';
        $logEntry->loggable_id = $user->id;
        $logEntry->level = 'NOTICE';
        $logEntry->message = 'User logged out';
        $logEntry->context = ['id' => $user->id, 'email' => $user->email];
        $logEntry->save();
        // Log::info($event instanceof Login ? 'User logged in' : 'User logged out', ['id' => $user->id, 'email' => $user->email]);
    }
}