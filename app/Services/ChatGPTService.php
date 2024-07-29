<?php

namespace App\Services;

use App\Contracts\ChatGPTInterface;
use App\DTO\FormFieldResponseDTO;
use App\Models\FormSet;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class ChatGPTService implements ChatGPTInterface
{
    protected $apiKey;
    protected $baseUri;
    protected $model;

    public function __construct()
    {
        $this->apiKey = config('services.chatgpt.api_key');
        $this->baseUri = config('services.chatgpt.base_uri');
        $this->model = config('services.chatgpt.model');
    }

    public function initThreads(FormSet $form_set)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'OpenAI-Beta' => 'assistants=v2'
            ])->post($this->baseUri . '/threads');

            $data = $response->json();

            if (isset($data['id'])) {
                $form_set->update([
                    'chatgpt_thread_id' => $data['id']
                ]);
            }
        } catch (\Exception $e) {
            Log::error('ChatGPT API call failed: ' . $e->getMessage());
        }
    }

    public function generateFormFields(FormSet $form_set, string $prompt) : array
    {
        $result = [];
        try {
            $example_format = '{"formInputs": [{ "type": "text", "label": "Name", "placeholder": "Enter your name", "required": true } ] }';
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'OpenAI-Beta' => 'assistants=v2'
            ])->post($this->baseUri . '/threads/runs', [
                'assistant_id' => 'asst_m6SJzsY6Ab3qZNBNnUcE5xPl',
                'thread' => [
                    'messages' => [
                        [
                            'role' => 'user',
                            'content' => "I am generating a online form, my purpose of this form is {$prompt}. Please give me list of all form inputs in JSON format, The data scheme should be like this {$example_format}"
                        ],
                    ]
                ]
            ]);

            $data = $response->json();

            dd($data);

            if (isset($data['thread_id'])) {
                $form_set->update([
                    'chatgpt_thread_id' => $data['id']
                ]);
            }

            if (isset($data['choices'][0]['message']['content'])) {
                $json_response = json_decode($data['choices'][0]['message']['content']);
                foreach($json_response->formInputs as $form_input) {
                    $result[] = new FormFieldResponseDTO(
                        type: isset($form_input->type) ? $form_input->type : '',
                        label: isset($form_input->label) ? $form_input->label : '',
                        placeholder: isset($form_input->placeholder) ? $form_input->placeholder : '',
                        required: isset($form_input->required) ? $form_input->required : '',
                    );
                }
            }
        } catch (\Exception $e) {
            dd($e);
            Log::error('ChatGPT API call failed: ' . $e->getMessage());
        }

        return $result;
    }

    public function askAboutFormFields(FormSet $form_set, string $prompt) : array
    {
        $result = [];
        try {
            $example_format = '{"formInputs": [{ "type": "text", "label": "Name", "placeholder": "Enter your name", "required": true } ] }';
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
            ])->post($this->baseUri . '/chat/completions', [
                'model' => "gpt-3.5-turbo",
                'response_format' => [
                    'type' => 'json_object'
                ],
                'messages' => [
                    [
                        'role' => 'system',
                        'content' => "You are a helpful assistant designed to output JSON. The data scheme should be like this {$example_format}"
                    ], [
                        'role' => 'user',
                        'content' => "I am generating a online form, my purpose of this form is {$prompt}. Please give me list of all form inputs."
                    ],
                ]
            ]);

            $data = $response->json();

            if (isset($data['id'])) {
                $form_set->update([
                    'chatgpt_id' => $data['id']
                ]);
            }

            if (isset($data['choices'][0]['message']['content'])) {
                $json_response = json_decode($data['choices'][0]['message']['content']);
                foreach($json_response->formInputs as $form_input) {
                    $result[] = new FormFieldResponseDTO(
                        type: isset($form_input->type) ? $form_input->type : '',
                        label: isset($form_input->label) ? $form_input->label : '',
                        placeholder: isset($form_input->placeholder) ? $form_input->placeholder : '',
                        required: isset($form_input->required) ? $form_input->required : '',
                    );
                }
            }
        } catch (\Exception $e) {
            dd($e);
            Log::error('ChatGPT API call failed: ' . $e->getMessage());
        }

        return $result;
    }
}