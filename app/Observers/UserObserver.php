<?php
namespace App\Observers;

use App\Contracts\LoggerInterface;
use App\Models\User;
use Illuminate\Support\Facades\Bus;

class UserObserver
{
  protected $logger;

  public function __construct(LoggerInterface $logger) {
      $this->logger = $logger;
  }

  public function created(User $user): void
  {
    $this->logger->log($user, 'NOTICE', 'User created', [ ]);
  }
}
