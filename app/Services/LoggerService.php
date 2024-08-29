<?php

namespace App\Services;

use App\Contracts\LoggerInterface;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LoggerService implements LoggerInterface
{
    /**
     * Log a message related to a model.
     */
    public function log(Model $loggable, string $level, string $message, array $context = []): void
    {
        $loggable->logEntries()->create([
            'user_id' => Auth::check() ? Auth::id() : $loggable->id,
            'level' => $level,
            'message' => $message,
            'context' => filled($context) ? $context : null,
        ]);
    }

    public function logUserActivity(string $action, array $context = [])
    {
        $user = Auth::user();
        if (! $user) {
            return; // Handle cases where no user is logged in
        }

        $this->log($user, 'INFO', "$action: User ID: {$user->id}", $context);
    }
}
