<?php

namespace App\Observers;

use App\Contracts\LoggerInterface;
use Illuminate\Database\Eloquent\Model;

class QACoreModelObserver
{
    protected $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * Handle the Model "created" event.
     */
    public function created(Model $model): void
    {
        // $this->logger->log($model, 'info', 'model_created');
    }

    /**
     * Handle the Model "updated" event.
     */
    public function updated(Model $model): void
    {
        // $this->logger->log($model, 'info', 'model_updated', [
        //     'changes' => $model->getChanges(),
        //     'original' => $model->getOriginal(),
        // ]);
    }

    /**
     * Handle the Model "deleted" event.
     */
    public function deleted($model): void
    {
        $this->logger->log($model, 'info', 'model_deleted');
    }

    /**
     * Handle the Model "restored" event.
     */
    public function restored($model): void
    {
        // ...
    }

    /**
     * Handle the Model "forceDeleted" event.
     */
    public function forceDeleted($model): void
    {
        // ...
    }
}
