<?php

namespace App\Jobs;

use App\Models\Question;
use App\Services\OpenAIService;
use Exception;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProcessOpenAIRun implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $question;

    /**
     * Create a new job instance.
     */
    public function __construct(Question $question)
    {
        $this->question = $question->fresh();
    }

    /**
     * Determine number of times the job may be attempted.
     */
    public function tries(): int
    {
        return 3;
    }

    /**
     * Calculate the number of seconds to wait before retrying the job.
     */
    public function backoff(): int
    {
        return 10;
    }

    /**
     * Execute the job.
     */
    public function handle(OpenAIService $service): void
    {
        $assistant = $this->question->assistant;
        $response = $service->retrieveRun($assistant->thread_id, $assistant->latest_run_id);
        if ($response['status'] !== 'completed') {
            throw new Exception('Run not ready yet', 1);
        }
    }
}
