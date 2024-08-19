<?php

namespace App\Services;

use App\Contracts\LoggerInterface;
use App\Models\User;
use App\Repositories\LoggerRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class LoggerService implements LoggerInterface
{
    /**
     * Log a message related to a model.
     *
     * @param Model $loggable
     * @param string $level
     * @param string $message
     * @param array $context
     * @return void
     */
    public function log(Model $loggable, string $level, string $message, array $context = []): void
    {
        $loggable->logEntries()->create([
            'user_id' => Auth::check() ? Auth::id() : $loggable->user_id,
            'level' => $level,
            'message' => $message,
            'context' => filled($context) ? $context : null
        ]);
    }
}