<?php

namespace App\Jobs;

use App\Models\Question;
use App\Services\OpenAIService;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class AssignAIAssistant implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $question;

    /**
     * Create a new job instance.
     */
    public function __construct(Question $question)
    {
        $this->question = $question;
    }

    /**
     * Execute the job.
     */
    public function handle(OpenAIService $service): void
    {
        // Get default assistant that belongs to user
        // $this->question->user->defaultAssistant
        $default_assistant = config('services.openai.default_assistant');

        $response = $service->createThreadAndRun($default_assistant, [
            [
                'role' => 'user',
                'content' => $this->question->question,
            ],
        ]);

        if (isset($response['thread_id'])) {
            $this->question->assistant()->create([
                'assistant_type' => 'openai',
                'assistant_id' => $default_assistant,
                'thread_id' => $response['thread_id'],
                'latest_run_id' => $response['id'],
            ]);
        }
    }
}
