<?php

namespace App\Observers;

use App\Jobs\AssignAIAssistant;
use App\Jobs\ProcessOpenAIRun;
use App\Jobs\RetrieveMessagesFromAssistant;
use App\Models\Question;
use Illuminate\Support\Facades\Bus;

class QuestionObserver
{
    /**
     * Handle the Question "created" event.
     */
    public function created(Question $question): void
    {
        Bus::chain([
            new AssignAIAssistant($question),
            new ProcessOpenAIRun($question),
            new RetrieveMessagesFromAssistant($question),
        ])->dispatch();


    }

    /**
     * Handle the Question "updated" event.
     */
    public function updated(Question $question): void
    {
        //
    }

    /**
     * Handle the Question "deleted" event.
     */
    public function deleted(Question $question): void
    {
        //
    }

    /**
     * Handle the Question "restored" event.
     */
    public function restored(Question $question): void
    {
        //
    }

    /**
     * Handle the Question "force deleted" event.
     */
    public function forceDeleted(Question $question): void
    {
        //
    }
}