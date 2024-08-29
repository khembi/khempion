<?php

namespace App\Contracts;

interface OpenAIInterface
{
    public function createThread(): array;

    // public function createMessage($thread_id, $promt = '') : array;

    // public function createRun($thread_id) : array;

    public function createThreadAndRun(string $assistant_id, array $messages): array;

    public function retrieveMessages(string $thread_id): array;

    public function retrieveRun(string $thread_id, string $run_id): array;
}
