<?php

namespace App\Services;

use App\Contracts\ChatGPTInterface;
use GuzzleHttp\Client;

class ChatGPTService implements ChatGPTInterface
{
    protected $client;
    protected $apiKey;

    public function __construct()
    {
        $this->client = new Client();
        $this->apiKey = config('services.chatgpt.api_key');
    }

    public function getResponse($input) : array
    {
        $response = $this->client->post('https://api.openai.com/v1/chat/completions', [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json',
            ],
            'json' => [
                'model' => 'text-davinci-003',
                'messages' => [['role' => 'user', 'content' => $input]],
            ],
        ]);

        return json_decode($response->getBody(), true);
    }
}