<?php

namespace App\Contracts;

use Illuminate\Database\Eloquent\Model;

interface LoggerInterface
{
    public function log(Model $loggable, string $level, string $message, array $context = []): void;
}
