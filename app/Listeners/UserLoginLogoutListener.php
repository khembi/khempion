<?php
namespace App\Listeners;

use Illuminate\Auth\Events\Login;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Log;
use App\Models\LogEntry;

class UserLoginLogoutListener
{
    public function __construct()
    {
        //
    }

    public function handle(Login|Logout $event)
    {
        $user = $event->user;
        $logEntry = new LogEntry();
        $logEntry->user_id = $user->id;
        $logEntry->loggable_type = 'App\Models\User';
        $logEntry->loggable_id = $user->id;
        $logEntry->level = 'NOTICE';
        $logEntry->message = $event instanceof Login ? 'User logged in' : 'User logged out';
        $logEntry->context = ['id' => $user->id, 'email' => $user->email];
        $logEntry->save();
        Log::info($event instanceof Login ? 'User logged in' : 'User logged out', ['id' => $user->id, 'email' => $user->email]);
    }
}