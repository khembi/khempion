<?php

use App\Models\User;
use Illuminate\Auth\Events\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Event;

test('login must dispatch login event', function () {
    Event::fake();
    $user = User::factory()->create();
    Auth::login($user);
    Event::assertDispatched(Login::class);
});

test('login must create log entry', function () {
    $user = User::factory()->create();
    Auth::login($user);
    $this->assertDatabaseHas('log_entries', [
        'loggable_id' => $user->id,
        'level' => 'NOTICE',
        'message' => 'User logged in',
    ]);
});
