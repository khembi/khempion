<?php

use App\Models\User;
use Illuminate\Auth\Events\Logout;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

test('logout must dispatch logout event', function () {
    Event::fake();
    $user = User::factory()->create();
    Auth::login($user);
    Auth::logout();
    Event::assertDispatched(Logout::class);
});


test('logout must create log entry', function () {
    $user = User::factory()->create();
    Auth::login($user);
    Auth::logout();
    $this->assertDatabaseHas('log_entries', [
        'loggable_id' => $user->id,
        'level' => 'NOTICE',
        'message' => 'User logged out'
    ]);
});
