<?php

namespace App\Services;

use App\Contracts\OpenAIInterface;
use App\DTO\FormFieldResponseDTO;
use App\Models\FormSet;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class OpenAIService implements OpenAIInterface
{
    protected $apiKey;
    protected $baseUri;
    protected $model;

    public function __construct()
    {
        $this->apiKey = config('services.openai.api_key');
        $this->baseUri = config('services.openai.base_uri');
        $this->model = config('services.openai.model');
    }

    public function createThread() : array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'OpenAI-Beta' => 'assistants=v2'
        ])->post($this->baseUri . '/threads');

        $data = $response->json();
        return $data;
    }

    public function createThreadAndRun(string $assistant_id, array $messages) : array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'OpenAI-Beta' => 'assistants=v2'
        ])->post($this->baseUri . '/threads/runs', [
            'assistant_id' => $assistant_id,
            'thread' => [
                'messages' => $messages
            ]
        ]);

        $data = $response->json();
        return $data;
    }

    public function retrieveMessages(string $thread_id) : array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'OpenAI-Beta' => 'assistants=v2'
        ])->get($this->baseUri . "/threads/{$thread_id}/messages");

        $data = $response->json();
        return $data;
    }

    public function retrieveRun(string $thread_id, string $run_id) : array
    {
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . $this->apiKey,
            'OpenAI-Beta' => 'assistants=v2'
        ])->get($this->baseUri . "/threads/{$thread_id}/runs/{$run_id}");

        $data = $response->json();
        return $data;
    }
}